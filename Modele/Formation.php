<?php

// prends en paramètre : une idFormation (int) et un Nom de Formation (String)

class Status
{
    var $nom_formation;
    
    // Constructeur
    function __Status($nom_formation_donne)
    {
        $this->nom_formation = $nom_formation_donne;
    }//function __Status($_status_donne, $_nb_heures_donne)
    
    // fonction qui prends en paramètre un chiffre et un $pdo
    // et renvoie le nom de la formation
    
    function renvoieFormation($chiffre, $pdo) 
    {
        
        try {
        
           $resultats=$pdo->exec("SELECT NomFormation FROM Formation WHERE idFormation='".$chiffre."'");
           $resultats->setFetchMode(PDO::FETCH_OBJ);
                while( $resultat = $resultats->fetch() )
                {
                    $res=$resultat->NomFormation;
                    echo 'idFormation'.$res."\n";
                    
                }
            
        } catch(PDOException $e) {  // Erreur PDO 
             $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
        } catch(Exception $e) {     // Erreur PHP
            $msg = 'ERREUR PHP dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
        }
        
        return $resultat;
        
    }
    
    
    
}//class Status



?>
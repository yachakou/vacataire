<?php

class Parcours
{
    var $_nom;
    
    function __construct($nom)
    {
        $this->_nom = $nom;
    }
    
    /*$resultat = "SELECT NomParcours FROM Parcours WHERE idParcours='".$chiffre."'";*/
    
    function renvoieParcours($chiffre, $pdo) 
    {
        
        try {
                           
           $resultats=$pdo->exec("SELECT NomParcours FROM Parcours WHERE idParcours='".$chiffre."'");
           $resultats->setFetchMode(PDO::FETCH_OBJ);
                while( $resultat = $resultats->fetch() )
                {
                    $res=$resultat->NomParcours;
                    echo 'idParcours'.$res."\n";
                    
                }
            
        } catch(PDOException $e) {  // Erreur PDO 
             $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
        } catch(Exception $e) {     // Erreur PHP
            $msg = 'ERREUR PHP dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
        }
        
        return $resultat;
        
    }
    
    
    
}


?>
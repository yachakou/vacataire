<?php


class Enseignement {

private $idEnseignement;
private $idEnseignant;
private $idMatiere;


    function __construct($idEns,$idM)
    {
        
    $this->idEnseignant=$idEns;
    $this->idMatiere=$idM;
    
    }
    /*
    function __construct($idEnseignement,$idEnseignant,$idMatiere)
    {
        $this->idEnseignement=$idEnseignement;
        $this->idEnseignant=$idEnseignant;
        $this->idMatiere=$idMatiere;
    }
    
    function __construct($idEnseignement)
    {
        $this->idEnseignement=$idEnseignement;
    }
    */
     public function loadEnseignement($pdo, $idEnseignant, $idMatiere)
    {
        try {
            
            $sql = "SELECT * FROM Enseignement where idEnseignant=".$idEnseignant." and idMatiere=".$idMatiere."";
            
            
            $resultats=$pdo->query($sql);
           
            $resultats->setFetchMode(PDO::FETCH_OBJ);
                while( $row = $resultats->fetch() )
                {
                  
                    $this->idEnseignement = $row->idEnseignement;
                    $this->idEnseignant = $idEnseignant;
                    $this->idMatiere = $idMatiere;
                      
                }
                
                $resultats->closeCursor();
            
           
            
        }
        catch(PDOException $e)
        {
            $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
            die($msg);
            echo "erreur";
        }//catch(PDOException $e)
        
        catch(Exception $e)
        {
            echo 'Exception recue : ', $e->getMessage(), "\n";
        }//catch(Exception $e)
        
    }
    
    
    
    public function loadEnseignementID($pdo, $idEnseignement)
    {
        try {
            
            $sql = "SELECT * FROM Enseignement where idEnseignement=".$idEnseignement."";
            

            $resultats=$pdo->query($sql);
           
            $resultats->setFetchMode(PDO::FETCH_OBJ);
                while( $row = $resultats->fetch() )
                {
                  
                    $this->idEnseignement = $row->idEnseignement;
                    $this->idEnseignant = $row->idEnseignant;
                    $this->idMatiere = $row->idMatiere;
                      
                }
                
                $resultats->closeCursor();
            
           
            
        }
        catch(PDOException $e)
        {
            $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
            die($msg);
            echo "erreur";
        }//catch(PDOException $e)
        
        catch(Exception $e)
        {
            echo 'Exception recue : ', $e->getMessage(), "\n";
        }//catch(Exception $e)
        
    }
    
    
    public function addEnseignement($pdo)
    {
        try
        {
         
         echo "avant";
               
        //echo "INSERT INTO Matiere(nom, id_formation, id_parcours, nbhCM, nbhTD, nbhTP, id_enseignant_resp) VALUES ('".$this->nom."' , ".$this->id_formation." , ".$this->id_parcours." , ".$this->nbhCM." , ".$this->nbhTD." , ".$this->nbhTP." , ".$this->id_enseignant_resp.") ";

        
        $pdo->exec("INSERT INTO Enseignement(idMatiere,idEnseignant) VALUES (".$this->idMatiere." , ".$this->idEnseignant.")");
          
               // $pdo->exec("INSERT INTO Enseignant(login,password,nom,prenom,compte_actif,email,num_arpege,id_status) VALUES('".$this->login."','".$this->password."','".$this->nom."','".$this->prenom."',".$this->compte_actif.",'".$this->email."','".$this->num_arpege."',".$this->id_status.")");
               
                echo "Ligne inserer !!! ";   
            
            
            
        }//try
            catch(PDOException $e) {
                $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
                die($msg);
                echo "erreur";
            }
            
            catch(Exception $e)
            {
            	echo 'Exception recue : ', $e->getMessage(), "\n";
            }//catch
    }
    
    
    public function removeEnseignement($pdo)
        {
           try
           {
            $pdo->exec("delete from Enseignement where idEnseignement=".$this->idEnseignement);
           }
             catch(PDOException $e)
        {
            $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
            die($msg);
            echo "erreur";
        }//catch(PDOException $e)
        
        catch(Exception $e)
        {
            echo 'Exception recue : ', $e->getMessage(), "\n";
        }//catch(Exception $e)
            
        }
    
     public function loadID($pdo,$idmat,$idEnseignant)
    {
        try
        {
         
         $sql = "SELECT idEnseignement FROM Enseignement where  idMatiere=".$idmat." and idEnseignant=".$idEnseignant." ";
            

            $resultats=$pdo->query($sql);
           
            $resultats->setFetchMode(PDO::FETCH_OBJ);
                while( $row = $resultats->fetch() )
                {
                  
                    $id = $row->idEnseignement;
                 
                }
                
                $resultats->closeCursor();
             
             return $id;
           
            
        }//try
            catch(PDOException $e) {
                $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
                die($msg);
                echo "erreur";
            }
            
            catch(Exception $e)
            {
            	echo 'Exception recue : ', $e->getMessage(), "\n";
            }//catch
    }
    
     //permet de savoir le nombre d'heure qu'a fait un utilisateur en ne prenant pas en compte la ligne de la bdd a modifier. on rajoute la nouvelle duree souhaite a cette somme
     //$idEnseignement est la ligne a ignorer
     //$duree est la nouvelle duree souhaite
     //$idEns est l'utilisateur souhaité
     //fonction pour ModifierEnseignement.php
    public static function getNbTotale($pdo,$idEns,$idEnseignement,$duree) {
        
         $nbTotale=0;
            $sql="SELECT idEnseignement from Enseignement where idEnseignant=".$idEns." and idEnseignement!=".$idEnseignement; //pour obtenir tous les idenseignement";
            $resultats=$pdo->query($sql);
            $resultats->setFetchMode(PDO::FETCH_OBJ);
            $idEnseignementT=array();
                while( $row = $resultats->fetch() )
                {

                  array_push($idEnseignementT,$row->idEnseignement);
                }
                print_r($idEnseignementT); //tableau de tous les enseignements de l'utilisateur
              $resultats->closeCursor();
              
        for($i=0;$i<count($idEnseignementT);$i++)
        {
            $nhoraire=new Horaire();
            $nhoraire->loadHoraire($pdo,$idEnseignementT[$i]);
            $nbTotale+=$nhoraire->getDuree();
            print_r($nhoraire);
            
        }
        $nbTotale+=$duree;
        return $nbTotale;
    }
    
    public function getIdEnseignement()
    {
        return $this->idEnseignement;
    }
    
    public function getIdEnseignant() {
        return $this->idEnseignant;
    }
    
    public function getIdMatiere()
    {
        return $this->idMatiere;
    }
        
}

   




?>
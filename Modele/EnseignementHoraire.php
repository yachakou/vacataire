<?php

class EnseignementHoraire extends Enseignement {

    private $idHoraire;
    private $day;
    private $heure;
    private $duree;
    private $typeCours;   //0 : cm  1 : td  2 : tp

   public function __construct($idEnseignement,$idEnseignant,$idMatiere,$day,$heure,$duree,$typeCours)
    {
        parent::__construct(($idEnseignement,$idEnseignant,$idMatiere);
        $this->day=$day;
        $this->heure=$heure;
        $this->duree=$duree;
        $this->typeCours=$typeCours;
    }
    
   public function addHoraire($pdo)
    {
       
        try {
                parent::addEnseignement($pdo);
                $pdo->exec("INSERT INTO Horaire(idEnseignement,day,heure,duree,typeCours) VALUES(".parent::getIdEnseignement().",'".$this->day."',".$this->heure.",".$this->duree.",".$this->typeCours.")");
               
                
            }
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
    
    
    public function loadHoraire($pdo, $idEnseignement) {
        
        try {
            parent::loadEnseignementID($pdo,$idEnseignement);
            $sql = "SELECT * FROM Horaire where idEnseignement='".$idEnseignement."'";
            $resultats=$pdo->query($sql);
           
            $resultats->setFetchMode(PDO::FETCH_OBJ);
                while( $row = $resultats->fetch() )
                {
                  
                    $this->idEnseignement = $idEnseignement;
                    $this->day = $row->day;
                    $this->heure = $row->heure;
                    $this->duree = $row->prenom;
                    $this->typeCours = $row->typeCours;
                    $this->idHoraire = $row->idHoraire;
                      
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
    }//public function loadEnseignant($pdo, $login, $pwd)
    

}

?>


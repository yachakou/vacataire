<?php

class Matiere {
    private $id_mat;
    private $nom;
    private $id_formation;
    private $id_parcours;
    private $nbhCM;
    private $nbhTD;
    private $nbhTP;
    private $id_enseignant_resp;
    
    
    function __construct($nom_donne, $id_formation_donne, $id_parcours_donne, $nbhCM_donne, $nbhTD_donne, $nbhTP_donne, $id_enseignant_resp_donne)
    {
        $this->nom = $nom_donne;
        $this->id_formation = $id_formation_donne;
        $this->id_parcours  = $id_parcours_donne;
        $this->nbhCM = $nbhCM_donne;
        $this->nbhTD = $nbhTD_donne;
        $this->nbhTP = $nbhTP_donne;
        $this->id_enseignant_resp = $id_enseignant_resp_donne;
    }//function __constructor
    
   
    public function loadMatiere($pdo, $id_mat) {
        
        try {
            
            $sql = "SELECT * FROM Matiere where id_mat='".$id_mat."'";
            
            
            $resultats=$pdo->query($sql);
           
            $resultats->setFetchMode(PDO::FETCH_OBJ);
                while( $row = $resultats->fetch() )
                {
                  
                    $this->nom = $row->nom;
                    $this->id_formation = $row->id_formation;
                    $this->id_parcours  = $row->id_parcours;
                    $this->nbhCM = $row->nbhCM;
                    $this->nbhTD = $row->nbhTD;
                    $this->nbhTP = $row->nbhTP;
                    $this->id_enseignant_resp = $row->id_enseignant_resp;
                    $this->id_mat=$id_mat;
                      
                }
                
                $resultats->closeCursor();
            
            
        } catch(PDOException $e) {
                $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
                die($msg);
                echo "erreur";
            }
            
            catch(Exception $e)
            {
            	echo 'Exception recue : ', $e->getMessage(), "\n";
            }//catch
    }
    public function addMatiere($pdo)
    {
        try
        {
             
                echo "avant";
               
        //echo "INSERT INTO Matiere(nom, id_formation, id_parcours, nbhCM, nbhTD, nbhTP, id_enseignant_resp) VALUES ('".$this->nom."' , ".$this->id_formation." , ".$this->id_parcours." , ".$this->nbhCM." , ".$this->nbhTD." , ".$this->nbhTP." , ".$this->id_enseignant_resp.") ";

        
        $pdo->exec("INSERT INTO Matiere(nom, id_formation, id_parcours, nbhCM, nbhTD, nbhTP, id_enseignant_resp) VALUES ('".$this->nom."' , ".$this->id_formation." , ".$this->id_parcours." , ".$this->nbhCM." , ".$this->nbhTD." , ".$this->nbhTP." , ".$this->id_enseignant_resp.") ");
               
;
               
                
               // $pdo->exec("INSERT INTO Enseignant(login,password,nom,prenom,compte_actif,email,num_arpege,id_status) VALUES('".$this->login."','".$this->password."','".$this->nom."','".$this->prenom."',".$this->compte_actif.",'".$this->email."','".$this->num_arpege."',".$this->id_status.")");
               
                echo "Ligne inserer !!! ";
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
    
    }//adMatiere 
    
    
    public function remove($pdo,$id_mat)
    {
        try {
            echo 'ici';
            
        //  echo "DELETE FROM Matiere WHERE id_mat=" . $id_mat . "";
            $pdo->exec("DELETE FROM Matiere WHERE id_mat=" . $id_mat . "");
            
          $pdo->exec("DELETE FROM Matiere WHERE nom=" . $nom . " and id_parcours=" . $id_parcours . " and id_formation=" . $id_formation . "");

            echo 'Ligne suprimé !';
        }
  
        catch(PDOException $e) {  // Erreur PDO 
             $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
        } 
        
        catch(Exception $e) {     // Erreur PHP
            $msg = 'ERREUR PHP dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
        }
        
    }//public remove()
    
    
    
      public function removeNom($pdo,$nom,$id_parcours,$id_formation)
    {
        try {
            echo 'ici';
            
    echo "DELETE FROM Matiere WHERE nom=" . $nom . " and id_parcours=" . $id_parcours . " and id_formation=" . $id_formation . "";
         
          $pdo->exec("DELETE FROM Matiere WHERE nom='" . $nom . "' and id_parcours=" . $id_parcours . " and id_formation=" . $id_formation . "");
            echo 'Ligne suprimé !';
        }
       
        catch(PDOException $e) {  // Erreur PDO 
             $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
        } 
        
        catch(Exception $e) {     // Erreur PHP
            $msg = 'ERREUR PHP dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
        }
        
    }//public remove()
    
    
    public function getID($pdo)
    {
        
        try 
        {
            echo "debut ";
        
         //  echo "SELECT id_mat as ID FROM Matiere where  nom='" . $this->nom . "' AND id_formation=". $this->id_formation ." AND id_parcours=" . $this->id_parcours ."  AND nbhCM=" . $this->nbhCM ." AND nbhTD=" . $this->nbhTD ."  AND nbhTP=" . $this->nbhTP ." AND id_enseignant_resp=" . $this->id_enseignant_resp ."";
           
            $sql="SELECT id_mat as IDMAT FROM Matiere where nom='" . $this->nom . "' AND id_formation=". $this->id_formation ." AND id_parcours=" . $this->id_parcours ."  AND nbhCM=" . $this->nbhCM ." AND nbhTD=" . $this->nbhTD ."  AND nbhTP=" . $this->nbhTP ." AND id_enseignant_resp=" . $this->id_enseignant_resp ."";
            echo $sql;
            //$resultats=$pdo->query("SELECT id_mat FROM Matiere where  nom='" . $this->nom . "' AND id_formation=". $this->id_formation ." AND id_parcours=" . $this->id_parcours ."  AND nbhCM=" . $this->nbhCM ." AND nbhTD=" . $this->nbhTD ."  AND nbhTP=" . $this->nbhTP ." AND id_enseignant_resp=" . $this->id_enseignant_resp ."");
           
            $resultats=$pdo->query($sql);
           
            $resultats->setFetchMode(PDO::FETCH_OBJ);
            while( $resultat = $resultats->fetch() )
            {
            //echo 'ID : '.$resultat->IDMAT.'<br>';
            $id=$resultat->IDMAT;
           
           return $id;
            
            }
            $resultats->closeCursor();
            
            echo $id;

        
        }
        
         catch(PDOException $e) {  // Erreur PDO 
             $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
        } 
        
        catch(Exception $e) {     // Erreur PHP
            $msg = 'ERREUR PHP dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
        }
        
        
        
    }
    
    public static function getMatieres($pdo) //retourne toutes les matieres
    {
         try {
            
            $sql = "SELECT * FROM Matiere";
            
            
            $resultats=$pdo->query($sql);
            $matieres=array();
            $resultats->setFetchMode(PDO::FETCH_OBJ);
                while( $row = $resultats->fetch() )
                {
                  $matiere=new Matiere();
                  $matiere->loadMatiere($pdo,$row->id_mat);
                  array_push($matieres,$matiere);
                }
                
                $resultats->closeCursor();
            return $matieres;
            
        } catch(PDOException $e) {
                $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
                die($msg);
                echo "erreur";
            }
            
            catch(Exception $e)
            {
            	echo 'Exception recue : ', $e->getMessage(), "\n";
            }//catch
        
    }
    
    
    
    public function getNom()
    {
        return $this->nom;
    }
    public function getIdFormation()
    {
        return $this->id_formation;
    }
    public function getIdParcours()
    {
        return $this->id_parcours;
    }
    public function getNbhCM()
    {
        return $this->nbhCM;
    }
    public function getNbhTD()
    {
        return $this->nbhTD;
    }
    public function getNbhTP()
    {
        return $this->nbhTP;
    }
    public function getIdEnseignantResp()
    {
        return $this->id_enseignant_resp;
    }
    public function getIdMatiere()
    {
        return $this->id_mat;
        }
    

}
?>
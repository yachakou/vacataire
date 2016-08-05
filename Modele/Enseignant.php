<?php

class Enseignant 
{
    private $login;
    private $password;
    private $nom;
    private $prenom;
    private $compte_actif;
    private $email;
    private $num_arpege;
    private $id_status;
    private $idEnseignant;
   
   public function __construct($log,$mdp,$name,$firstname,$active,$mail,$arp,$id_stat)
    {
        
        $this->login=$log;
        $this->password=$mdp;
        $this->nom=$name;
        $this->prenom=$firstname;
        $this->compte_actif=$active;
        $this->email=$mail;
        $this->num_arpege=$arp;
        $this->id_status=$id_stat;
    }
    
  
    
   public function addEnseignant($pdo)
    {
        
        
        try {
       
                echo "avant";
               
                
                $pdo->exec("INSERT INTO Enseignant(login,password,nom,prenom,compte_actif,email,num_arpege,id_status) VALUES('".$this->login."','".$this->password."','".$this->nom."','".$this->prenom."',".$this->compte_actif.",'".$this->email."','".$this->num_arpege."',".$this->id_status.")");
               
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
    }
    
    public function loadEnseignant($pdo, $login) {
        
        try {
            
            $sql = "SELECT * FROM Enseignant where login='".$login."'";
            
            
            
          //  echo "SELECT * FROM Enseignant where login='".$login."'";
            
            //$sql = "SELECT * FROM Enseignant where login='root'";
            
            
            $resultats=$pdo->query($sql);
           
            $resultats->setFetchMode(PDO::FETCH_OBJ);
                while( $row = $resultats->fetch() )
                {
                  
                    $this->login = $login;
                    $this->password = $row->password;
                    $this->nom = $row->nom;
                    $this->prenom = $row->prenom;
                    $this->compte_actif = $row->compte_actif;
                    $this->email = $row->email;
                    $this->num_arpege = $row->num_arpege;
                    $this->id_status = $row->id_status;
                    $this->idEnseignant=$row->idEnseignant;    
                }
                
                $resultats->closeCursor();
            
            /*
            foreach  ($pdo->query($sql) as $row)
            {
                echo $row;
                if (count($row) != 1) {
                    echo "<b>Erreur innatendue : il y a plus d'un utilisateur avec le login ".$login." ou il n'existe pas.</b>";
                    exit();
                }
                else {
                    $this->login = $login;
                    $this->password = $row['password'];
                    $this->nom = $row['nom'];
                    $this->prenom = $row['prenom'];
                    $this->compte_actif = $row['compte_actif'];
                    $this->email = $row['email'];
                    $this->num_arpege = $row['num_arpege'];
                    $this->id_statut = $row['id_statut'];
                    $this->idEnseignant=$row['idEnseignant'];
                    echo "ok";
                }
            }*/
            
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
    
    
    

     public function loadEnseignantID($pdo, $idEnseignant) {
        
        try {
            
            $sql = "SELECT * FROM Enseignant where idEnseignant=".$idEnseignant."";
            

            $resultats=$pdo->query($sql);
           
            $resultats->setFetchMode(PDO::FETCH_OBJ);
                while( $row = $resultats->fetch() )
                {
                  
                    $this->login = $row->login;
                    $this->password = $row->password;
                    $this->nom = $row->nom;
                    $this->prenom = $row->prenom;
                    $this->compte_actif = $row->compte_actif;
                    $this->email = $row->email;
                    $this->num_arpege = $row->num_arpege;
                    $this->id_status = $row->id_status;
                    $this->idEnseignant=$row->idEnseignant;    
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
    
    
    
    public function isPwdCorrect ($pwd) {
        
         if ($this->password==$pwd) {
             
            return 1;
        }
        else {
           
            return 0;
        }
    }
    
    public function removeEnseignant($pdo)
        {
           try
           {
            $pdo->exec("delete from Enseignant where idEnseignant=".$this->idEnseignant);
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
    
    
    
    public function modifEnseignant($pdo)
    {
        
        try
        {
             
             $pdo->exec("update Enseignant set password='".$this->password."',nom='".$this->nom."',prenom='".$this->prenom."',email='".$this->email."',num_arpege='".$this->num_arpege."' where idEnseignant=".$this->idEnseignant);
           
        }  catch(PDOException $e)
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
    
    public function changerStatus($pdo)
    {
        try
        {
             
             $pdo->exec("update Enseignant set id_status=".$this->id_status." where idEnseignant=".$this->idEnseignant);
           
        }  catch(PDOException $e)
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
    
    public static function getNbHStatus($pdo,$idEns)
    {
        try
        {
         $sql="SELECT s.nbh from Status s,Enseignant e where e.idEnseignant=".$idEns." and e.id_status=s.idStatus";
         $resultats=$pdo->query($sql);
         $resultats->setFetchMode(PDO::FETCH_OBJ);
         $row = $resultats->fetch();
         $nbmax=$row->nbh;
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
        }//catch(Exc
        
        return $nbmax;
    }
    
     public static function getEnseignants($pdo) //retourne toutes les enseignants
    {
         try {
            
            $sql = "SELECT * FROM Enseignant";
            
            
            $resultats=$pdo->query($sql);
            $enseignants=array();
            $resultats->setFetchMode(PDO::FETCH_OBJ);
                while( $row = $resultats->fetch() )
                {
                  $enseignant=new Enseignant();
                  $enseignant->loadEnseignantID($pdo,$row->idEnseignant);
                  array_push($enseignants,$enseignant);
                }
                
                $resultats->closeCursor();
            return $enseignants;
            
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
    
    //*****************************************************          getter
    public function getIdEnseignant() {
        return $this->idEnseignant;
    }
    
    public function getIdStatus() {
        return $this->id_status;
    }

    public function getCompteActif() {
        return $this->compte_actif;
    }

    public function getLogin()
    {
        return $this->login;
    }
    
    public function getNom()
    {
        return $this->nom;
    }
    
    public function getPrenom()
    {
        return $this->prenom;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function getArpege()
    {
        return $this->num_arpege;
    }
    
    //********************************************************  setter

    public function setLogin($login)
    {
         $this->login=$login;
    }
    
    public function setNom($nom)
    {
         $this->nom=$nom;
    }
    
    public function setPrenom($prenom)
    {
         $this->prenom=$prenom;
    }
    
    public function setEmail($email)
    {
         $this->email=$email;
    }
    
    public function setArpege($arp)
    {
         $this->num_arpege=$arp;
    }
    
    public function setPassword($pwd)
    {
        $this->password=$pwd;
    }
    
    public function setIdStatus($id)
    {
        $this->id_status=$id;
    }
    

}

?>



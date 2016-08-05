<?php

class Email 
{
    private $idEmetteur;
    private $idRecepteur;
    private $objet;
    private $message;
    private $date;
    private $idMail;
    
   
   
   public function __construct($idE,$idR,$objet,$msg,$date)
    {
        
        $this->idEmetteur=$idE;
        $this->idRecepteur=$idR;
        $this->objet=$objet;
        $this->message=$msg;
        $this->date=$date;
        
    }
    
    public function send($pdo)
    {
         try {
                
              $pdo->exec("INSERT INTO Mail(idEmetteur,idRecepteur,objet,message,date) VALUES(".$this->idEmetteur.",".$this->idRecepteur.",'".$this->objet."','".$this->message."','".$this->date."')");
               
                
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
    
    public function loadEmail($pdo, $idMail) {
        
        try {
            
            $sql = "SELECT * FROM Mail where idMail=".$idMail."";
            

            $resultats=$pdo->query($sql);
           
            $resultats->setFetchMode(PDO::FETCH_OBJ);
                while( $row = $resultats->fetch() )
                {
                  
                    $this->idEmetteur = $row->idEmetteur;
                    $this->idRecepteur = $row->idRecepteur;
                    $this->objet = $row->objet;
                     $this->date = $row->date;
                      $this->message = $row->message;
                      $this->idMail=$row->idMail;
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
    
    public function remove($pdo)
    {
         try
           {
            $pdo->exec("delete from Mail where idMail=".$this->idMail);
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
    
    
}

?>
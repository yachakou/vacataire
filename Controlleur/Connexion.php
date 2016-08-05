<?php


//fonction a mysql avec pdo
// include_once('Membre.class.php'); Inclure une classe 


class Connexion 
{
    private $pdo;
     public function __construct() {  
    
        try{
        
            
            $connStr = 'mysql:host=mysql1.alwaysdata.com;dbname=sealteamsix_database'; //Ligne 1
            $arrExtraParam= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"); //Ligne 2$utilisateur = 'root';  
            $motDePasse = 'root';
            $utilisateur = '84540';
            $pdo = new PDO($connStr, $utilisateur,$motDePasse , $arrExtraParam);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Ligne 4
            $this->pdo=$pdo;
            //echo "Connexion reussi!";
           // echo "Bienvenue ";
            
            //return $pdo; // c'est lui dont on a besoin !! comment faire pour le recuperer ??
        
        }//try 
        
            catch(PDOException $e) {
            $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
            die($msg);
        }
        
        catch(Exception $e)
        {
        	echo 'Exception re�ue : ', $e->getMessage(), "\n";
        }//catch
        
    }

    // recuperer le max d'une colonne 
   public function RecupMax($champ,$table)
    {
        echo "debut fonction\n";
        try{
            
            
            $sql="SELECT MAX(".$champ.") AS Maximum FROM  ".$table;
          // echo "la\n";
           $resultats=$this->pdo->query($sql);
            //echo 'apres requette';
            print_r($resultats);
            $resultats->setFetchMode(PDO::FETCH_OBJ);
                 while( $resultat = $resultats->fetch() )
             {
                    $res=$resultat->Maximum;
                     //  echo 'Le Maximum'.$res."\n";
                    
                }
                    $resultats->closeCursor();
            
            //echo $res;
            return $res;
            
        }
        
        catch(Exception $e)
    	{
    		echo 'Exception re�ue : ', $e->getMessage(), "\n";
    	}//catch
        
        
    }
    
    public function getPDO()
    {
       // echo "pdo recupérer";
        return $this->pdo;
    }


}

?>






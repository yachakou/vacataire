<?php

//pour tester la connexion avec la BD


$connStr = 'mysql:host=mysql1.alwaysdata.com;dbname=sealteamsix_database'; //Ligne 1
            $arrExtraParam= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"); //Ligne 2$utilisateur = 'root';  
            $motDePasse = 'root';
            $utilisateur = '84540';
            $pdo = new PDO($connStr, $utilisateur,$motDePasse , $arrExtraParam);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Ligne 4
            
print_r($pdo);
/*
$champs="*";
$table="Enseignant";
//$sql="SELECT * from Enseignant";
// $sql="SELECT login from Enseignant";
 $sql="SELECT ".$champs." from ".$table;
 $resultats=$pdo->query($sql);
           
            $resultats->setFetchMode(PDO::FETCH_OBJ);
                 while( $resultat = $resultats->fetch() )
             {
                    
                      print_r($resultat);
                    
                }
                    $resultats->closeCursor();
            
            echo $res;
            return $res;
*/
$pdo->exec("INSERT INTO Enseignant(login,password,nom,prenom,compte_actif,email,num_arpege,id_status) VALUES('matdu93','root','lioret','mathieu',1,'mathieu.lioret@hotmail.fr',5454421,1)");
echo "ok";               
?>
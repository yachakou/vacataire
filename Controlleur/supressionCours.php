<?php

function __autoload($class_name) {
    include $class_name . '.php';
}

session_start();
require_once("../Modele/Matiere.php");
require_once("./Connexion.php");
require_once("../Modele/Horaire.php");



//print_r($_POST);

$mat=$_POST['mat'];


$pieces = explode(";", $mat);
$mat= $pieces[0]; 
$parc= $pieces[1]; 
$form= $pices[2]; 


$pdo = new Connexion();
$pdo2=$pdo->GetPDO();


$sql='SELECT h.idHoraire
FROM Horaire h, Enseignement e, Matiere m
WHERE m.id_mat = '.$mat.'
AND e.IdMatiere = m.id_mat
AND h.idEnseignement = e.idEnseignement';

$list= array();

$reponse = $pdo2->query($sql);

while ($donnees = $reponse->fetch())
{
    //echo $donnees['idHoraire'];
    array_push($list,$donnees['idHoraire']);
}

print_r($list);

foreach ($list as &$value) {
try{
 $pdo2->exec("delete from Horaire where idHoraire=".$value."");
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



try{
 $pdo2->exec("delete from Enseignement where idMatiere=".$mat."");
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
        

try{
 $pdo2->exec("delete from Matiere where id_mat=".$mat."");
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
        

echo "supression dans Matiere faire !";

header("location:../Vue/dashboard.php");



?>
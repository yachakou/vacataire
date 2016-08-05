<?php 
require_once("../Modele/Enseignant.php");
require_once("./Connexion.php");
//print_r($_POST);
$user=$_POST["user"];
$pdo=new Connexion(); 

$enseignant = new Enseignant();
$pdo2=$pdo->getPDO();
$enseignant->loadEnseignant($pdo2, $user);
//print_r($enseignant);
$enseignant->removeEnseignant($pdo2);
//header("location:../Vue/dashboard.php");
?>


<?php 
require_once("../Modele/Enseignement.php");
require_once("../Modele/Horaire.php");
require_once("./Connexion.php");
print_r($_GET);
$idEnseignement=$_GET['idEnseignement'];
$id_mat=$_GET['id_mat'];
$pdo=new Connexion(); 

$enseignement = new Enseignement();
$horaire=new Horaire();
$pdo2=$pdo->getPDO();
$enseignement->loadEnseignementID($pdo2,$idEnseignement);
$horaire->loadHoraire($pdo2,$idEnseignement);
//print_r($enseignement);
print_r($horaire);
$horaire->removeHoraire($pdo2);
$enseignement->removeEnseignement($pdo2);
header("location:../Vue/apercuMatiere.php?id_mat=".$id_mat);
?>


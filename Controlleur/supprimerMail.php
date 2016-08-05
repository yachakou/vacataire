<?php
require_once("../Modele/Email.php");
require_once("../Controlleur/Connexion.php");
print_r($_GET);
$idMail=$_GET['idMail'];
$pdo=new Connexion(); 
$pdo2=$pdo->getPDO();

$email=new Email($pdo2);
$email->loadEmail($pdo2,$idMail);
print_r($email);
$email->remove($pdo2);
header("location:../Vue/webmail.php");
?>
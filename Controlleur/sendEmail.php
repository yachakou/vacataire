<?php

//envoyer mail FAIT !
//faut afficher les mails maintenant !

require_once("../Modele/Email.php");
require_once("../Modele/Enseignant.php");
require_once("./Connexion.php");
session_start();

date_default_timezone_set('UTC');

//print_r($_SESSION);
//print_r($_POST);

$user=$_SESSION['login'];
$user2=$_POST['user'];
$objet=$_POST['objet'];
$msg=$_POST['message'];

$pdo=new Connexion();

$enseignantE = new Enseignant();
$enseignantR = new Enseignant();
$pdo2=$pdo->getPDO();
$enseignantE->loadEnseignant($pdo2, $user);
//print_r($enseignantE);
$enseignantR->loadEnseignant($pdo2, $user2);
//print_r($enseignantR);
$idE=$enseignantE->getIdEnseignant();
$idR=$enseignantR->getIdEnseignant();
$date=date(DATE_RFC2822);

$email=new Email($idE,$idR,$objet,$msg,$date);
$email->send($pdo2);
header("location:../Vue/webmail.php");

?>
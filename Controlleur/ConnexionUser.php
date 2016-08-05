<?php

 function __autoload($class_name) {
    include $class_name . '.php';
}

require_once("../Modele/Enseignant.php");
require_once("./Connexion.php");



$login=$_POST['login'];
$pwd=$_POST['pwd'];
print_r($_POST);


$pdo=new Connexion(); 

echo "test";

$enseignant = new Enseignant();
echo "apres enseignant";

$pdo2=$pdo->getPDO();
$enseignant->loadEnseignant($pdo2, $login);
print_r($enseignant);


if ($enseignant->isPwdCorrect($pwd)==1){
    session_start();
    echo "ok";
    // $_SESSION['connexion'] = $pdo;
    // echo $_SESSION['connexion'];
    $_SESSION['login'] = $login;
    $_SESSION['idEnseignant'] = $enseignant->getIdEnseignant();
    $_SESSION['status'] = $enseignant->getIdStatus();
    $_SESSION['compte_actif'] = $enseignant->getCompteActif();
    
    echo "Connexion réussie";
    
   header("location:../Vue/dashboard.php");
   
} else {
    echo "Identifiants incorrects.";
    exit();
}




?>
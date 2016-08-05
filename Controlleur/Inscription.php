<?php
session_start();
require_once("../Modele/Enseignant.php");
require_once("./Connexion.php");

 function __autoload($class_name) {
    include $class_name . '.php';
}


$name=$_POST['name'];
$prenom=$_POST['prenom'];
$email=$_POST['email'];
$log=$_POST['log'];
$harpege=$_POST['harpege'];
$pwd=$_POST['pwd'];
$active=1;
$id_stat=1; //vacataire par défaut 


//print_r($_POST);
//echo "\n";

$pdo=new Connexion(); 
//print_r($pdo);
//echo "connexion faite";
$user=new Enseignant($log,$pwd,$name,$prenom,$active,$email,$harpege,$id_stat); 

print_r($user);
$champs="idEnseignant";
$table="Enseignant";
$id=$pdo->recupMax($champs,$table);
$id+=1;
//echo $id;
$pdo2=$pdo->getPDO();

$user->addEnseignant($pdo2);
 $_SESSION['compte_actif']=1;
//$_SESSION['idEnseignant']=$id;
$_SESSION["status"]=1;
$_SESSION["login"]=$log;
//echo "</br>apres insertion";
header("location:../Vue/dashboard.php");
?>
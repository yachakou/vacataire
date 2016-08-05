<?php

function __autoload($class_name) {
    include $class_name . '.php';
}

session_start();
require_once("../Modele/Matiere.php");
require_once("../Modele/Enseignant.php");
require_once("./Connexion.php");


$droit=$_SESSION['status'];
$user=$_SESSION['login'];
$id=$_SESSION['idEnseignant'];

echo $droit;
echo $user;


$matiere=$_POST['name'];
$heureTD=$_POST['heureTD'];
$heureTP=$_POST['heureTP'];
$heureCM=$_POST['heureCM'];
$prof=$_POST['nomProf'];
$formation=$_POST['formation'];
$parcours=$_POST['parcours'];

print_r($_POST);

if($parcours=='Class')
{
    $par=1;
}
else { $par=2; }
if ($formation=='L3')
{
    $form=1;   
}
else if ($formation=='M1')
{
    $form=2;
}
else { $form=3; }


echo $form;
echo $par;

$enseignant = new Enseignant();

$pdo= new Connexion();

echo "apres enseignant";

$pdo2=$pdo->getPDO();


$enseignant->loadEnseignant($pdo2,$user);


print_r($enseignant);


$mat=new Matiere($matiere,$form,$par,$heureCM,$heureTD,$heureTP,$enseignant->getIdEnseignant());

print_r($mat);


$mat->addMatiere($pdo2);

header("location:../Vue/dashboard.php");




        






?>
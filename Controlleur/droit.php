<?php


require_once("../Modele/Enseignant.php");
require_once("./Connexion.php");
print_r($_POST);

$status=$_POST['status'];
$user=$_POST['user'];
if($status==-1)
{
   $parcours=$_POST['parcours'];
   $formation=$_POST['formation'];
    if($parcours==0)
    {
        if($formation==0)
        {
            $status=3;
        }
        else if($formation==1)
        {
            $status=5;
        }
        else
        {
            $status=7;
        }
        
    }
    else
    {
        if($formation==0)
        {
            $status=4;
        }
        else if($formation==1)
        {
            $status=6;
        }
        else
        {
            $status=8;
        }
        
    }
}


$pdo=new Connexion(); 
$enseignant = new Enseignant();
$pdo2=$pdo->getPDO();
$enseignant->loadEnseignant($pdo2, $user);
$enseignant->setIdStatus($status);
$enseignant->changerStatus($pdo2);
//print_r($enseignant);
header("location:../Vue/dashboard.php");
?>
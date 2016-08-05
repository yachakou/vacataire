<?php
require_once("../Modele/Enseignement.php");
require_once("../Controlleur/Connexion.php");
require_once("../Modele/Enseignant.php");


$pdo= new Connexion();
$pdo2=$pdo->getPDO();

echo 'ici';
print_r($_POST);
$type=$_POST['type'];
$nom=$_POST['name'];
$idmat=$_POST['idMat'];
$date=$_POST['date'];
$duree=$_POST['dure'];
$debut=$_POST['debut'];

print_r($_POST);




$enseignant= new Enseignant();
$enseignant->loadEnseignant($pdo2,$nom);

print_r($enseignant);

$enseignement1=new Enseignement($enseignant->getIdEnseignant(),$idmat);

print_r($enseignement1);

$enseignement1->addEnseignement($pdo2);




//0 : cm  1 : td  2 : tp
if($type=='CM')
{
    $val=0;
}
else if ($type=='TD'){
        $val=1;

    
}
else {
            $val=2;

}


$enseignement2=new Enseignement();

$id=$enseignement2->loadID($pdo2,$idMat,$idEns);

//echo $date;

$horaire=new Horaire($id,$date,$debut,$duree,$val);

print_r($horaire);

//$horaire->addHoraire($pdo2);

echo "fin";



?>

<?php


 
 function __autoload($class_name) {
    include $class_name . '.php';
}

require_once("../Modele/Enseignant.php");
require_once("../Modele/Matiere.php");
require_once("./Connexion.php");


$user='root';


echo $user;

$pdo=new Connexion();

echo "bonjour \n";

$pdo2=$pdo->getPDO();

$enseignant = new Enseignant();

$enseignant->loadEnseignant($pdo2,$user);

print_r($enseignant); 


$matiere='Algo';
$formation=1;
$parcours=1;

$heureTP=15;
$heureCM=15;
$heureTD=15;

//echo $heureCM;
//echo $matiere;
 $mat=new Matiere();
$mat=new Matiere($matiere,$formation,$parcours,$heureCM,$heureTD,$heureTP,$enseignant->getIdEnseignant());

print_r($mat);

  //$pdo2->exec("INSERT INTO Matiere(nom, id_formation, id_parcours, nbhCM, nbhTD, nbhTP, id_enseignant_resp) VALUES ('".$this->nom."' , ".$this->id_formation." , ".$this->id_parcours." , ".$this->nbhCM." , ".$this->nbhTD." , ".$this->nbhTP." , ".$this->id_enseignant_resp.") ");
               
//$mat->addMatiere($pdo2);





/*
$champ="idEnseignant";
$table="Enseignant";
$pdo=new Connexion();
echo "avant";
$pdo->RecupMax($champ,$table);
echo "aprés";

echo $max;

*/


?>
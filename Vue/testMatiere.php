<?php

 function __autoload($class_name) {
    include $class_name . '.php';
}

require_once("../Modele/Matiere.php");
require_once("../Controlleur/Connexion.php");

$pdo = new Connexion();

$matiere = new Matiere("JEE", 1, 2, 6, 6, 12, 24);

print_r($matiere);

$pdo2=$pdo->getPDO();

 
$matiere->addMatiere($pdo2);






/*
$val =$matiere->getID($pdo2);

$matiere->remove($pdo2,$val);

*/


?>
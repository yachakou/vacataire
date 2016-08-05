<?php

/*Synchonise le canlendrier et la base de donné */ 
session_start();
require_once("../Modele/Matiere.php");
require_once("../Modele/Enseignant.php");
require_once("./Connexion.php");

echo "debut!";
$pdo=new Connexion();
$pdo2=$pdo->getPDO();

$list = array();

$sql="select m.nom,h.heure,h.duree,h.day,h.typecours from Horaire h,Matiere m,Enseignement e
where e.idMatiere=m.id_mat
and h.idEnseignement=e.IdEnseignement";
$reponse=$pdo2->query($sql);

/*
$req="select m.nom from Matiere m,Horaire h,Enseignement e
where e.idMatiere=m.id_mat
and h.idEnseignement=e.IdEnseignement
and h.idHoraire= ".$val."");

*/
while($donnees = $reponse->fetch())
{
   /* array_push($list,$donnees['nom']);
    array_push($list,$donnees['day']);
    array_push($list,$donnees['heure']);
    array_push($list,$donnees['duree']);
    array_push($list,$donnees['typeCours']);
    */
    
   $date= $donnees['day']." ".$donnees['heure'].':00:00';
   $res=$donnees['heure']+$donnees['duree'];
   $fin= $donnees['day']." ".$res.':00:00';
    
    
    $reponse2=$pdo2->querry("Insert into jqcalendar(Subject,Location,Description,StartTime,EndTime,IsAllDayEvent,Color,RecurringRule) 
    values ('".$donnees['nom']."',"",'".$donnees['typeCours']."','".$date."','".$fin."',0,7,NULL)");
    
    
    echo $date.'</br>';  
    echo $fin.'</br>';
    $date="";
    $fin="";

}

echo "fin tranquille";

//print_r($list);
/*
INSERT INTO jqcalendar(
Subject,
Location,
Description,
StartTime,
EndTime,
IsAllDayEvent,
Color,
RecurringRule
)
VALUES (
"C++",  "",  "TP",  "2014-03-28 9:00:00",  "2014-03-28 12:00:00", 0, 7, NULL
)
*/


?>
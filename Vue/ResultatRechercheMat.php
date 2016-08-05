<?php
session_start();
$login=$_SESSION['login'];
require_once("../Controlleur/Connexion.php");
require_once("../Modele/Enseignant.php");

include "header.php"; 


//print_r($_POST);
$matiere=$_POST['mat'];
$formation=$_POST['type'];
$parcours=$_POST['form'];


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



/*
echo 'SELECT * 
FROM Matiere m, Horaire h, Enseignement a
and m.nom="'.$matiere.'"
and m.id_formation='.$form.'
and m.id_parcours='.$par.'
WHERE m.id_mat = a.IdMatiere 
AND a.idEnseignement = h.idEnseignement';

*/

?>

<html>
<head>
    <title>Resultat de la recherche </title>
</br>


 <div class="container">
        <div class="jumbotron">
            <center>
              <h2>Resultat de la recherche</h2>
              
            </center>
        </div>
        
                            
<?php

$pdo=new Connexion();
$pdo2=$pdo->getPDO();

if($formation=='null' && $parcours=='null')
{
    $sql= 'SELECT * 
FROM Matiere m, Horaire h, Enseignement a
where m.nom="'.$matiere.'"
and m.id_mat = a.IdMatiere 
AND a.idEnseignement = h.idEnseignement';
}
else if ($formation=='null' &&  $parcours!='null')
{
    $sql='SELECT * 
FROM Matiere m, Horaire h, Enseignement a
where m.nom="'.$matiere.'"
and m.id_parcours='.$par.'
and m.id_mat = a.IdMatiere 
AND a.idEnseignement = h.idEnseignement';
}
else if($parcours=='null' && $formation!='null')
{
     $sql='SELECT * 
FROM Matiere m, Horaire h, Enseignement a
where m.nom="'.$matiere.'"
and m.id_formation='.$form.'
and m.id_mat = a.IdMatiere 
AND a.idEnseignement = h.idEnseignement';
}
else {
    $sql='SELECT * 
FROM Matiere m, Horaire h, Enseignement a
where m.nom="'.$matiere.'"
and m.id_formation='.$form.'
and m.id_parcours='.$par.'
and m.id_mat = a.IdMatiere 
AND a.idEnseignement = h.idEnseignement';
}

//echo $sql;
$reponse = $pdo2->query($sql);

?>


<div class="container">
     
                <div class="panel panel-default">
                    <div class="panel-heading"><center><h2 class="panel-title">Liste des resultats de la recherche pour la matière <?php echo $matiere ?> </h2></center></div>
                    
<?php

  echo "<table class='table'>";
  
 echo "<thead><tr><th>Matiére</th><th>Formation</th><th>Parcours</th><th>Type de cours </th><th>Date</th><th>Durée</th> <th>Heure de début </th> <th>Enseignant responsable</th></tr></thead>";

while ($donnees = $reponse->fetch())
{
    $ens=new Enseignant();
    $ens->loadEnseignantID($pdo2,$donnees['idEnseignant']);
    echo "</td><td>".$donnees['nom']."</td><td>".formation($donnees['id_formation'])."</td><td>".parcours($donnees['id_parcours'])."</td><td>".cours($donnees['typrCours'])."</td><td> ".$donnees['day']."</td> <td> ".$donnees['duree']." heure(s) </td> <td> ".$donnees['heure']. " heure</td>
     <td> ".$ens->getPrenom()." ".$ens->getNom(); "</td> <td>";
       echo "</tr>";
}



function formation ($id_formation)
{
if ($id_formation==1)
{
return 'Licence 3';
}
if ($id_formation==2)
{
   return 'Master 1'; 
}
else { return 'Master 2'; }
 
}//formation

function parcours ($id_parcours)
{
    if($id_parcours==1) { return ' Classique';}

    else {return ' Alternance '; }

}//parcours 

function cours ($id_cours)
{
    if($id_cours==1)
    { return ' CM'; }
    else if ($id_cours==2)
    {
        return 'TD';
    }
    else {return 'TP';}
}




?>
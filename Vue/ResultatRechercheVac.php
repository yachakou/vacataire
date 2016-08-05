<?php
session_start();
$login=$_SESSION['login'];
require_once("../Controlleur/Connexion.php");
require_once("../Modele/Enseignant.php");
include "header.php"; 

$log=$_POST['user'];
//echo $log;
//echo $id;
//echo 'SELECT * FROM Enseignant where login="'.$log.'" ';

// echo 'SELECT * FROM Matiere m,Enseignement e where eIdEnseignant="'.$log.'" AND m.id_mat = e.idMatiere ';

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
        
        
<div class="container">
     
                <div class="panel panel-default">
                    <div class="panel-heading"><center><h2 class="panel-title">Profil de l'utilisateur <?php echo $log ?> </h2></center></div>
                    
<?php

$pdo=new Connexion();
$pdo2=$pdo->getPDO();

$reponse = $pdo2->query('SELECT * FROM Enseignant where login="'.$log.'" ');
  echo "<table class='table'>";
  
 echo "<thead><tr><th>Nom</th><th>Prenom</th><th>Email</th><th>NumArpége</th></tr></thead>";

while ($donnees = $reponse->fetch())
{
    echo "</td><td>".$donnees['nom']."</td><td>".$donnees['prenom']."</td><td>".$donnees['email']."</td><td>".$donnees['num_arpege']."</td><td>";
   // echo $donnees['login']..$donnees['prenom'].$donnees['email'];
       // $ligne=$donnees['login'].";".$donnees['nom'].";".$donnees['prenom'].";".$donnees['email'].";".$donnees['num_arpege'].";";
      $id=$donnees['idEnseignant'];
      $nom=$donnees['nom'];
      $prenom=$donnees['prenom'];

}

echo "</table>";

?>
</div>
     </div>

</br>
</br>


<div class="container">
     
                <div class="panel panel-default">
                    <div class="panel-heading"><center><h2 class="panel-title">Matiére enseigné par <?php echo $prenom." ".$nom ?> </h2></center></div>
                    
<?php
//$reponse2 = $pdo2->query('SELECT * FROM Matiere m,Enseignement e where e.IdEnseignant="'.$id.'" AND m.id_mat = e.idMatiere ');

$reponse2 = $pdo2->query('SELECT *
FROM Horaire h, Enseignement e, Matiere m
WHERE e.IdEnseignant = "'.$id.'"
AND m.id_mat = e.IdMatiere
AND h.idEnseignement = e.IdEnseignement');

/*
echo 'SELECT h.day, h.heure, h.duree, h.typeCours, m.nom
FROM Horaire h, Enseignement e, Matiere m
WHERE e.IdEnseignant = '.$id.'
AND m.id_mat = e.IdMatiere
AND h.idEnseignement = e.IdEnseignement';

$reponse2 = $pdo2->query('SELECT h.day, h.heure, h.duree, h.typeCours, m.nom
FROM Horaire h, Enseignement e, Enseignant a, Matiere m
WHERE e.IdEnseignant = "'.$id.'"
AND m.id_mat = e.IdMatiere
AND h.idEnseignement = e.IdEnseignement');



SELECT h.day, h.heure, h.duree, h.typeCours, m.nom
FROM Horaire h, Enseignement e, Matiere m
WHERE e.IdEnseignant =24
AND m.id_mat = e.IdMatiere
AND h.idEnseignement = e.IdEnseignement
 */
 

 echo "<table class='table'>";
 echo "<thead><tr><th>Matiere enseignée(s)</th><th>Formation</th><th>Parcours</th><th>Nombre heure(s) enseignée(s)</th><th>Type de cours  </th> <th>Date du cours</th> <th>Heure de debut </th></tr></thead>";

while ($donnee = $reponse2->fetch())
{
       // $ligne=$donnee['nom'].";".formation($donnee['id_formation']).";".parcours($donnee['id_parcours']).";".$donnee['nbhTD'].";".$donnee['nbhTP'].";".$donnee['nbhCM'].";".Enseignant($donnee['id_enseignant_resp']);
         
        //fputs($recap,$ligne);
       // fputs($recap,"\r\n");
     //  print_r($donnee);
           
    echo "<tr><td>".$donnee['nom']."</td><td>".formation($donnee['id_formation'])."</td><td>".parcours($donnee['id_parcours'])."</td><td>".$donnee['duree']." heure(s)</td><td>".cours($donnee['typeCours'])."</td><td>".$donnee['day']."</td> <td>".$donnee['heure']." heure </td><td>";
        echo "</tr>";

}
echo "</table>";

/*$enseignant = new Enseignant();

$enseignant->loadEnseignant();

print_r($enseignant);

*/




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

function Enseignant($id_resp)
{
    
    $pdo3=new Connexion();
    $pdo4=$pdo3->getPDO();
    $sql="SELECT nom,prenom FROM Enseignant where idEnseignant=" . $id_resp . ""; 
           //$resultats=$pdo->query("SELECT id_mat FROM Matiere where  nom='" . $this->nom . "' AND id_formation=". $this->id_formation ." AND id_parcours=" . $this->id_parcours ."  AND nbhCM=" . $this->nbhCM ." AND nbhTD=" . $this->nbhTD ."  AND nbhTP=" . $this->nbhTP ." AND id_enseignant_resp=" . $this->id_enseignant_resp ."");
           
            $resultats=$pdo4->query($sql);
           
            $resultats->setFetchMode(PDO::FETCH_OBJ);
            while( $resultat = $resultats->fetch() )
            {
            $nom=$resultat->nom;
            $prenom=$resultat->prenom;
            
            }
           //  echo $nom.$prenom'<br>';
           $blaze=$prenom." ".$nom;
           return $blaze;


    
}



?>
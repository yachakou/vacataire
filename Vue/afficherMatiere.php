
<?php 

require_once("../Controlleur/Connexion.php");
//require_once("../Modele/Matiere.php");
$pdo=new Connexion();
$pdo2=$pdo->getPDO();

$reponse2 = $pdo2->query('SELECT * FROM Matiere');
 echo "<table class='table'>";
 echo "<thead><tr><th>Matiere</th><th>Formation</th><th>Parcours</th><th>Nombre heure TD</th><th>Nombre heure TP </th><th>Nombre heure CM</th> <th>Professeur responsable</th></tr></thead>";
 $recap=fopen("recap.csv","w");
fputs($recap,"Matiere;Formation;Parcours;Nombre heure TD;Nombre heure TP;Nombre heure CM;Professeur responsable");
fputs($recap,"\r\n");
while ($donnees = $reponse2->fetch())
{
    
    $matiere=new Matiere(); 
    $id_mat=$donnees['id_mat'];
    $matiere->loadMatiere($pdo2,$id_mat);
    $m=0;
    if($matiere->getIdFormation()==1 && $matiere->getIdParcours()==1)//classL3
    {
        $m=3;
    }
    else if($matiere->getIdFormation()==1 && $matiere->getIdParcours()==2)//appL3
    {
        $m=4;
    }
    if($matiere->getIdFormation()==2 && $matiere->getIdParcours()==1)//classm1
    {
        $m=5;
    }
    else if($matiere->getIdFormation()==2 && $matiere->getIdParcours()==2)//appm1
    {
        $m=6;
    }
    if($matiere->getIdFormation()==3 && $matiere->getIdParcours()==1)//classm2
    {
        $m=7;
    }
    else if($matiere->getIdFormation()==3 && $matiere->getIdParcours()==2)//appm2
    {
        $m=8;
    }
        $ligne=$donnees['nom'].";".formation($donnees['id_formation']).";".parcours($donnees['id_parcours']).";".$donnees['nbhTD'].";".$donnees['nbhTP'].";".$donnees['nbhCM'].";".Enseignant($donnees['id_enseignant_resp'],$pdo2);
         
        fputs($recap,$ligne);
        fputs($recap,"\r\n");
        echo "<tr><td>".$donnees['nom']."</td><td>".formation($donnees['id_formation'])."</td><td>".parcours($donnees['id_parcours'])."</td><td>".$donnees['nbhTD']."</td><td>".$donnees['nbhTP']."</td><td>".$donnees['nbhCM']."</td><td>".Enseignant($donnees['id_enseignant_resp'],$pdo2)."</td><td><a href='apercuMatiere.php?id_mat=".$donnees['id_mat']."'>Aperçu</a></td><td>";
         if($_SESSION['status']==0 || $_SESSION['status']==2)
         {
            echo "<td><a href='formulaire/AjouterEnseignement.php?id_mat=".$donnees['id_mat']."'>Inscrire</a></td>";
         }
         else if($_SESSION['status']==$m)
         {
             echo "<td><a href='formulaire/AjouterEnseignement.php?id_mat=".$donnees['id_mat']."'>Inscrire</a></td>";
         }
         else
         {
             echo "<td></td>";
         }
        echo "</tr>";
}
 fclose($recap);
echo "</table>";

?>

<center><a href="recap.csv" class="btn btn-info">télécharger en csv</a></center>


<?php
/*


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
*/

 
?>


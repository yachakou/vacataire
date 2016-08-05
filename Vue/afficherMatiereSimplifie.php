
<?php 


//$pdo=new Connexion();
//$pdo2=$pdo->getPDO();

$reponse = $pdo2->query('SELECT * FROM Matiere');
 echo "<table class='table'>";
 echo "<thead><tr><th>Matiere</th><th>Formation</th><th>Parcours</th></tr></thead>";
 $recap2=fopen("recap2.csv","w");
fputs($recap2,"Matiere;Formation;Parcours;Nombre heure TD;Nombre heure TP;Nombre heure CM;Professeur responsable");
fputs($recap2,"\r\n");
while ($donnees = $reponse->fetch())
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
         
        fputs($recap2,$ligne);
        fputs($recap2,"\r\n");
        echo "<tr><td>".$donnees['nom']."</td><td>".formation($donnees['id_formation'])."</td><td>".parcours($donnees['id_parcours'])."</td><td><a href='apercuMatiere.php?id_mat=".$donnees['id_mat']."'>Aperçu</a></td><td>";
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
//$donnees->closeCursor();
 fclose($recap2);
echo "</table>";

?>

<center><a href="recap2.csv" class="btn btn-info">télécharger en csv</a></center>


<?php



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

function Enseignant($id_resp,$pdo2)
{
    
    //$pdo3=new Connexion();
    //$pdo4=$pdo3->getPDO();
    $sql="SELECT nom,prenom FROM Enseignant where idEnseignant=" . $id_resp . ""; 
           //$resultats=$pdo->query("SELECT id_mat FROM Matiere where  nom='" . $this->nom . "' AND id_formation=". $this->id_formation ." AND id_parcours=" . $this->id_parcours ."  AND nbhCM=" . $this->nbhCM ." AND nbhTD=" . $this->nbhTD ."  AND nbhTP=" . $this->nbhTP ." AND id_enseignant_resp=" . $this->id_enseignant_resp ."");
           
            //$resultats=$pdo4->query($sql);
           $resultats=$pdo2->query($sql);
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


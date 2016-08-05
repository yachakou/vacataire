<?php 


$reponse = $pdo2->query('SELECT * FROM Enseignant');
 echo "<table class='table'>";
 echo "<thead><tr><th>login</th><th>nom</th><th>prenom</th><th>email</th><th>numero arpège</th><th>status</th></tr></thead>";
 $recapV=fopen("recap_pseudo.csv","w");
fputs($recapV,"login;nom;prenom;email;numero arpège;status");
fputs($recapV,"\r\n");
while ($donnees = $reponse->fetch())
{
   // if($donnees['login']!="root")
   // {
         echo "<tr><td>".$donnees['login']."</td><td>".$donnees['nom']."</td><td>".$donnees['prenom']."</td><td>".$donnees['email']."</td><td>".$donnees['num_arpege']."</td><td>";
        $ligne=$donnees['login'].";".$donnees['nom'].";".$donnees['prenom'].";".$donnees['email'].";".$donnees['num_arpege'].";";
        fputs($recapV,$ligne);
       
         if($donnees['id_status']==0)
           {
            echo "<td>root</td>";   
            fputs($recapV,"root");
           }
           else if($donnees['id_status']==1)
           {
                echo "<td>vacataire</td>";
                fputs($recapV,"vacataire");
           }
           else if($donnees['id_status']==2)
           {
               fputs($recapV,"gestionnaire");
                echo "<td>gestionnaire</td>";
           }
           else if($donnees['id_status']==3)
           {
               fputs($recapV,"responsableL3Classique");
               echo "<td>responsableL3CLassique</td>";
           }
           else if($donnees['id_status']==4)
           {
               fputs($recapV,"responsableL3Apprentissage");
                echo "<td>responsableL3Apprentissage</td>";
           }
           else if($donnees['id_status']==5)
           {
               fputs($recapV,"responsableM1CLassique");
                echo "<td>responsableM1CLassique</td>";
           }
           else if($donnees['id_status']==6)
           {
               fputs($recapV,"responsableM1Apprentissage");
                echo "<td>responsableM1Apprentissage</td>";
           }
           else if($donnees['id_status']==7)
           {
               fputs($recapV,"responsableM2CLassique");
               echo "<td>responsableM2CLassique</td>";
           }
           else
           {
               fputs($recapV,"responsableM2Apprentissage");
                 echo "<td>responsableM2Apprentissage</td>";
           }
                  fputs($recapV,"\r\n");
                 echo "</tr>";
           // }
    
}
fclose($recapV);
echo "</table>";

?>
<center><a href="recap_pseudo.csv" class="btn btn-info">télécharger en csv</a></center>

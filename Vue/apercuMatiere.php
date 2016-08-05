
<?php
session_start();
$login=$_SESSION['login'];
require_once("../Modele/Enseignant.php");
require_once("../Modele/Matiere.php");
require_once("../Modele/Enseignement.php");
require_once("../Modele/Horaire.php");
require_once("../Controlleur/Connexion.php");

$id_mat=$_GET['id_mat'];
$pdo=new Connexion(); 
$pdo2=$pdo->getPDO();
$matiere=new Matiere(); 
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
//print_r($matiere);
$user=new Enseignant();
$user->loadEnseignant($pdo2,$login);
print_r($user);
$id_status=$user->getIdStatus();
function status($idstatus)
{
    
   if($idStatus==0)
   {
    $status="root";   
   }
   else if($idStatus==1)
   {
       $status="vacataire";
   }
   else if($idStatus==2)
   {
       $status="gestionnaire";
   }
   else if($idStatus==3)
   {
       $status="responsableL3CLassique";
   }
   else if($idStatus==4)
   {
       $status="responsableL3Apprentissage";
   }
   else if($idStatus==5)
   {
       $status="responsableM1CLassique";
   }
   else if($idStatus==6)
   {
       $status="responsableM1Apprentissage";
   }
   else if($idStatus==7)
   {
       $status="responsableM2CLassique";
   }
   else
   {
        $status="responsableM2Apprentissage";
   }
   return $status;
                     
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


function typeCours($typeCours)
{
    
    if($typeCours==0)
        return "CM";
    else if ($typeCours==1)
        return "TD";
    else if($typeCours==2)
        return "TP";
}   
?>

<html>
<head>
    <title>Tableau de bord | Gestion des vacataires</title>
    <style>
    #menuMatiere li
    {
    border:solid black 1px;
    padding:5px;
    }
    </style>
<?php include "header.php"; ?>
    

    </br>
    <?php
   
?>
    <div class="container" style="position:relative;">
        <div class="jumbotron">
            <center>
              <h2>Gestion des cours</h2>
              <p>Affichage du cours : <?php  echo $matiere->getNom()." ";echo formation($matiere->getIdFormation()); echo parcours($matiere->getIdParcours());?></p>
            </center>
        </div>


<?php
 //*************************************************************************************  MENU     ************************
echo "<div id='menuMatiere' style='position:absolute;right: -155px;
top: 210px;
font-size: 12px;
width: 200px;'>";
$sql = "SELECT * FROM Matiere";
            echo "<ul style='list-style-type:none;'>";
            echo "<li>MENU</li>";
            $resultats=$pdo2->query($sql);
            $resultats->setFetchMode(PDO::FETCH_OBJ);
            $idUser=array();
                while( $row = $resultats->fetch() )
                {
                  //print_r($row);
                   echo "<li><a href='apercuMatiere.php?id_mat=".$row->id_mat."'>".$row->nom." ".formation($row->id_formation)." ".parcours($row->id_parcours)."</a></li>";
                      
                }
               // print_r($idUser);
               echo "</ul></div>";
               
                $resultats->closeCursor();
//*******************************************************************************************   fin menu ********************************
$sql = "SELECT idEnseignant FROM Enseignant";
            
            
            $resultats=$pdo2->query($sql);
            $resultats->setFetchMode(PDO::FETCH_OBJ);
            $idUser=array();
                while( $row = $resultats->fetch() )
                {
                  
                   array_push($idUser,$row->idEnseignant);
                      
                }
               // print_r($idUser);
                $resultats->closeCursor();

$enseignantResponsable=new Enseignant();
$enseignantResponsable->loadEnseignantID($pdo2,$matiere->getIdEnseignantResp());
echo "<table class='table'>";
               echo "<thead><tr><th>nombre d'heures CM</th><th>nombre d'heures TD</th><th>nombre d'heures TP</th><th>Enseignant responsable </th></thead></tr>";
                 echo "<tr>";
                  echo "<td>".$matiere->getNbhCM()." Heures</td>";
                  echo "<td>".$matiere->getNbhTD()." Heures</td>";
                  echo "<td>".$matiere->getNbhTP()." Heures</td>";
                  echo "<td>".$enseignantResponsable->getLogin()."</td>";
                  if($id_status==0 || $id_status==2)
                  {
                     echo "<td><a href='formulaire/modifierMatiere.php?id_mat=".$id_mat."' >modifier</a></td>";
                  }
                  else if($id_status==$m)
                  {
                      echo "<td><a href='formulaire/modifierMatiere.php?id_mat=".$id_mat."' >modifier</a></td>";
                  }
                 echo "</tr>"; 
echo "</table>";

echo "<center><a href='formulaire/AjouterEnseignement.php?id_mat=".$id_mat."' class='btn btn-primary'>Inscrire un enseignant</a></center></br>";
?>

 <div class="jumbotron">
            <center>
              <p>Affichage des enseignements</p>
            </center>
        </div>
        
        
        <?php
  echo "<table class='table'>";
               echo "<thead><tr><th>login</th><th>nom</th><th>prenom</th><th>email</th><th>Date</th><th>Heure début</th><th>Durée</th><th>type de cours</th></tr></thead>";
for($i=0;$i<count($idUser);$i++)
{
    //echo $i;
    $sql = "SELECT *
    FROM Enseignement e, Enseignant e2, Matiere m, Horaire h
    WHERE e.idEnseignant = e2.idEnseignant
    AND m.id_mat = e.idMatiere and h.idEnseignement=e.idEnseignement and e.idEnseignant=".$idUser[$i]." and e.idMatiere=".$id_mat;
    // echo $sql;  
            
            $resultats=$pdo2->query($sql);
            $resultats->setFetchMode(PDO::FETCH_OBJ);
            $enseignant=new Enseignant();
            $enseignant->loadEnseignantID($pdo2,$idUser[$i]);
            while( $row = $resultats->fetch() )
                {
                    //print_r($row);
                 $idEnseignement=$row->idEnseignement;
                 echo "<tr>";  
                 echo "<td>".$row->login."</td>";
                 echo "<td>".$enseignant->getNom()."</td>";
                 echo "<td>".$row->prenom."</td>";
                  echo "<td>".$row->email."</td>";
                   echo "<td>".$row->day."</td>";
                    echo "<td> à ".$row->heure." Heures </td>";
                     echo "<td>".$row->duree." Heures</td>";
                     echo "<td>";echo typeCours($row->typeCours)."</td>";
                     
                     if($id_status==0 || $id_status==2)
                     {
                      echo "<td><a href='formulaire/modifierEnseignement.php?idEnseignement=".$row->idEnseignement."&amp;id_mat=".$id_mat."&amp;idEnseignant=".$idUser[$i]."'>modifier</a></td>";
                  
                      echo "<td><a href='../Controlleur/suppressionEnseignement.php?idEnseignement=".$row->idEnseignement."&amp;id_mat=".$id_mat."' class='glyphicon glyphicon-remove'></a></td>";
                     }
                     else if($id_status==$m)
                     {
                         echo "<td><a href='formulaire/modifierEnseignement.php?idEnseignement=".$row->idEnseignement."&amp;id_mat=".$id_mat."&amp;idEnseignant=".$idUser[$i]."'>modifier</a></td>";
                     }
                  echo "</tr>";  
                      
                }
                $resultats->closeCursor();
    /*echo $idEnseignement;
    $enseignement=new Enseignement();
    $enseignement->loadEnseignement($pdo2,$idUser[$i],$id_mat);
    print_r($enseignement);
    echo "<tr><td>".$enseignement->getIdMatiere()."</td><td>".$enseignement->getIdEnseignant()."</td></tr>";
    */
    
}
echo "</table>";


//$enseignement->loadEnseignement($pdo2,$id_mat);
//$enseignant->loadEnseignant($pdo2, $user);
//print_r($enseignant);

include "footer.php";
?>
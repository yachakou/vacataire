<?php include "../header.php"; ?>


 <div class="container">
        <div class="jumbotron">
            <center>
              <h2>Supression d'une matière</h2>
              
            </center>
        </div>
        

<div class="container">
     
                <div class="panel panel-default">
                    <div class="panel-heading"><center><h2 class="panel-title">Selectionez la matière</h2></center></div>
                    

                    <div class="panel-body">
                        <form id='f1' method='post' action="../../Controlleur/supressionCours.php" onsubmit="return verif2(this)"></br>
                        	<fieldset>
                        	
                        	
                            <center>  <div class="input-group"><label for="mat">Matière</label><br /> <select name="mat" id="mat">

<?php
require_once("../../Modele/Matiere.php");
require_once("../../Controlleur/Connexion.php");
/*****AFFICHAGE des matière selon le type de droit ******/
if ($_SESSION['status']==0 || $_SESSION['status']==2)
{
    $sql = 'Select * from Matiere';
}
else if($_SESSION['status']==3)
{
    $sql=('Select * from Matiere where id_parcours=1 and id_formation=1');
}
else if($_SESSION['status']==4)
{
     $sql=('Select * from Matiere where id_parcours=2 and id_formation=1');
}
else if($_SESSION['status']==5)
{
  $sql=('Select * from Matiere where id_parcours=1 and id_formation=2');
}
else if($_SESSION['status']==6)
{
  $sql=('Select * from Matiere where id_parcours=2 and id_formation=2');
}
else if($_SESSION['status']==7)
{
  $sql=('Select * from Matiere where id_parcours=1 and id_formation=3');
}
else if($_SESSION['status']==8)
{
  $sql=('Select * from Matiere where id_parcours=2 and id_formation=3');
}

$pdo=new Connexion();
$pdo2=$pdo->GetPDO();
$reponse = $pdo2->query($sql);
 
while ($donnees = $reponse->fetch())
{
    
?>
   <center> <option value="<?php echo $donnees['id_mat'].";".$donnees['id_parcours'].";".$donnees['id_formation']; ?>"> <?php echo $donnees['nom']."  ".parcours($donnees['id_parcours'])." ".formation($donnees['id_formation']) ?>  </option> </center>
    
<?php
    }

?> 
</select>
</br>
 </br>
        <!--
<center>  <div class="input-group"><label for="mat">Formation</label><br />
  <select name="formation">
        <?php
        //if($_SESSION['status']==3 || $_SESSION['status']==4)
         //   echo '<option value="L3">Licence 3</option> ';
        //else if($_SESSION['status']==5 || $_SESSION['status']==6)
            // echo '<option value="M1" selected>Master 1</option>';
        //else if($_SESSION['status']==7 || $_SESSION['status']==8)
          //  echo '<option value="M2">Master 2</option>';
        ?>
        </select>

        </br>
                </br>

   <center>  <div class="input-group"><label for="mat">Parcours</label><br />
        <select name="parcours">
        <?php
          //  if($_SESSION['status']==3 || $_SESSION['status']==5 || $_SESSION['status']==7)
             //   echo '<option value="Class" selected>Classique</option>';
          //   else  
              //   echo '<option value="Alt">Alternance</option>';
        ?>
                                        </select>

                                </br>
                                  </br>
                </br>
            -->
                                 
                               <center><input type="submit" class="btn btn-default" value="Supprimer" ></center>
                        	</fieldset>
                        </form>
                    </div>
                </div>
            </div>
            
            
<div class="container">
     
                <div class="panel panel-default">
                    <div class="panel-heading"><center><h2 class="panel-title"  style ="color:red"><span class="glyphicon glyphicon-exclamation-sign"></span> Attention</h2></center></div>
                    </br>
                   <center> <p  style= "font-size: 17 ;font-family:georgia  ; color:red ; ">Si vous suprimmez une matière, tout les einseignant ainsi que les enseignement y faisant référence seront suprimmer !</p> </center>
                    </br>
                    </div>
                    </div>
            
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
?>
            
        
<?php
session_start();
$login=$_SESSION["login"];
print_r($_GET);
$error=$_GET['error'];
?>
<html>
<head>
    <title>Tableau de bord | Gestion des vacataires</title>
<?php include "header.php"; ?>
    

    <div class="container">
        <div class="jumbotron">
            <center>
              <h2>Erreur</h2>
              
            </center>
        </div>
        
        <div id="error">
            <center><p style="color:red;"><?php 
            
                if($error==1)
                {
                     echo "Vous ne pouvez pas modifiez ce cours, car la date du cours et l'heure est déjà pourvu par un autre cours dans la même formation";  
                }
                else if($error==2 )
                {
                    echo "Vous ne pouvez pas modifiez ce cours car la date et l'heure est sur le créneau d'un autre cours de la même formation";   
                }
                else if($error==4)
                {
                    echo "Vous ne pouvez pas modifiez ce cours car l'utilisateur dépassera le nombre d'heure qu'il doit atteindre";   
                }
            
            ?></p>
            <a href="
            <?php 
                //if(!(empty($_GET['id_mat']))
                //{
                    $id_mat=$_GET['id_mat'];
                    echo "apercuMatiere.php?id_mat=".$id_mat;
                //}
            
            ?>">Revenir</a>
            </center>
        </div>
<?php 
    // Tout début du code PHP. Situé en haut de la page web
ini_set("display_errors",0);error_reporting(0);
     session_start();
    $login=$_SESSION["login"];
    require_once("../Modele/Enseignant.php");
    require_once("../Controlleur/Connexion.php");
    require_once("../Modele/Matiere.php");
    include("../Controlleur/pChart.1.27d/pChart/pData.class");  
 include("../Controlleur/pChart.1.27d/pChart/pChart.class"); 
 
    $pdo=new Connexion(); 
    $enseignant = new Enseignant();
    $pdo2=$pdo->getPDO();
    $enseignant->loadEnseignant($pdo2, $login);
    //print_r($enseignant);
    $id=$enseignant->getIdEnseignant();
   $id_status=$_SESSION['status'];

    print_r($_SESSION);    
    
    

?>

<html>
<head>
    <title>Tableau de bord | Gestion des vacataires</title>
<?php include "header.php"; ?>

 <div class="container">
        <div class="jumbotron">
            <center>
              <h2>Statistiques : </h2>
            </center>
        </div>
    <div>
        
        <?php if($id_status!=0) {include "camembert.php";}
            if($id_status==0 || $id_status==2) {include "grapheBar.php";}
        ?>
        
    </div>
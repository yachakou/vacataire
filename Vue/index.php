<?php 
// Tout début du code PHP. Situé en haut de la page web
ini_set("display_errors",0);error_reporting(0);
require_once("../Controlleur/Connexion.php");


    session_start();
    //print_r($_SESSION);
    $login=$_SESSION["login"];
    
   // $pdo=new Connexion ();
    

    
?>
<html>
<head>
    <title>Tableau de bord | Gestion des vacataires</title>
<?php include "header.php"; ?>
<div class="container">
<img src="../images/nanterre.jpg" alt="nanterre" class="img-responsive">
</div>

<?php include "footer.php" ?>

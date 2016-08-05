<?php
require_once("../Modele/Email.php");
require_once("../Modele/Enseignant.php");
require_once("../Controlleur/Connexion.php");

//print_r($_GET);
$idmail=$_GET['idmail'];
$idEmetteur=$_GET['idEmetteur'];
$idRecepteur=$_GET['idRecepteur'];
$objet=$_GET['objet'];
$date=$_GET['date'];
$message=$_GET['message'];

$pdo=new Connexion();
$pdo2=$pdo->getPDO();
$enseignant2=new Enseignant();
$enseignant2->loadEnseignantID($pdo2,$idEmetteur);
$loginEmetteur=$enseignant2->getLogin();
?>
<link rel="stylesheet" href="../Controlleur/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../Controlleur/bootstrap/css/bootstrap-theme.min.css">
 <style>
    div
    {
        font-size: 20px;
    }
 
 </style>


<body>
<div class="container">
    <div class="jumbotron">
            <center>
              <p>Votre message</p>
            </center>
        </div>
<?php
echo "<div id='emetteur'>";
echo "Emetteur : ".$loginEmetteur;
echo "</div>";

echo "<div id='objet'>";
echo "Objet : ".$objet;
echo "</div>";

echo "<div id='date'>";
echo "Date : ".$date;
echo "</div>";

echo "</br>";
echo "<div id='message'>";

echo "message : </br></br>".$message;
echo "</div>";

?>
</div>
</body>
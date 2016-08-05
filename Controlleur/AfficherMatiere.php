<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans titre</title>
</head>
 
 <?php

function __autoload($class_name) {
    include $class_name . '.php';
    }

session_start();
require_once("../Modele/Matiere.php");
require_once("../Modele/Enseignant.php");
require_once("./Connexion.php");

?>

<body>
<?php
try
{
    $pdo = new Connexion();
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
?>
<form method="post" action="??.php">
 
    <label for="matiere">Matiere</label><br />
     <select name="matiere" id="mat">
 
<?php
 
 $pdo2=$pdo->GetPDO();
$reponse = $pdo2->query('SELECT * FROM Matiere');
 
while ($donnees = $reponse->fetch())
{
?>
    <option value="<?php echo $donnees['Matiere']; ?>"> <?php echo $donnees['nom'].formation($donnees['id_formation']).parcours($donnees['id_parcours']); ?>  </option>
    
<?php
}


function formation ($id_formation)
{
    if ($id_formation==1)
{
return ' Licence 3';
}
else if ($id_formation==2)
{
   return ' Master 1'; 
}
else { return ' Master 2'; }
 
}//formation

function parcours ($id_parcours)
{
    if($id_parcours==1) { return ' Classique';}

    else {return ' Alternance '; }

}//parcours 


 
?>
</select>
 
</form>
</body>
</html>
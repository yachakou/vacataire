<?php

require_once("./Connexion.php");
require_once("../Modele/Enseignement.php");
require_once("../Modele/Horaire.php");

print_r($_POST);


$idEns=$_POST['idEns'];
$idMat=$_POST['idMat'];
$type=$_POST['type'];
//0 : cm  1 : td  2 : tp
if($type=='CM')
{
    $val=0;
}
else if ($type=='TD'){
        $val=1;

    
}
else {
            $val=2;

}


$date=$_POST['date'];
$duree=$_POST['dure'];
$debut=$_POST['debut'];

$pdo =new Connexion();

$pdo2=$pdo->getPDO();
$enseignement=new Enseignement();

$id=$enseignement->loadID($pdo2,$idMat,$idEns);

echo $date;

$horaire=new Horaire($id,$date,$debut,$duree,$val);

print_r($horaire);

$horaire->addHoraire($pdo2);

echo "fin";


?>

<script>
alert('Matiere ajouté avec succés');

</script>

<?php
header("location:../Vue/dashboard.php");
?>








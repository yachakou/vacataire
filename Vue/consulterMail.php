<?php
require_once("../Modele/Email.php");
require_once("../Modele/Enseignant.php");
require_once("../Controlleur/Connexion.php");
session_start();
?>


<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="../Controlleur/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

<!-- Add fancyBox -->
<link rel="stylesheet" href="../Controlleur/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="../Controlleur/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="../Controlleur/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="../Controlleur/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="../Controlleur/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<link rel="stylesheet" href="../Controlleur/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="../Controlleur/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<script type="text/javascript">
$(document).ready(function() {
	$('.fancybox').fancybox({
		//'width'             : 500,
        //'height'            : 300,
        'autoSize'         : true,
        'transitionIn'      : 'elastic',
        'transitionOut'     : 'elastic',
        'type'              : 'iframe'
	});
});
</script>

<div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Consulter vos mails</div>
                    <div class="panel-body">
                    

<?php

$pdo=new Connexion();
$pdo2=$pdo->getPDO();
$enseignant=new Enseignant();
$enseignant->loadEnseignant($pdo2, $login);
$id=$enseignant->getIdEnseignant();
//print_r($enseignant);
//echo "SELECT * FROM Mail where idRecepteur=".$id;
$reponse = $pdo2->query('SELECT * FROM Mail where idRecepteur='.$id);
 echo "<table class='table'>";
 echo "<thead><tr><th>Emetteur</th><th>Objet</th><th>date</th></tr></thead>";
while ($donnees = $reponse->fetch())
{
    //print_r($donnees);
    $enseignant1=new enseignant();
    $user=$donnees['idEmetteur'];
    $enseignant1->loadEnseignantID($pdo2, $user);
    $login1=$enseignant1->getLogin();
    //echo $login1;
     echo "</tr><td>".$login1."</td><td>".$donnees['objet']."</td><td>".$donnees['date']."</td><td><a href='lireMail.php?idmail=".$donnees['idMail']."&amp;idEmetteur=".$donnees['idEmetteur']."&amp;idRecepteur=".$donnees['idRecepteur']."&amp;objet=".$donnees['objet']."&amp;message=".$donnees['message']."&amp;date=".$donnees['date']."'  class='fancybox'>consulter</a></td><td><a href='../Controlleur/supprimerMail.php?idMail=".$donnees['idMail']."' class='glyphicon glyphicon-remove'></a></td></tr>";
           // }
    
}
echo "</table>";
?>
                    
                    
                    
                    </div>
        
</div>  


                    
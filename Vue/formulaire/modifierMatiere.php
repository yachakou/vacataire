

<?php

//*************************************************************************commmencer mais inutile car si on modifie les nbh heures sa peut créer des conflit avec les enseignements.


session_start();
$login=$_SESSION['login'];
//print_r($_GET);

$id_mat=$_GET['id_mat'];

require_once("../../Modele/Matiere.php");
require_once("../../Controlleur/Connexion.php");
require_once("../../Modele/Enseignant.php");    

$pdo=new Connexion();
$pdo2=$pdo->getPDO();

$matiere=new Matiere();
$matiere->loadMatiere($pdo2,$id_mat);
print_r($matiere);
$nom=$matiere->getNom();
$nbhcm=$matiere->getNbhCM();
$nbhtd=$matiere->getNbhTD();
$nbhtp=$matiere->getNbhTP();
$id_ens_res=$matiere->getIdEnseignantResp();
$enseignant=new Enseignant();
$enseignant->loadEnseignantID($pdo2,$id_ens_res);
print_r($enseignant);
 
?>

    <title>Profil de <?php echo $login; ?> | Gestion des vacataires</title>
    <?php include "../header.php"; ?>

    <div class="container">
        <div class="jumbotron">
            <center>
              <h2>Modifier Matiere</h2>
            </center>
        </div>


    <div id="form">
            <div class="panel panel-default">
                <div class="panel-heading"><center>Modifier matière</center></div>
                 <div class="panel-body">
                 <form id='f2' method='post' action="../Controlleur/modifMatiere.php" onSubmit=""></br>
        				<fieldset>
                            <div class="input-group"><span class="input-group-addon">Nom</span> <input type='text' class="form-control" name='nom' required value="<?php echo $nom?>"></div></br>
                            <div class="input-group"><span class="input-group-addon">nombre d'heures CM</span> <input type='number' class="form-control" name='nbhCM' required value="<?php echo $nbhcm?>"></div></br>
        			         <div class="input-group"><span class="input-group-addon">nombre d'heures TD</span> <input type='number' class="form-control" name='nbhTD' required value="<?php echo $nbhtd?>"></div></br>
        			         <div class="input-group"><span class="input-group-addon">nombre d'heures TP</span> <input type='number' class="form-control" name='nbhTP' required value="<?php echo $nbhtp?>"></div></br>
        			        
        			        <center><input type="submit" class="btn btn-default" value="Soumettre" ></center>
        				</fieldset>
        			</form>
        		</div>
        		</div>
        	</div>
        	</div>
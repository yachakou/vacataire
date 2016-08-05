<?php 

// Tout début du code PHP. Situé en haut de la page web
ini_set("display_errors",0);error_reporting(0);

    //PB en cas dinscription : obliger de charger un enseignant pour obtenir l'idEnseignant car il es auto_incrémenter dans la BD, j'ai essayer avec recupMax, sof ke lorsque kon fai une suppresion puis un ajout, la bd va incrémenter alors kon recupere le max
    session_start();
    $login=$_SESSION["login"];
    require_once("../Modele/Enseignant.php");
    require_once("../Controlleur/Connexion.php");
    
    require_once("../Modele/Matiere.php");
    $pdo=new Connexion(); 
    $enseignant = new Enseignant();
    $pdo2=$pdo->getPDO();
    $enseignant->loadEnseignant($pdo2, $login);
    //print_r($enseignant);
    $id=$enseignant->getIdEnseignant();
    $_SESSION['idEnseignant']=$id;
    print_r($_SESSION);    
    
    

?>

<html>
<head>
    <title>Tableau de bord | Gestion des vacataires</title>
<?php include "header.php"; ?>
<script type="text/javascript">
function affiche()
            {
                 if(document.getElementById("vac").style.display=="none")
                    {
                        document.getElementById("vac").style.display="block";
			document.getElementById("vac-button").value="Masquer la liste des vacataires";
    
                    }
                    else
                    {
                        document.getElementById("vac").style.display="none";
			document.getElementById("vac-button").value="Afficher la liste des vacataires";
                    }
                             return true;
            }
</script>

<script type="text/javascript">
function afficheMatiere()
            {
                 if(document.getElementById("mat").style.display=="none")
                    {
                        document.getElementById("mat").style.display="block";
			document.getElementById("mat-button").value="Masquer la liste des cours";
    
                    }
                    else
                    {
                        document.getElementById("mat").style.display="none";
			document.getElementById("mat-button").value="Afficher la liste des cours";
                    }
                             return true;
            }
            
             function colore(champ,erreur)
            {
                if(erreur)
                    //border-color: #a94442;
                   // champ.style.backgroundColor = "#fba";
                   champ.style.borderColor="#a94442";
                else
                    //champ.style.backgroundColor = "";
                    champ.style.borderColor="#3c763d";
            }
</script>



    <div class="container">
        <div class="jumbotron">
            <center>
              <h2>Tableau de bord</h2>
              <p>Gérer et inscrire des cours</p>
            </center>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
               <div class="panel-heading"><center><h2 class="panel-title">Cours</h2></center></div>
                    
                    <?php include "afficherMatiereSimplifie.php"; ?>

                </div>
            </div>
            
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading"><center><h2 class="panel-title">Inscrire un cours</h2></center></div>
                    
                    <?php
                    if($_SESSION['status']==0 || $_SESSION['status']==2)
                    {
                       echo "<div class='panel-body'>"; include "./formulaire/creer_cours.php";echo"</div>"; 
                  //  echo "<div class='panel-body'>"; include "./formulaire/supression_cours.php";echo"</div>";  

                       
                    }

                    else if($_SESSION['status']!=1 && $_SESSION['status']!=0 && $_SESSION['status']!=2)
                    {
                      
                      echo "<div class='panel-body'>"; include "./formulaire/creer_cours_responsables.php";  
                      echo"</div>";
                      
                    }
                    
                    ?>
                    
                </div>
            </div>
        </div>
        <div class="container">
            <div class="jumbotron">
             <center>
                 <h2>Rechercher des vacataires</h2>
               <p>Entrez votre recherche dans les champs correspondants</p>
            </center>
             </div>


             <center><input type="submit" class="btn btn-primary" id="vac-button" value="Afficher la liste des vacataires" onclick="affiche()"></center>
             </br>
             <div id="vac" style="display : none;">
                <div class="panel panel-default">
                            <div class="panel-heading">
                                <center>Vacataire</center>
                            </div>
                            <div class="panel-body">
                                  <?php include"afficheVacataire.php";?>
                    	    </div>
        		 </div>
        	</div>
        	
        	
        	 </div>
             <center><input type="submit" class="btn btn-primary" id="mat-button" value="Afficher la liste des cours" onclick="afficheMatiere()"></center>
             </br>
             <div id="mat" style="display : none;">
                <div class="panel panel-default">
                            <div class="panel-heading">
                                <center>Cours</center>
                            </div>
                            <div class="panel-body">
                                  <?php include"afficherMatiere.php";?>
                    	    </div>
        		 </div>
        	</div>
        	
        	
        	
        	
        </div>
        <?php //include "formulaire_recherche_cours.php";     //*****************************************pas encore fait     ?>

	<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">
			<?php //include "cours_libre.php"; ?>
		</div>
	</div>
	</div>
        
        
    </div>

<?php //include "formulaire_recherche.php";                  //**************************************pas encore fait
        
        if($login=="root"){
            echo '<div class="container" id="root">
                <div class="jumbotron">
                   <center>
                       <h2>Menu <b>Root</b></h2>
                     <p>Vous disposez de droits supplémentaires</p>
                     </center>
              </div>
              <div class="row">';
        include "./formulaire/suppression_user.php";
        include "formulaire/droit.php";
        include "formulaire/supression_cours.php";
        }
        
?>



  <?php include "footer.php"; ?>
      
      


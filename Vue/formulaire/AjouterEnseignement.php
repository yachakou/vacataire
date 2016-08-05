<?php



require_once("../../Modele/Matiere.php");
require_once("../../Controlleur/Connexion.php");
session_start();
$login=$_SESSION['login'];
$pdo= new Connexion();
$pdo2=$pdo->getPDO();

$matiere=$_GET['id_mat'];
//print_r($_GET);

$mat=new Matiere();

$mat->loadMatiere($pdo2,$matiere);

?>

  <script src="../../jquerry/jquery-ui-1.9.2/jquery-1.8.3.js"></script>
  <script type="text/javascript" src="../../Controlleur/autocomplete/jquery.autocomplete.js"></script>
  
  <script>
  
  
$(document).ready(function() {
    $('#langages').autocomplete('Recherche.php');
    
});
</script>

  
<script type="text/javascript">
function affiche()
            {
                 if(document.getElementById("formu").style.display=="none")
                    {
                        document.getElementById("formu").style.display="block";
			document.getElementById("test").value="Masquer le formulaire";
    
                    }
                    else
                    {
                        document.getElementById("formu").style.display="none";
			document.getElementById("test").value="Afficher le formulaire";
                    }
                             return true;
            }
            
</script>


<html>
<head>
<link rel="stylesheet" href="../../Controlleur/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../../Controlleur/bootstrap/css/bootstrap-theme.min.css">
</head>
<nav class="navbar navbar-default" role="navigation">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php if(empty($login)){echo "index.php";} else {echo "../dashboard.php";} ?>">Gestion des vacataires - UFR SEGMI</a>
            
      </div>
      
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <?php if(!empty($login)){echo "<li"; if (basename($_SERVER['PHP_SELF']) == "dashboard.php") { echo " class='active'"; } echo "><a href='../dashboard.php'><span class='glyphicon glyphicon-dashboard'></span> Tableau de bord</a></li>";} ?> 
        </ul>
        
        <ul class="nav navbar-nav navbar-right">
            <?php if (basename($_SERVER['PHP_SELF']) == "index.php") { echo '
                <li><a href="formulaire/formulaire_connection.php" class="iframe"  ><span class="glyphicon glyphicon-globe"></span> Connection</a></li>
                <li><a href="formulaire/formulaire_inscription.php" class="iframe" ><span class="glyphicon glyphicon-send"></span> Inscription</a></li> 
            '; } ?>
        
            <?php if(!empty($login)) {
                 echo '<li><a href="../webmail.php"><span class="glyphicon glyphicon-envelope"></span> webmail</a></li>';
                echo "
                    <li class='dropdown"; if (basename($_SERVER['PHP_SELF']) == "profil.php") { echo " active"; } echo"'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-user'></span> $login <b class='caret'></b></a>
                        <ul class='dropdown-menu'>
                          <li><a href='../profil.php'>Afficher votre profil</a></li> <li><a href='../Controlleur/deconnexion.php'>Déconnexion</a></li>";
            }?>
        </ul>
      </div>
    </nav>
    <div class="container">
     
                <div class="panel panel-default">
                    <div class="panel-heading"><center><h2 class="panel-title">Ajouter un enseignement pour la matiére <?php echo $mat->getNom(); ?></h2></center></div>
                    

                        </br>
                        </br>
  <form method='POST' action='../../Controlleur/InscrireMatiere.php' id='f1' >

                        
<center><label>Entrez le nom d'un ensignant :  </label> <input type="text" id="langages" name='name' /></center>



<fieldset>
                            <center>  <div class="input-group"><label for="user">User</label><br /> <select name="user" id="user"></center>
                              
                              
                              
<?php


//$pdo2=$pdo->GetPDO();
$reponse = $pdo2->query('SELECT * FROM Enseignant');
 
while ($donnees = $reponse->fetch())
{
    if($donnees['login']!="root")
    {
?>
   <center> <option value="<?php echo $donnees['login']; ?>"> <?php echo $donnees['login'] ?>  </option> </center>
    
<?php
    }
}
?>  
                              </select></div></br>










 </br>
 <center><input type="submit" class="btn btn-default" value="Afficher le formulaire" id="test" onclick="affiche()" ></center>

</br>
</br>
             <div id="formu" style="display : none;">
    </br>
    </br>
                <div class="panel panel-default">
                            <div class="panel-heading">
                                <center>Horaires</center>
                            </div>
                            <div class="panel-body">
                            
<div class="input-group"><input type='date' class="form-control" name='date' placeholder="Date"  required><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></br>
<div class="input-group"><input type='number' class="form-control" name='dure' placeholder="Duré"  required><span class="input-group-addon"  min="1" max="8" ><span class="glyphicon glyphicon-time"></span></span></div></br>

<div class="input-group"><input type='number' class="form-control" name='debut' placeholder="Heure de debut" min="0" max="15"  required><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></br>

     <center>   <label>Type de cours</label>
        <select name="type">
        <option value="TD">TD</option> 
        <option value="TP" selected>TP</option>
        <option value="CM" selected>CM</option>
        </select>
        </center>
        </br>
        
        <input type="text" name="idMat" id="idMat" value="<?php echo $matiere ?>"  style="display: none"  />

         <center><input type="submit" class="btn btn-default" value="Ajouter" ></center>

<input type="text" name="idEns" id="idEns" value="<?php echo $enseignant->getIdEnseignant() ?>" style="display: none"  />

       



                    	    </div>
        		 </div>
        	</div>





</br>
</br>
</br>


</div>


      </form> 
                        
</html>




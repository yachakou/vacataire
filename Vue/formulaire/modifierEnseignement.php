<?php
session_start();
$login=$_SESSION['login'];
//print_r($_GET);
$idEnseignement=$_GET['idEnseignement'];
$id_mat=$_GET['id_mat'];
$idEnseignant=$_GET['idEnseignant'];

require_once("../../Modele/Matiere.php");
require_once("../../Controlleur/Connexion.php");
require_once("../../Modele/Enseignement.php");    

$pdo=new Connexion();
$enseignement = new Enseignement();
$pdo2=$pdo->getPDO();
$enseignement->loadEnseignementID($pdo2, $idEnseignement);
//print_r($enseignement);

$sql = "SELECT *
    FROM Enseignement e, Enseignant e2, Matiere m, Horaire h
    WHERE e.idEnseignant = e2.idEnseignant
    AND m.id_mat = e.idMatiere and h.idEnseignement=e.idEnseignement and e.idEnseignement=".$idEnseignement;
    // echo $sql;  
            
            $resultats=$pdo2->query($sql);
            $resultats->setFetchMode(PDO::FETCH_OBJ);
            while( $row = $resultats->fetch() )
                {
                    //print_r($row);
                     $login=$row->login;
                     $nom=$row->nom;
                     $day=$row->day;
                     $duree=$row->duree;
                     $heure=$row->heure;
                }
                $resultats->closeCursor();
?>

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
    <script type="text/javascript">
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
    
    function verifnb(champ)
    {
        if(champ.value.length===0 || champ.value<=0)
                 {
                     colore(champ, true);
                     return false;
                 }
                 else
                   {
                      colore(champ, false);
                      return true;
                   }
    
    }
    function verif(f)
    {
    
        var erreur="";
        var duree=verifnb(f.dure);
        if(duree!==true)erreur=f.dure;
        var heure=verifnb(f.debut);
        if(heure!==true)erreur=f.debut;
        if(duree && heure)
            return true;
        else
        {
            alert("Erreur de modification, veuillez remplir les champs en rouge (les chiffres ne peuvent être inférieur ou égale à 0)");
            erreur.focus();
            return false;
        }
    }
</script>
    <div class="container">
     
                <div class="panel panel-default">
                    <div class="panel-heading"><center><h2 class="panel-title">Modifier l'enseignement : <?php //echo $mat->getNom(); ?></h2></center></div>
                    

                        </br>
                        </br>
  <form method='POST' action='../../Controlleur/ModifierEnseignement.php' id='f1'onsubmit="return verif(this);" >

                        
<center><label>Entrez le nom d'un enseignant : </label><input type="text" id="langages" name='name' value='<?php echo $login;?>'/></center>

 </br>
 
</br>
</br>
             <div id="formu" >
    </br>
    </br>
                <div class="panel panel-default">
                            <div class="panel-heading">
                                <center>Horaires</center>
                            </div>
                            <div class="panel-body">
                            
<label for"date">Entrez la date : </label><div class="input-group"><input id="date" type='date' class="form-control" name='date' placeholder="Date" required value='<?php echo $day;?>'><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></br>
<label for"dure">Entrez La durée du cours : </label><div class="input-group"><input id="dure" type='number' class="form-control" name='dure' onblur="verifnb(this);" placeholder="Duré" value='<?php echo $duree;?>' required><span class="input-group-addon"  min="1" max="8" ><span class="glyphicon glyphicon-time"></span></span></div></br>

<label for"debut">Entrez l'heure de début : </label><div class="input-group"><input id="debut" type='number' class="form-control" name='debut'  onblur="verifnb(this);" placeholder="Heure de debut" min="0" max="15" value='<?php echo $heure;?>' required><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></br>

     <center>   <label>Type de cours</label>
        <select name="type">
        <option value="TD">TD</option> 
        <option value="TP" selected>TP</option>
        <option value="CM" selected>CM</option>
        </select>
        </center>
        </br>
         <center><input type="submit" class="btn btn-default" value="Modifier" ></center>

<input type="text" name="idMat" id="idMat" value="<?php echo $id_mat; ?>"  style="display: none"  />
<input type="text" name="idEns" id="idEns" value="<?php echo $idEnseignant; ?>" style="display: none"  />
<input type="text" name="idEnseignement" value="<?php echo $idEnseignement;?>" style="display:none" />



                    	    </div>
        		 </div>
        	</div>





</br>
</br>
</br>


</div>


      </form> 

</html>

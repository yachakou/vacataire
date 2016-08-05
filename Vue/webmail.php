<?php
// Tout début du code PHP. Situé en haut de la page web
ini_set("display_errors",0);error_reporting(0);
session_start();
$login=$_SESSION['login'];

?>
<html>
<head>
<title>Tableau de bord | Gestion des vacataires</title>
<!--http://hackerwins.github.io/summernote/features.html-->


 <!-- include jquery -->
  <script src="//code.jquery.com/jquery-1.9.1.min.js"></script> 

  <!-- include libraries BS3 -->
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" />
  <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />

  <!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js)-->
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.min.css" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/blackboard.min.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/monokai.min.css">
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/xml/xml.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/2.36.0/formatting.min.js"></script>

  <!-- include summernote -->
  <link rel="stylesheet" href="../Controlleur/summernote-master/dist/summernote.css">
  <script type="text/javascript" src="../Controlleur/summernote-master/dist/summernote.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('.summernote').summernote({
       
        height: 200,
        tabsize: 2,
        codemirror: {
          theme: 'monokai'
        }
      });
    });
  </script>
<body>
    <nav class="navbar navbar-default" role="navigation">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php if(empty($login)){echo "index.php";} else {echo "dashboard.php";} ?>">Gestion des vacataires - UFR SEGMI</a>
            
      </div>
      
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <?php if(!empty($login)){echo "<li"; if (basename($_SERVER['PHP_SELF']) == "dasboard.php") { echo " class='active'"; } echo "><a href='dashboard.php'><span class='glyphicon glyphicon-dashboard'></span> Tableau de bord</a></li>";} ?> 
        </ul>
        
        <ul class="nav navbar-nav navbar-right">
            <?php if (basename($_SERVER['PHP_SELF']) == "profil.php") { echo '
                <li><a href="formulaire/formulaire_connection.php" class="iframe"  ><span class="glyphicon glyphicon-globe"></span> Connection</a></li>
                <li><a href="formulaire/formulaire_inscription.php" class="iframe" ><span class="glyphicon glyphicon-send"></span> Inscription</a></li> 
            '; } ?>
        
            <?php if(!empty($login)) {
                echo '<li><a href="statistiques.php"><span class="glyphicon glyphicon-tasks"></span> Statistiques</a></li>';
                 echo '<li><a href="formulaire/RechercheVacataire.php"><span class="glyphicon glyphicon-search"></span> Recherche</a></li>';
                echo '<li><a href="../Controlleur/wdCalendar/wdCalendar/calendrier.php"><span class="glyphicon glyphicon-calendar"></span> Calendrier</a></li>';
               
                 echo '<li><a href="webmail.php"><span class="glyphicon glyphicon-envelope"></span> webmail</a></li>';
                echo "
                    <li class='dropdown"; if (basename($_SERVER['PHP_SELF']) == "webmail.php") { echo " active"; } echo"'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-user'></span> $login <b class='caret'></b></a>
                        <ul class='dropdown-menu'>
                          <li><a href='profil.php'>Afficher votre profil</a></li>
                          <li><a href='../Controlleur/deconnexion.php'>Déconnexion</a></li>
                        </ul>
                    </li>
                ";
            }?>
        </ul>
      </div>
    </nav>


<div class="container">
        <div class="jumbotron">
            <center>
              <h2>Webmail</h2>
              <p>Gérer votre messagerie</p>
            </center>
        </div>
        
        <?php
        include "formulaire/sendEmail.php";
        include "consulterMail.php";
        ?>
        
        
        
        
<?php
include "footer.php";

?>
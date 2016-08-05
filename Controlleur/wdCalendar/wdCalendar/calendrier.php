
<?php 

session_start();
$login=$_SESSION['login'];
print_r($_SESSION);

      
      echo '<link rel="stylesheet" href="vacataireCalendrier.css">';




?>
 <title>Calendrier</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../../bootstrap/css/bootstrap-theme.min.css">
<script src="src/jquery.js" type="text/javascript"></script>
<script src="../../bootstrap/js/bootstrap.min.js"></script>

<meta charset="utf-8">
</head>
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
            <a class="navbar-brand" href="<?php if(empty($login)){echo "index.php";} else {echo "../../../Vue/dashboard.php";} ?>">Gestion des vacataires - UFR SEGMI</a>
            
      </div>
      
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <?php if(!empty($login)){echo "<li"; if (basename($_SERVER['PHP_SELF']) == "dashboard.php") { echo " class='active'"; } echo "><a href='../../../Vue/dashboard.php'><span class='glyphicon glyphicon-dashboard'></span> Tableau de bord</a></li>";} ?> 
        </ul>
        
        <ul class="nav navbar-nav navbar-right">
            <?php if (basename($_SERVER['PHP_SELF']) == "../../../Vue/index.php") { echo '
                <li><a href="../../../Vue/formulaire/formulaire_connection.php" class="iframe"  ><span class="glyphicon glyphicon-globe"></span> Connection</a></li>
                <li><a href="../../../Vue/formulaire/formulaire_inscription.php" class="iframe" ><span class="glyphicon glyphicon-send"></span> Inscription</a></li> 
            '; } ?>
        
            <?php if(!empty($login)) {
                 echo '<li><a href="../../../Vue/webmail.php"><span class="glyphicon glyphicon-envelope"></span> webmail</a></li>';
                echo "
                    <li class='dropdown"; if (basename($_SERVER['PHP_SELF']) == "profil.php") { echo " active"; } echo"'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-user'></span> $login <b class='caret'></b></a>
                        <ul class='dropdown-menu'>
                          <li><a href='../../../Vue/profil.php'>Afficher votre profil</a></li>
                          <li><a href='../../deconnexion.php'>Déconnexion</a></li>
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
              <h2>Calendrier</h2>
            </center>
        </div>
        
        
    <?php include "sample.php";
    ?>
        
    </div>
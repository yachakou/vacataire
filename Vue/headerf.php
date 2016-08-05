<link rel="stylesheet" href="/Controlleur/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/Controlleur/bootstrap/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="/Controlleur/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<style>
 th,td
        {
            padding-right:60px;
        }

</style>
<script src="/Controlleur/jquery/jquery-1.10.2.min.js"></script>
<?php if (basename($_SERVER['PHP_SELF']) == "index.php") {
echo '<script src="/Controlleur/jquery.fancybox-1.3.4/jquery-1.4.3.min.js"></script>';
} ?>
<script src="../Controlleur/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Controlleur/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="/Controlleur/jquery.fancybox-1.3.4/fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	
	$("a.iframe").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	false,
		'height'        :   500,
		'scrolling'     :   'no'
	});
	

	

});
</script>
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
                
                  echo '<li><a href="../statistiques.php"><span class="glyphicon glyphicon-tasks"></span> Statistiques</a></li>';
                 echo '<li><a href="../formulaire/RechercheVacataire.php"><span class="glyphicon glyphicon-search"></span> Recherche</a></li>';
                echo '<li><a href="../../Controlleur/wdCalendar/wdCalendar/calendrier.php"><span class="glyphicon glyphicon-calendar"></span> Calendrier</a></li>';
               
                 echo '<li><a href="../webmail.php"><span class="glyphicon glyphicon-envelope"></span> webmail</a></li>';
                echo "
                    <li class='dropdown"; if (basename($_SERVER['PHP_SELF']) == "profil.php") { echo " active"; } echo"'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-user'></span> $login <b class='caret'></b></a>
                        <ul class='dropdown-menu'>
                          <li><a href='profil.php'>Afficher votre profil</a></li>
                          <li><a href='/Controlleur/deconnexion.php'>Déconnexion</a></li>
                        </ul>
                    </li>
                ";
            }?>
        </ul>
      </div>
    </nav>
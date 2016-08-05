<!--<link type="text/css" rel="stylesheet" href="css/jquery.autocomplete.css" />-->
<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<!--<script type="text/javascript" src="js/jquery.autocomplete.js"></script>-->
 <!-- include jquery -->
 
  <script src="../jquerry/jquery-ui-1.9.2/jquery-1.8.3.js"></script>
  <script type="text/javascript" src="../Controlleur/autocomplete/jquery.autocomplete.js"></script>

<form method='POST' action='' id='f1' >
<label>Tapez le nom d'un ensignant : </label><input type="text" id="langages" />

 <!--<center><input type="submit" class="btn btn-default" value="Afficher" ></center>-->

</form>
<script>
$(document).ready(function() {
    $('#langages').autocomplete('Recherche.php');
    
});

</script>
<?php

require_once("../../Modele/Matiere.php");
require_once("../../Controlleur/Connexion.php");
session_start();
$login=$_SESSION['login'];


?>
<html>
<head>
    <title>Recherche</title>
<?php include "../headerf.php"; ?>
    

    <div class="container">
        <div class="jumbotron">
            <center>
              <h2>Page de recherche</h2>
              <p>De cours ou d'utilisateur</p>
            </center>
        </div>

  
  
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
 <div class="container">
     
                <div class="panel panel-default">
                    <div class="panel-heading"><center><h2 class="panel-title">Recerche d'utilisateur</h2></center></div>
                    

                        </br>
                        


  <form method='POST' action='../ResultatRechercheVac.php' id='f1' >

<fieldset>
                            <center>  <div class="input-group"><label for="user">User</label><br /> <select name="user" id="user"></center>
                              
</fieldset>
                              
<?php

$pdo=new Connexion();
$pdo2=$pdo->GetPDO();
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


         <center><input type="submit" class="btn btn-default" value="Rechercher" ></center>

      </form> 



</div>

 </br>
 
 <div class="container">
     
                <div class="panel panel-default">
                    <div class="panel-heading"><center><h2 class="panel-title">Recerche par matière</h2></center></div>
                   </br>


  <form method='POST' action='../ResultatRechercheMat.php' id='f2' >

                            <center>  <div class="input-group"><label for="mat">Matière</label><br /> <select name="mat" id="mat"></center>

<?php

//$pdo=new Connexion();
//$pdo2=$pdo->GetPDO();
$reponse = $pdo2->query('SELECT * FROM Matiere');
 
while ($donnees = $reponse->fetch())
{
    
?>
   <center> <option value="<?php echo $donnees['nom']; ?>"> <?php echo $donnees['nom'] ?>  </option> </center>
    
<?php
    }

?> 

</select>

</br>
</br>
        <center><label>Parcours</label>
        <select name="form">
        <option value="null" selected>Ne pas spécifié</option> 
        <option value="Class">Classique</option> 
        <option value="Alt" >Alternance</option>
        </select>
        </center>
        </br>
        
        <center><label>Formation</label>
        <select name="type">
        <option value="null" selected>Ne pas spécifié</option> 
        <option value="L3">Licence</option> 
        <option value="M1">Master 1</option> 
        <option value="M2">Master 2</option> 

        </select>
        </center>
        </br>
       
         <center><input type="submit" class="btn btn-default" value="Rechercher" ></center>






</br>


</div>
</div>
</div>

        </br>

        </br>
        </br>


                        
</html>




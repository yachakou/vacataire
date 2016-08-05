<?php 
    // Tout début du code PHP. Situé en haut de la page web
ini_set("display_errors",0);error_reporting(0);
    session_start();
   // print_r($_SESSION);
    $login=$_SESSION["login"];
    require_once("../Modele/Enseignant.php");
      require_once("../Modele/Matiere.php");
    require_once("../Controlleur/Connexion.php");
    
    
    $pdo=new Connexion();
    $enseignant = new Enseignant();
    $pdo2=$pdo->getPDO();
    $enseignant->loadEnseignant($pdo2, $login);
   // print_r($enseignant);
    $nom=$enseignant->getNom();
    $prenom=$enseignant->getPrenom();
    $email=$enseignant->getEmail();
    $harpege=$enseignant->getArpege();
    $idStatus=$enseignant->getIdStatus();
   
   if($idStatus==0)
   {
    $status="root";   
   }
   else if($idStatus==1)
   {
       $status="vacataire";
   }
   else if($idStatus==2)
   {
       $status="gestionnaire";
   }
   else if($idStatus==3)
   {
       $status="responsableL3CLassique";
   }
   else if($idStatus==4)
   {
       $status="responsableL3Apprentissage";
   }
   else if($idStatus==5)
   {
       $status="responsableM1CLassique";
   }
   else if($idStatus==6)
   {
       $status="responsableM1Apprentissage";
   }
   else if($idStatus==7)
   {
       $status="responsableM2CLassique";
   }
   else
   {
        $status="responsableM2Apprentissage";
   }
?>

<html>
<head>
<style>
        #form
        {
            visibility:hidden;
            height:0;
    
        }
       
        
        table
        {
            margin-top:15px;
        }
        </style>
    <script src="../../Controlleur/Crypto/crypto.js"></script> 
    <script type="text/javascript">
           
            function affiche()
            {
                 if(document.getElementById("form").style.visibility=="hidden")
                    {
                        document.getElementById("form").style.visibility="visible";
                        document.getElementById("form").style.height='50%';
    
                    }
                    else
                    {
                        document.getElementById("form").style.visibility="hidden";
                        document.getElementById("form").style.height='0';
                       
                    }
                             return true;
            }
            
     function crypt ()
   {
         var mdp=document.getElementById("pwd").value;
         var mdpc=SHA512(mdp);
       //alert(mdpc);
         document.getElementById("pwd").style.visibility="hidden";
         document.getElementById("pwd").value=mdpc;
        

 
   }
</script>

    <title>Profil de <?php echo $login; ?> | Gestion des vacataires</title>
    <?php include "header.php"; ?>

    <div class="container">
        <div class="jumbotron">
            <center>
              <h2>Profil</h2>
            </center>
        </div>
        
        <div class="panel panel-default" style="position:relative;">
            <?php
                
               echo "<table class='table'>";
               echo "<thead><tr><th>login</th><th>nom</th><th>prenom</th><th>email</th><th>harpege</th><th>status</th></tr></thead>";
               echo "<tr>";
               echo "<td>".$login."</td><td>".$nom."</td><td>".$prenom."</td><td>".$email."</td><td>".$harpege."</td><td>".$status."</td>";
               echo "<tr>";
               echo "</table>";
                
            ?>
            <br/><input class="btn btn-primary" type="button" name="modif" value="Modifier"  onclick="affiche()" style="margin-bottom:11px; position:absolute; right:30px;top:63px;">
        </div>
    
    <?php
    
   //afficher le profil
    
    ?>
     <div id="form">
            <div class="panel panel-default">
                <div class="panel-heading"><center>Modifier profil</center></div>
                 <div class="panel-body">
                 <form id='f2' method='post' action="../Controlleur/modif_profil.php" onSubmit="crypt()"></br>
        				<fieldset>
                            <div class="input-group"><span class="input-group-addon">Nom</span> <input type='text' class="form-control" name='name' required value="<?php echo $nom?>"></div></br>
                            <div class="input-group"><span class="input-group-addon">Prénom</span> <input type='text' class="form-control" name='prenom' required value="<?php echo $prenom?>"></div></br>
        					<div class="input-group"><span class="input-group-addon">Email</span> <input type='email' class="form-control" name='email' required  value="<?php echo $email?>"></div></br>
        				<!--<div class="input-group"><span class="input-group-addon">Login</span> <input type='text' class="form-control" name='log' required value="<?php //echo $login?>"></div></br>-->
        					<div class="input-group"><span class="input-group-addon">N° Harpège</span> <input type='text' class="form-control" name='harpege' required value="<?php echo $harpege?>"></div></br>
        					<div class="input-group"><span class="input-group-addon">Mot de passe</span> <input type='password' id="pwd" class="form-control" name='pwd' required></div></br>
        					<center><input type="submit" class="btn btn-default" value="Soumettre" ></center>
        				</fieldset>
        			</form>
        		</div>
        		</div>
        	</div>
        	
   
    
</div>
<?php include "footer.php" ?>
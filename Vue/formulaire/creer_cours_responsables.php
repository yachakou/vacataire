
<?php
//session_start();
?>
<script type="text/javascript">
   
    
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
        var heureTD=verifnb(f.heureTD);
        if(heureTD!==true)erreur=f.heureTD;
        var heureTP=verifnb(f.heureTP);
        if(heureTP!==true)erreur=f.heureTP;
        var heureCM=verifnb(f.heureCM);
        if(heureCM!==true)erreur=f.heureCM;
        if(heureTD && heureTP && heureCM)
            return true;
        else
        {
            alert("Erreur de modification, veuillez remplir les champs en rouge (les chiffres ne peuvent être inférieur ou égale à 0)");
            erreur.focus();
            return false;
        }
    }
</script>
<form method='post' action="../Controlleur/AjoutMatiere.php" onsubmit="return verif(this);"></br>
	<fieldset>
	    <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span><input type='text' class="form-control" name='name' placeholder="Nom de la matière" required></div></br>
	    <div class="input-group"><input type='number' class="form-control" name='heureTD' placeholder="Nombre d'heures TD" onblur="verifnb(this);" required max="30"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></br>
        <div class="input-group"><input type='number' class="form-control" name='heureTP' placeholder="Nombre d'heures TP"  onblur="verifnb(this);" required max="30"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></br>
	    <div class="input-group"><input type='number' class="form-control" name='heureCM' placeholder="Nombre d'heures CM"  onblur="verifnb(this);" required  max="6"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></br>

       <!-- <div class="input-group"><input type='text' class="form-control" name='NomProf' placeholder="Proffesseur en charges "  ><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></br>-->


        <select name="formation">
        <?php
        if($_SESSION['status']==3 || $_SESSION['status']==4)
            echo '<option value="L3">Licence 3</option> ';
        else if($_SESSION['status']==5 || $_SESSION['status']==6)
             echo '<option value="M1" selected>Master 1</option>';
        else if($_SESSION['status']==7 || $_SESSION['status']==8)
            echo '<option value="M2">Master 2</option>';
        ?>
        </select>
        
        <select name="parcours">
        <?php
            if($_SESSION['status']==3 || $_SESSION['status']==5 || $_SESSION['status']==7)
                echo '<option value="Class" selected>Classique</option>';
             else  
                 echo '<option value="Alt">Alternance</option>';
        ?>
        </select>
        
        
        <center><input class="btn btn-default" type="submit" value="Inscrire"></center>
	</fieldset>
</form>
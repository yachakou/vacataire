


<form method='post' action="../Controlleur/AjoutMatiere.php" ></br>
	<fieldset>
	    <div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span><input type='text' class="form-control" name='name' placeholder="Nom de la matière" required></div></br>
	    <div class="input-group"><input type='number' class="form-control" name='heureTD' placeholder="Nombre d'heures TD"  required max="30"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></br>
        <div class="input-group"><input type='number' class="form-control" name='heureTP' placeholder="Nombre d'heures TP"  required max="30"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></br>
	    <div class="input-group"><input type='number' class="form-control" name='heureCM' placeholder="Nombre d'heures CM"  required max="6"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></br>

       <!-- <div class="input-group"><input type='text' class="form-control" name='NomProf' placeholder="Proffesseur en charges "  ><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></br>-->


        <select name="formation">
        <option value="L3">Licence 3</option> 
        <option value="M1" selected>Master 1</option>
        <option value="M2">Master 2</option>
        </select>
        
        <select name="parcours">
        <option value="Alt">Alternance</option> 
        <option value="Class" selected>Classique</option>
        
        </select>
        
        
        <center><input class="btn btn-default" type="submit" value="Inscrire"></center>
	</fieldset>
</form>
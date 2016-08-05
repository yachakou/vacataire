
  <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Suppression d'un user</div>
                    <div class="panel-body">
                        <form id='f1' method='post' action="../Controlleur/suppression_user.php" ></br>
                    	    <fieldset>
                              <div class="input-group"><label for="user">User</label><br /> <select name="user" id="user">
                              
                              
                              
<?php


//$pdo2=$pdo->GetPDO();
$reponse = $pdo2->query('SELECT * FROM Enseignant');
 
while ($donnees = $reponse->fetch())
{
    if($donnees['login']!="root")
    {
?>
    <option value="<?php echo $donnees['login']; ?>"> <?php echo $donnees['login'] ?>  </option>
    
<?php
    }
}
?>  
                              </select></div></br>
                                <center><input type="submit" class="btn btn-default" value="Supprimer" ></center>
                        	</fieldset>
                        </form>
                    </div>
                </div>
            
    </div>



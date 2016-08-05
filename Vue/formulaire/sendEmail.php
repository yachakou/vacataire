
 <?php

function __autoload($class_name) {
    include $class_name . '.php';
    
    }

session_start();
//require_once("../Modele/Matiere.php");
//require_once("../Modele/Enseignant.php");
require_once("../Controlleur/Connexion.php");

?>




<style>

    #droit
    {
        position:absolute;
        left:150px;
        top:92px;
    }
    #formationDroit
    {
        position:absolute;
        margin-left:20px;
        
    }
</style>

<div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Envoyer un Mail</div>
                    <div class="panel-body">
                        <form id='mail' method='post' action="../../Controlleur/sendEmail.php" ></br>
                    	    <fieldset>
                              
                              <div  class="input-group"><label for="user">Destinataire </label><br /> <select name="user" id="user">

<?php

$pdo=new Connexion();
$pdo2=$pdo->GetPDO();
$reponse = $pdo2->query('SELECT * FROM Enseignant');
 
while ($donnees = $reponse->fetch())
{
   // if($donnees['login']!="root")
   // {
?>
    <option value="<?php echo $donnees['login']; ?>"> <?php echo $donnees['login'] ?>  </option>
    
<?php
   // }
}
?>  
                              </select>
                             
                    <div  class="input-group"><label for="user">Objet </label><br /> <input type="text" name='objet' value="Objet ici " />	

                              <div id="droit"></div>
                              </div></br>
                            <label for="user">Message </label>
                                
                            <textarea name="message" class="summernote"><p>Votre <b>message</b></p></textarea>
                              <center><input type="submit" class="btn btn-default" value="Envoyer" ></center>

                        	</fieldset>
                        </form>
                    </div>
                </div>
            
    </div>
    
     
    
<link rel="stylesheet" href="../../Controlleur/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../../Controlleur/bootstrap/css/bootstrap-theme.min.css">
<script src="../../Controlleur/jquery/jquery-1.10.2.min.js"></script>
<script src="../../Controlleur/bootstrap/js/bootstrap.min.js"></script>
<script src="../../Controlleur/Crypto/crypto.js"></script> 
<div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Inscription</div>
                <div class="panel-body">
                    <form id='f2' method='post' action="../../Controlleur/Inscription.php" target="_parent" onsubmit="crypt()"></br>
        				<fieldset>
                            <div class="input-group"><span class="input-group-addon">Nom</span> <input type='text' class="form-control" name='name' required></div></br>
                            <div class="input-group"><span class="input-group-addon">Prénom</span> <input type='text' class="form-control" name='prenom' required></div></br>
        					<div class="input-group"><span class="input-group-addon">Email</span> <input type='email' class="form-control" name='email' required ></div></br>
        					<div class="input-group"><span class="input-group-addon">Login</span> <input type='text' class="form-control" name='log'required></div></br>
        					<div class="input-group"><span class="input-group-addon">N° Harpège</span> <input type='text' class="form-control" name='harpege' required></div></br>
        					<div class="input-group"><span class="input-group-addon">Mot de passe</span> <input id="pwd" type='password' class="form-control" name='pwd' required></div></br>
        					<center><input type="submit" class="btn btn-default" value="S'inscrire" ></center>
        				</fieldset>
        			</form>
        		</div>
        	</div>
		</div>
		
		
		
    
     <script type="text/javascript">
   function crypt ()
   {
         var mdp=document.getElementById("pwd").value;
         var mdpc=SHA512(mdp);
         document.getElementById("pwd").style.visibility="hidden";
         document.getElementById("pwd").value=mdpc;
 
   }
   </script>
<link rel="stylesheet" href="../../Controlleur/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../../Controlleur/bootstrap/css/bootstrap-theme.min.css">
<script src="../../Controlleur/jquery/jquery-1.10.2.min.js"></script>
<script src="../../Controlleur/bootstrap/js/bootstrap.min.js"></script>
<script src="../../Controlleur/Crypto/crypto.js"></script> 
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Connexion</div>
                <div class="panel-body">
                    <form id='f1' method='post' action="../../Controlleur/ConnexionUser.php" target="_parent" onSubmit="crypt()"></br>
                    	<fieldset>
                            <div class="input-group"><span class="input-group-addon">Login</span> <input type='text' class="form-control" name='login' required></div></br>
        					<div class="input-group"><span class="input-group-addon">Mot de passe</span> <input type='password' class="form-control" name='pwd' id='pwd' required></div></br>
                            <center><input type="submit" class="btn btn-default" value="Se connecter" ></center>
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
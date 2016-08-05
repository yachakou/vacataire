
<?php 
try{
  
    session_start();
    require_once("../Modele/Enseignant.php");
    require_once("../Controlleur/Connexion.php");
    
    //print_r($_SESSION);
    $login=$_SESSION["login"];
   
    $nom=$_POST['name'];
    $prenom=$_POST['prenom']; 
    $email=$_POST['email']; 
    $log=$_POST['log'];
    $harp=$_POST['harpege']; 
    $pwd=$_POST['pwd']; 

   // print_r($_POST);
 
    $pdo=new connexion();
    $enseignant = new Enseignant();
    $pdo2=$pdo->getPDO();
    $enseignant->loadEnseignant($pdo2, $login);
    
    //modification :
    $enseignant->setNom($nom);
    $enseignant->setPrenom($prenom);
    $enseignant->setEmail($email);
    $enseignant->setArpege($harp);
    $enseignant->setPassword($pwd);
   // print_r($enseignant);
    
    $enseignant->modifEnseignant($pdo2);
 
 
  // echo 'Modification appliqué';
   
   header("Location:../Vue/profil.php",true);

}

catch(Exception $e)
	{
		echo 'Exception re�ue : ', $e->getMessage(), "\n";
	}//catch
	
//exit();
?>


<?php

require_once("../../Controlleur/Connexion.php");

     $pdo=new Connexion();
    $pdo2=$pdo->getPDO();
    
   
$return_arr = array();
 
if ($pdo2)
{
    $ac_term = "%".$_GET['term']."%";
    
    $query = "SELECT * FROM Enseignant where nom like :term";
    $result = $pdo2->prepare($query);
    $result->bindValue(":term",$ac_term);
    $result->execute();
    
    
    while ($result->fetch(PDO::FETCH_ASSOC)) {
        // while ($row = $result->fetch(PDO::FETCH_OBJ)) {
        
        //$row_array[] = $row['nom'];
       // $results[] = array(value => $row['nom'], "label" => $row['nom']);
       
    }
    
   echo json_encode($results);
        //echo json_encode(array("test", "bidule"));
   // echo '{"abc"}, 
    //{"def"}]';
   
}


?>
 
  
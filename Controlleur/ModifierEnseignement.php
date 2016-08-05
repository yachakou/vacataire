<?php

print_r($_POST);
//echo "</br>";

require_once("../Modele/Enseignement.php");
require_once("../Modele/Enseignant.php");
require_once("../Modele/Horaire.php");
//require_once("../Modele/EnseignementHoraire.php");
require_once("./Connexion.php");

//print_r($_POST);
$idEnseignement=$_POST['idEnseignement'];
$id_mat=$_POST['idMat'];
$idEns=$_POST['idEns'];
$day=$_POST['date'];
$duree=$_POST['dure'];
$heure=$_POST['debut'];
$typeCours=$_POST['type'];
if($typeCours=="CM")
{
 $typeCours=0;   
}
else if($typeCours=="TD")
{
 $typeCours=1;   
}
else
{
 $typeCours=2;   
}
$pdo=new Connexion(); 
$pdo2=$pdo->getPDO();
$enseignement=new Enseignement();
$enseignement->loadEnseignementID($pdo2, $idEnseignement);


//print_r($enseignement);
$horaire=new Horaire($idEnseignement,$day,$heure,$duree,$typeCours);
 $horaire->loadHoraire($pdo2,$idEnseignement);
 $idHoraire=$horaire->getIdHoraire();

 //print_r($horaire);

//$EnseignementHoraire=new EnseignementHoraire($idEnseignement,$idEns,$id_mat,$day,$heure,$duree,$typeCours);
//print_r($EnseignementHoraire);
//$enseignant->removeEnseignant($pdo2);
//header("location:../Vue/dashboard.php");

 $sql = "SELECT *
    FROM Enseignement e, Enseignant e2, Matiere m, Horaire h
    WHERE e.idEnseignant = e2.idEnseignant
    AND m.id_mat = e.idMatiere and h.idEnseignement=e.idEnseignement and e.idEnseignement=".$idEnseignement;
    // echo $sql;  
            $resultats=$pdo2->query($sql);
            $resultats->setFetchMode(PDO::FETCH_OBJ);
            $idUser=array();
                while( $row = $resultats->fetch() )
                {
                 // print_r($row);
                  $id_parcours=$row->id_parcours;
                  $id_formation=$row->id_formation;
                  
                }
   
              $resultats->closeCursor();
    
    
    
//***********************************************************VERIF DES CONTRAINTES SUR LES PARCOURS LES FORMATIONS ET LES HEURES DES COURS*******************
//echo "</br></br>";
$sql = "SELECT *
    FROM Enseignement e, Enseignant e2, Matiere m, Horaire h
    WHERE e.idEnseignant = e2.idEnseignant
    AND m.id_mat = e.idMatiere and h.idEnseignement=e.idEnseignement and e.idEnseignement!=".$idEnseignement;
    // echo $sql;  
            $idP=array();
            $idF=array();
            $horaireT=array();
            $resultats=$pdo2->query($sql);
            $resultats->setFetchMode(PDO::FETCH_OBJ);
            $idUser=array();
                while( $row = $resultats->fetch() )
                {
                  //print_r($row);
                  $id_parcours1=$row->id_parcours;
                  $id_formation1=$row->id_formation;
                 // $idHoraire2=$row->idHoraire;
                  $idEnseignement1=$row->idEnseignement;
                  $day1=$row->day;
                  $heure1=$row->heure;
                  $duree1=$row->duree;
                  $typeCours1=$row->typeCours;
                  $idHoraire1=$row->idHoraire;
                  $horaire1=new Horaire($idEnseignement1,$day1,$heure1,$duree1,$typeCours1);
                  $horaire1->loadHoraire($pdo2,$idEnseignement1);
                  array_push($idP,$id_parcours1);
                  array_push($idF,$id_formation1);
                  array_push($horaireT,$horaire1);
                }
                $resultats->closeCursor();
            //print_r($idP); print_r($idF);
            print_r($horaireT);
            
   // echo $horaireT[1]->getDay();
    //echo $horaire->getDay()==$horaireT[0]->getDay();
    //echo $horaire->getDay()==$horaireT[1]->getDay();
    for($i=0;$i<count($horaireT);$i++)
    {
       // echo "</br>".$i;
        //echo $horaire->getDay()." ?= ".$horaireT[$i]->getDay();
        
        $res=$day==$horaireT[$i]->getDay();
        //echo $res;
        if($res==1)
        {
           // echo " attention un enseignement est a la même date";
            if($id_parcours==$idP[$i] && $id_formation==$idF[$i])
            {
                //echo "</br>";
                //echo " attention cours pour la même formation";
                if($heure==$horaireT[$i]->getHeure())
                {
                   //echo "c'est pas possible redirection meme heure";
                   header("location:../Vue/pageError.php?error=1&id_mat=".$id_mat); //meme jour meme heure meme formation
                   exit();
                }
                else
                {
                    $nvh=$heure+$duree; //heure d'heure de fin
                    $nvh1=$horaireT[$i]->getHeure()+$horaireT[$i]->getDuree();  //heure d'heure de fin déja inséré 
                   // echo "</br>";
                   // echo $nvh;
                    // echo "</br>";
                   // echo $nvh1;
                    if($heure>$horaireT[$i]->getHeure())
                    {
                        if($nvh1>$heure)
                        {
                           echo "c'est pas possible redirection tranche1";
                           header("location:../Vue/pageError.php?error=2&id_mat=".$id_mat); //meme jour meme formation dans créneau
                         exit();
                        }
                    }
                    else
                    {
                         if($nvh>$horaireT[$i]->getHeure())
                        {
                            echo "c'est pas possible redirection tranche2";
                            header("location:../Vue/pageError.php?error=2&id_mat=".$id_mat); //meme jour meme formation dans créenau
                           exit();
                        }
                    }
                    
                }
            }
        }
    }
//La date et le jour est disponible
//***********************************************************Verif des contraintes d'heures enseignant
//echo "</br></br>";
    $nbTotale=Enseignement::getNbTotale($pdo2,$idEns,$idEnseignement,$duree); //nbtotale dheure enseignement
    //echo $res;
    $nbmax=Enseignant::getNbHStatus($pdo2,$idEns); //nbmax du vacataire
   // echo $nbmax;

       if($nbTotale>$nbmax)
       {
          // echo "impossible";
          header("location:../Vue/pageError.php?error=4&id_mat=".$id_mat);// heure totale dpasse
        exit();
       }
       else
       {    try
             {
             
             $pdo2->exec("update Enseignement set idEnseignant=".$idEns." where idEnseignement=".$idEnseignement);
             $pdo2->exec("update Horaire set day='".$day."',heure=".$heure.",duree=".$duree.",typeCours=".$typeCours." where idHoraire=".$idHoraire);
           // echo "update Enseignement set idEnseignant=".$idEns." where idEnseignement=".$idEnseignement;
           // echo "update Horaire set day='".$day."', heure=".$heure.", duree=".$duree.", typeCours=".$typeCours." where idHoraire=".$idHoraire;
           
             }  catch(PDOException $e)
             {
                 $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
                 die($msg);
                // echo "erreur";
             }//catch(PDOException $e)
        
            catch(Exception $e)
            {
                //echo 'Exception recue : ', $e->getMessage(), "\n";
            }//catch(Exception $e)
               //echo "update";
       }
       //header("location:../Vue/apercuMatiere.php");
    header("location:../Vue/apercuMatiere.php?id_mat=".$id_mat);
     
?>
<?php


function formation ($id_formation)
{
if ($id_formation==1)
{
return 'Licence 3';
}
if ($id_formation==2)
{
   return 'Master 1'; 
}
else { return 'Master 2'; }
 
}//formation

function parcours ($id_parcours)
{
    if($id_parcours==1) { return ' Classique';}

    else {return ' Alternance '; }

}//parcours 


//include("../Controlleur/pChart.1.27d/pChart/pData.class");  
 //include("../Controlleur/pChart.1.27d/pChart/pChart.class");  
 // echo "ok";
 // Dataset definition  
 $idEnseignant=$enseignant->getIdEnseignant();
$matieres=Matiere::getMatieres($pdo2); //tableau de matiere
//print_r($matieres);

$data=array();
$nomMatiere=array();
$totale=0;
for($i=0;$i<count($matieres);$i++)
{
    $sql="select * FROM Enseignement e, Enseignant e2, Matiere m, Horaire h
    WHERE e.idEnseignant = e2.idEnseignant
    AND m.id_mat = e.idMatiere and h.idEnseignement=e.idEnseignement and e.idEnseignant=".$idEnseignant." and e.idMatiere=".$matieres[$i]->getIdMatiere();
    // echo $sql;  
   // echo $matieres[$i]->getNom();
            $somme=0;
            $resultats=$pdo2->query($sql);
            $resultats->setFetchMode(PDO::FETCH_OBJ);
            while( $row = $resultats->fetch() )
                {
                    //print_r($row);
                     $duree=$row->duree;
                     $somme+=$duree;
                     
                }
                $resultats->closeCursor();
    //echo " = ".$somme;
    $nMatiere=$matieres[$i]->getNom();
    $nMatiere=$nMatiere." ".formation($matieres[$i]->getIdFormation());
    $nMatiere=$nMatiere." ".parcours($matieres[$i]->getIdParcours());
    array_push($nomMatiere,$nMatiere);
    array_push($data,$somme);
    $totale+=$somme;
} 
//pour juste avoir ceux >0
$data2=array();
$nomMatiere2=array();
for($i=0;$i<count($data);$i++)
{
    if($data[$i]!=0)
    {
        array_push($data2,$data[$i]);
        array_push($nomMatiere2,$nomMatiere[$i]);
    }
}


 //print_r($data);
 ?>
 <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
               <div class="panel-heading"><center><h2 class="panel-title">Matieres enseignées : </h2></center></div>
 
    
            </div>
 <?php
 if(count($data2)>0)
{
 $DataSet = new pData;  
 $DataSet->AddPoint($data2,"Serie1");  
 $DataSet->AddPoint($nomMatiere2,"Serie2");  
 $DataSet->AddAllSeries();  
 $DataSet->SetAbsciseLabelSerie("Serie2");  
  
 // Initialise the graph  
 $Test = new pChart(550,250);  
 $Test->drawFilledRoundedRectangle(10,7,373,193,5,240,240,240);  
 $Test->drawRoundedRectangle(5,5,375,195,5,230,230,230);  
  
 // Draw the pie chart  
 $Test->setFontProperties("../Controlleur/pChart.1.27d/Fonts/tahoma.ttf",8);  
 $Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),170,90,130,PIE_PERCENTAGE,TRUE,50,20,5);  
 $Test->drawPieLegend(350,15,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);  
  
 $Test->Render("example10.png");
 echo "<img src='example10.png'/>";
  //echo "ok";
}
?>

</div>
<div class="col-md-6">
<div class="panel panel-default">
               <div class="panel-heading"><center><h2 class="panel-title">Matieres à pourvoir : </h2></center></div>
<?php
$sql="select nbh FROM Enseignant e,Status s
    WHERE e.id_status = s.idStatus and e.idEnseignant=".$idEnseignant;
    // echo $sql;  
   // echo $matieres[$i]->getNom();
            
            $resultats=$pdo2->query($sql);
            $resultats->setFetchMode(PDO::FETCH_OBJ);
            $row = $resultats->fetch();
             $resultats->closeCursor();
            $nbmax=$row->nbh;
            //echo $nbmax;
$heureApourvoir=$nbmax-$totale;
 array_push($data2,$heureApourvoir);
array_push($nomMatiere2,"heure a pourvoir");

if(count($data2)>0)
{
 $DataSet = new pData;  
 $DataSet->AddPoint($data2,"Serie1");  
 $DataSet->AddPoint($nomMatiere2,"Serie2");  
 $DataSet->AddAllSeries();  
 $DataSet->SetAbsciseLabelSerie("Serie2");  
  
 // Initialise the graph  
 $Test = new pChart(550,250);  
 $Test->drawFilledRoundedRectangle(10,7,373,193,5,240,240,240);  
 $Test->drawRoundedRectangle(5,5,375,195,5,230,230,230);  
  
 // Draw the pie chart  
 $Test->setFontProperties("../Controlleur/pChart.1.27d/Fonts/tahoma.ttf",8);  
 $Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),170,90,130,PIE_PERCENTAGE,TRUE,50,20,5);  
 $Test->drawPieLegend(350,15,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);  
  
 $Test->Render("heureapouvoir.png");
 echo "<img src='heureapouvoir.png'/>";
}
               

?>
                 </div>
    
            </div>
        <div class="row">
            <div class="col-md-6">
                
                <div class="panel panel-default">
               <div class="panel-heading"><center><h2 class="panel-title">Analyse: </h2></center></div>
                </br>
                <p>Vous enseignez <?php echo $totale;?> heures au totale : dont voici vos heures :
                <ul>
                <?php
                    for($i=0;$i<count($data2)-1;$i++)
                    {
                       
                        echo "<li> Vous effectuez ".$data2[$i]." heures dans la matière : ".$nomMatiere2[$i]."</li>";
                    }
                ?>
            
                </ul>
                
                </p>
    
            </div>
            </div>
            <div class="col-md-6">
                
                <div class="panel panel-default">
               <div class="panel-heading"><center><h2 class="panel-title">Analyse: </h2></center></div>
                </br>
                <center><p> Il vous reste <?php echo $heureApourvoir; ?> heures à saisir
                </p></center>
    
            </div>
        </div>
        
        </div>
       

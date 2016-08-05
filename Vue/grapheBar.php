
            
                <div class="panel panel-default">
               <div class="panel-heading"><center><h2 class="panel-title">Matieres enseignées pour tous les utilisateurs: </h2></center></div>
                </br></br>
    
            
<?php

$enseignants=Enseignant::getEnseignants($pdo2); //tableau de matiere
//print_r($enseignants);
  $heures=array();
  for($i=0;$i<count($enseignants);$i++)
  {
     $sql="select * FROM Enseignement e, Enseignant e2, Matiere m, Horaire h
    WHERE e.idEnseignant = e2.idEnseignant
    AND m.id_mat = e.idMatiere and h.idEnseignement=e.idEnseignement and e.idEnseignant=".$enseignants[$i]->getIdEnseignant();
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
        array_push($heures,$somme);
  }
  
 // Dataset definition   
 $DataSet = new pData;  
 $serie="Serie";
 for($i=0;$i<count($enseignants);$i++)
 {
     $n=$i+1;
     $DataSet->AddPoint(array($heures[$i]),$serie.$n);
     $DataSet->SetSerieName($enseignants[$i]->getLogin(),$serie.$n);
 }
   
 $DataSet->AddAllSeries();  
 $DataSet->SetAbsciseLabelSerie();  
 
  
 // Initialise the graph  
 $Test = new pChart(1140,250);  
 $Test->setFontProperties("../Controlleur/pChart.1.27d/Fonts/tahoma.ttf",8);  
 $Test->setGraphArea(50,30,680,200);  
 $Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);  
 $Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);  
 $Test->drawGraphArea(255,255,255,TRUE);  
 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,200,150,150,TRUE,0,2,TRUE);     
 $Test->drawGrid(4,TRUE,150,230,230,50);  
  
 // Draw the 0 line  
 $Test->setFontProperties("../Controlleur/pChart.1.27d/Fonts/tahoma.ttf",6);  
 $Test->drawTreshold(150,143,55,72,TRUE,TRUE);  
  
 // Draw the bar graph  
 $Test->drawBarGraph($DataSet->GetData(),$DataSet->GetDataDescription(),TRUE);  
  
 // Finish the graph  
 $Test->setFontProperties("../Controlleur/pChart.1.27d/Fonts/tahoma.ttf",8);  
 $Test->drawLegend(750,0,$DataSet->GetDataDescription(),255,255,255);  
 $Test->setFontProperties("../Controlleur/pChart.1.27d/Fonts/tahoma.ttf",10);  
 $Test->drawTitle(50,22,"Nombres d'heures d'enseignement",50,50,50,585);  
 $Test->Render("enseignantHeures.png");  

 echo "<img src='enseignantHeures.png'/>";
?>  
<center><p>en abscisses : les utilisateurs et en ordonnées les nombres d'heures de chacun</p></center>
</div>
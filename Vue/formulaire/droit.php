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
                <div class="panel-heading">Changer le status</div>
                    <div class="panel-body">
                        <form id='fdroit' method='post' action="../Controlleur/droit.php" ></br>
                    	    <fieldset>
                              <div  class="input-group"><label for="user">User</label><br /> <select name="user" id="user">
                              
                              
                              
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
                              </select>
                             </br></br> <label for="status">Status</label></br>
                              <select name="status" id="status" onchange="ajouterSelect();">
                              <option value=1>vacataire</option>
                              <option  value=-1>responsable</option>
                              <option value=2>gestionnaire</option>
                              </select>
                              <div id="droit"></div>
                              </div></br>
                                <center><input type="submit" class="btn btn-default" value="assigner" ></center>
                        	</fieldset>
                        </form>
                    </div>
                </div>
            
    </div>
    
    <script type="text/javascript" >
    
    
    function ajouterSelect()
    {
        var div=document.getElementById("droit");
        var option=document.getElementById("status").options[1];
        var select=document.getElementById("status");
        var selected=document.getElementById("status").selectedIndex;
       // var options=document.getElementById("status").options;
        if(select.options[selected].value==option.value)
        {
            //alert(option.value);
            var select1=document.createElement('select');
		
		    select1.setAttribute('name','parcours');
		    select1.setAttribute('id','parcoursDroit');
		   var option1=document.createElement('option');
	        option1.setAttribute('value',"0");
	        var text1=document.createTextNode('classique');
        	option1.appendChild(text1);
	       select1.appendChild(option1);
	       
	        var option2=document.createElement('option');
	        option2.setAttribute('value',"1");
	         var text2=document.createTextNode('apprentissage');
        	option2.appendChild(text2);
	         select1.appendChild(option2);
	         div.appendChild(select1);
	       //$(select1).insertAfter("#droit");
	        
	        
	         var select2=document.createElement('select');
		      select2.setAttribute('id','formationDroit');
		    select2.setAttribute('name','formation');
		   var option3=document.createElement('option');
	        option3.setAttribute('value',"0");
	        var text3=document.createTextNode('L3');
        	option3.appendChild(text3);
	       select2.appendChild(option3);
	       
	        var option4=document.createElement('option');
	        option4.setAttribute('value',"1");
	         var text4=document.createTextNode('M1');
        	option4.appendChild(text4);
	         select2.appendChild(option4);
	         
	          var option5=document.createElement('option');
	        option5.setAttribute('value',"2");
	         var text5=document.createTextNode('M2');
        	option5.appendChild(text5);
	         select2.appendChild(option5);
	         div.appendChild(select2);
	         //$(select2).insertAfter("#droit");
	        
        }
        else
        {
            
           div.innerHTML="";
             
        }
       
    }
    
    </script>
<?php

// prends en paramètre : un status (string) et un nombre d'heures.

class Status
{
    var $status;
    var $nb_heures;
    
    // Constructeur
    function __Status($status_donne, $nb_heures_donne)
    {
        $this->status    = $status_donne;
        $this->nb_heures = $nb_heures_donne;
    }//function __Status($_status_donne, $_nb_heures_donne)
    
    
    
}//class Status



?>
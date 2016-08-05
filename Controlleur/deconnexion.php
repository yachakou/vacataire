<?php
    session_start();
    $_SESSION = array();
    // On détruit la session
    session_destroy();
    header("Location: ../Vue/index.php",true);
?>
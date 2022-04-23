<?php
    session_start();
    echo "deconnexion en cours";
    session_destroy();
    header("refresh:3;url=login.php");
?>
<?php
    session_start();
    
    //if logged out, redirect to index page
    if(!isset($_SESSION['userid'])) {
        header("Location: index.php");
    }
?>
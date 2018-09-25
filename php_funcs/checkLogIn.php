<?php
    session_start(); 
    
    //if user is logged in, redirect to main.php
    if(isset($_SESSION[userid])) {
        header("Location: main.php");
    }
?>
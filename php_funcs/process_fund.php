<?php
	session_start();
    //log in to db
    include_once('connectDB.php');
    
    $add = $_POST['amount'];
    $projectid = $_POST['projectid'];
    $userid = $_SESSION['userid'];
    
    $query = "UPDATE projects SET amount_funded = amount_funded + $add WHERE projectid = '$projectid'";
    
    $result = pg_query($db, $query);

    $query = "INSERT INTO invest VALUES ('$userid', '$projectid', $add)";
    $result = pg_query($db, $query);

    //header("Location: ../main.php");
?>
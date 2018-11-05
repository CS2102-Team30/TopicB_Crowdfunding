<?php
	session_start();
    //log in to db
    include_once('connectDB.php');
    
    $add = $_POST['amount'];
    $projectid = $_POST['projectid'];
    $userid = $_SESSION['userid'];
    
	$query = "SELECT add_fund_amount('$userid', '$projectid', $add)";
	$result = pg_query($db, $query);
    header("Location: ../main.php");
?>
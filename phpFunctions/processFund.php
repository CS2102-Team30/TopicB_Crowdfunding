<?php
	session_start();
    //log in to db
    include_once('connectDB.php');
    
    $add = $_POST['amount'];
    $projectid = $_POST['projectid'];
    $userid = $_SESSION['userid'];
    
	pg_query($db, 'LISTEN fundChannel');
	$query = "SELECT add_fund_amount('$userid', '$projectid', $add)";
	$result = pg_query($db, $query);
	$notice = pg_last_notice($db);
	if($notice){
		$_SESSION['funding_notice'] = $notice;		
	}
    header("Location: ../main.php");
?>
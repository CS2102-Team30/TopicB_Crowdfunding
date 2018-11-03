<?php
	session_start();
    //log in to db
    include_once('connectDB.php');
    
    $add = $_POST['amount'];
    $projectid = $_POST['projectid'];
    $userid = $_SESSION['userid'];
    
	// check if user got invest in this project before
	$query = "SELECT investor, projectid, amount FROM invest WHERE projectid = '$projectid' AND investor = '$userid'";
	$result = pg_query($db, $query);
	
	if (pg_num_rows($result) == 1) {	// user invested in this project before
		$row = pg_fetch_assoc($result);
		$previousAmount = intval($row['amount']);
		
		if ($add == 0) {	// for user to remove his funding
			$query = "DELETE FROM invest WHERE investor = '$userid' AND projectid = '$projectid'";
			$result = pg_query($db, $query);
		}
		else {
			$query = "UPDATE invest SET amount = $add WHERE investor = '$userid' AND projectid = '$projectid'";
			$result = pg_query($db, $query);
		}
	}
	else {	// user never invested in this project before
		if ($add != 0) {
			$query = "INSERT INTO invest VALUES ('$userid', '$projectid', $add)";
			$result = pg_query($db, $query);
		}
	}

    header("Location: ../main.php");
?>
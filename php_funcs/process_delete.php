<?php
	session_start();
	$query = "";
	include_once('connectDB.php');
	if ($_SESSION[isadmin] == "t"){
		$query = "DELETE FROM projects WHERE projectid = '$_POST[deleteid]'";
	}else{
		$query = "DELETE FROM projects WHERE projectid = '$_POST[deleteid]' AND advertiser = '$_SESSION[userid]'";
	}
	$result = pg_query($db, $query);                  
    if (!$result) {
    }
    else {
	}
	header("Location: ../user_projects.php");
?>
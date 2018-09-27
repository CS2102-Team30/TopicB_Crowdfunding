<?php
	session_start();
    //log in to db
    include_once('connectDB.php');
    
    $add = $_POST['amount'];
    $projectid = $_POST['projectid'];
    
    $query = "UPDATE projects SET amount_funded = amount_funded + $add WHERE projectid = '$projectid'";
    
    $result = pg_query($db, $query);                  
    if (!$result) {
        echo "Project submission failed, please try again";
		$_SESSION['submit_state'] = "failed";
    }
    else {
        echo "Project successfully submitted";
		$_SESSION['submit_state'] = "success";
	}
    header("Location: ../main.php");
?>
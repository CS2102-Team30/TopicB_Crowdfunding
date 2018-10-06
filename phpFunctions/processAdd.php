<?php
	session_start();
    //log in to db
    include_once('connectDB.php');

    $projectid = uniqid('', true);
    $start_date = date("d/m/Y");
    $query = "INSERT INTO projects VALUES ('$_SESSION[userid]', '$projectid', '$_POST[title]', '$_POST[description]', 
        '$start_date', '$_POST[duration]', '$_POST[keywords]', '$_POST[amount_sought]', '0')";
    $result = pg_query($db, $query);                  
    if (!$result) {
        echo "Project submission failed, please try again";
		$_SESSION['submit_state'] = "failed";
    }
    else {
        echo "Project successfully submitted";
		$_SESSION['submit_state'] = "success";
	}
	header("Location: ../addProject.php");
?>
<?php
    /* This page is called during adding of projects */

	session_start();
    //log in to db
    include_once('connectDB.php');

    $projectid = uniqid('', true);
    $start_date = date("d/m/Y");
    $query = "INSERT INTO projects VALUES ('$_SESSION[userid]', '$projectid', '$_POST[title]', '$_POST[description]', 
        '$start_date', '$_POST[duration]', '$_POST[amount_sought]', '0')";
    $result = pg_query($db, $query);                  
    if (!$result) {
		$_SESSION['submit_state'] = "failed";
    }
    else {
		$_SESSION['submit_state'] = "success";
		
		if (!empty($_POST[category])) {
			foreach($_POST[category] as $selected) {
				$query2 = "INSERT INTO belongsTo VALUES ('$projectid', '$selected')";
				$result2 = pg_query($db, $query2);
			}
		}
	}
	header("Location: ../addProject.php");
?>
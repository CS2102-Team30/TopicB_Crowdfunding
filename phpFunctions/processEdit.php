<?php
	session_start();
    //log in to db
    include_once('connectDB.php');

    $query = "UPDATE projects SET title = '$_POST[edit_title]', description = '$_POST[edit_description]', 
			duration = '$_POST[edit_duration]', funding_sought = '$_POST[edit_amount_sought]'
			WHERE projectid = '$_POST[edit_projectid]' AND (advertiser = '$_SESSION[userid]' OR EXISTS(SELECT 1 FROM users WHERE userid = '$_SESSION[userid]' AND isAdmin))";
	$result = pg_query($db, $query);                  
	if (!$result) {
	}
	else {
		$query2 = "DELETE FROM contains WHERE projectid = '$_POST[edit_projectid]'";
		$result2 = pg_query($db, $query2);
		
		if (!empty($_POST[edit_keywords])) {
			foreach($_POST[edit_keywords] as $selected) {
				$query2 = "INSERT INTO contains VALUES ('$_POST[edit_projectid]', '$selected')";
				$result2 = pg_query($db, $query2);
			}
		}
	}
?>
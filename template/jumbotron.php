<!-- Jumbotron header for the index page and register page -->
<div class="jumbotron text-center">
    <h1>Welcome the Crowdfunder!</h1>
    <h5>This is where your dreams come true</h5>
	<br>
	<h5>
		<?php
			$query1 = "SELECT COUNT(*) FROM users";
			$query2 = "SELECT COUNT(*) FROM projects";
			$result1 = pg_fetch_row(pg_query($db, $query1));
			$result2 = pg_fetch_row(pg_query($db, $query2));
			
			if (!$result1 || !$result2) {
				echo "Failed to connect to database";
			}
			else {
				$count1 = $result1[0];
				$count2 = $result2[0];
				echo "Currently helping ", $count1, " passionate users fund ", $count2, " of their favourite projects";
			}
		?>
	</h5>
</div>
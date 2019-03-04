<!-- This fetches the projects from database in the form of HTML Cards -->
<?php
    while ($row = pg_fetch_assoc($result))  {
        $counter++;
        $projectid = $row['projectid'];
?>
		<div class="card" data-id="<?php echo $projectid;?>">
			<div class="card-header">
				<?php echo $row['title'];?>
			</div>
			<div class="card-body">
				<?php echo "<p>" . "Advertised by: " . $row['advertiser'] . " | " . "Currently raised: " . "$". $row['amount_funded'] . "/" . "$" . $row['funding_sought'] . "</p>"; ?>
				<?php
					$query2 = "SELECT investor, projectid, amount FROM invest WHERE projectid = '$projectid' AND investor = '$_SESSION[userid]'";
					$result2 = pg_query($db, $query2);
					if (pg_num_rows($result2) == 1) {	// user invested in this project before
						$row2 = pg_fetch_assoc($result2);
						echo "<p>" . "You are currently funding " . "$" . $row2['amount'] . " in this project" . "</p>";
					}
					
					$query3 = "SELECT projectid, category FROM belongsTo WHERE projectid = '$projectid'";
					$result3 = pg_query($db, $query3);
					$allcategories = "";
					while($row3 = pg_fetch_assoc($result3)) {
						$allcategories .= $row3['category'] . ",";
					}
					$allcategories = rtrim($allcategories, ",");

					$query4 = "SELECT COUNT(i.investor) AS investorCount
						FROM projects p, invest i
						WHERE p.projectid = '$projectid'
						AND p.projectid = i.projectid";
					$result4 = pg_fetch_row(pg_query($db, $query4));
				?>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#projectModal" 
				data-description="<?php echo $row['description'];?>" data-title="<?php echo $row['title'];?>" data-startdate="<?php echo $row['start_date'];?>" data-duration="<?php echo $row['duration'];?>" 
									data-projectid="<?php echo $row['projectid'];?>" data-funding="<?php echo $row['funding_sought'];?>" data-funded="<?php echo $row['amount_funded'];?>">
					Find out more
				</button>
			</div>
			<div class="card-footer">
				<?php echo "<p>" . "Categories: " . $allcategories; ?>
				<?php echo "<p>" . "Currently funded by " . $result4[0] . " investors" ?>
			</div>
		</div>
		<br>
<?php
    }
    if(pg_num_rows($result) >= 10) {
?>
        <div id="load_more">
            <button type="button" name="btn_more" data-counter="<?php echo $counter; ?>" id="btn_more" class="btn btn-primary btn-lg btn-block">Load More</button>
            <br>
        </div>
<?php
    } else {
        echo '<div class="text-center">No more entries found!</div>';
    }
?>

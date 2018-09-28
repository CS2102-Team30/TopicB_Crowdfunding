<?php
	while ($row = pg_fetch_assoc($result))  {
		$projectid = $row['projectid'];
?>
		<div class="card" data-id="<?php echo $projectid;?>">
			<div class="card-header">
				<?php echo $row['title'];?>
			</div>
			<div class="card-body">
				<?php echo "<p>" . "Advertised by: " . $row['advertiser'] . " | " . "Currently raised: " . "$". $row['amount_funded'] . "/" . "$" . $row['funding_sought'] . "</p>"; ?>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#projectModal" 
				data-description="<?php echo $row['description'];?>" data-title="<?php echo $row['title'];?>" data-startdate="<?php echo $row['start_date'];?>" data-duration="<?php echo $row['duration'];?>" data-projectid="<?php echo $row['projectid'];?>">
					Find out more
				</button>
			</div>
		</div>
		<br>
<?php
	}
?>
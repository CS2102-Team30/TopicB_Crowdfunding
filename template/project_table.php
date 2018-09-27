<?php
	// Getting data, index var stores the index of the rows
	$index = 0;
	while ($row = pg_fetch_row($result))  {
		$projectid = $row[pg_num_fields($result)-1];
?>
		<div class="card" data-id="<?php echo $projectid;?>">
			<div class="card-header">
				<?php echo $row[0];?>
			</div>
			<div class="card-body">
				<?php echo "<p>" . "Advertised by: " . $row[1] . " | " . "Currently raised: " . "$". $row[4] . "/" . "$" . $row[5] . "</p>"; ?>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#projectModal" 
				data-description="<?php echo $row[6];?>" data-title="<?php echo $row[0];?>" data-startdate="<?php echo $row[2];?>" data-duration="<?php echo $row[3];?>">
					Find out more
				</button>
			</div>
		</div>
		<br>
<?php
	}
?>
<!DOCTYPE html>  
    <head>
        <title>Welcome to Crowdfunding!</title>
        <?php include("./template/head.php"); ?>
    </head>
    
    <body>       
        <?php
            //check if logged out
            include_once("./php_funcs/checkLogOut.php");
            //log in to db
            include_once('./php_funcs/connectDB.php');
        ?>
        
        <!-- Nav bar -->
        <?php include("./template/nav.php"); ?>        
        
        <div class="container">
			<br>
            <h2>Our success stories.</h2>
			<p> We love to see projects succeed through our platform. <br>
				Here are the list of projects that have met and exceeded their own fund goals.</p>
			<br>
			<?php
				// Retrieving projects from DB
                //sort by amount_funded by default in descending order
                if(!isset($_GET['order'])) {
                    $order = "desc";
                }
                else {
                    $order = $_GET['order'];
                }
                        
                if(!isset($_GET['sort'])) {
                    $sort = 'amount_funded';
                }
                else {
                    $sort = $_GET['sort'];
                }
                 
                $query = "SELECT title, advertiser, start_date, duration, amount_funded, funding_sought, description, projectid 
					FROM projects 
					WHERE amount_funded >= funding_sought 
					ORDER BY $sort $order";
				$result = pg_query($db, $query);
			?>
            
			
			<?php 
				//initialising associative array
				$project_columns = array("advertiser" => "Advertiser", "projectid" => "Project ID", "title" => "Title", "description" => "Description", "start_date" => "Start Date", "duration" => "Duration", "keywords" => "Keywords", "funding_sought" => "Funding Sought", "amount_funded" => "Amount Funded");
			?>
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="navbar-brand">Sort by:</div>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSort" aria-controls="navbarSort" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSort">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item <?php if($sort == "title") {?>active<?php }?>">
							<a class="nav-link" href="./funded.php?order=<?php echo $order;?>&sort=title"><?php echo$project_columns['title'];?></a>
						</li>
						<li class="nav-item <?php if($sort == "advertiser") {?>active<?php }?>">
							<a class="nav-link" href="./funded.php?order=<?php echo $order;?>&sort=advertiser"><?php echo $project_columns['advertiser'];?></a>
						</li>
						<li class="nav-item <?php if($sort == "funding_sought") {?>active<?php }?>">
							<a  class="nav-link" href="./funded.php?order=<?php echo $order;?>&sort=funding_sought"><?php echo $project_columns['funding_sought'];?></a>
						</li>
						<li class="nav-item <?php if($sort == "amount_funded") {?>active<?php }?>">
							<a class="nav-link" href="./funded.php?order=<?php echo $order;?>&sort=amount_funded"><?php echo $project_columns['amount_funded']?></a>
						</li>
						<li class="nav-item <?php if($order == "asc") {?>active<?php }?>">
							<a class="nav-link" href="./funded.php?order=asc&sort=<?php echo $sort;?>">Ascending</a>
						</li>
						<li class="nav-item <?php if($order == "desc") {?>active<?php }?>">
							<a class="nav-link" href="./funded.php?order=desc&sort=<?php echo $sort;?>">Descending</a>
						</li>
					</ul>
				</div>
			</nav>
			
			<?php include('./template/project_table.php'); ?>
        </div>
    </body>
    
    <!-- Modal -->
    <?php include("./template/project_modal.php"); ?>
    
	<script>
		$("[data-modal-action=delete]").click(function (event) {
			var button = $(event.target);
			var id = button.val();
			$("#projectModal").modal("hide");

			var form = document.createElement("form");
			form.setAttribute("method", "post");
			form.setAttribute("action", "php_funcs/process_delete.php");

			var hiddenField = document.createElement("input");
			hiddenField.setAttribute("type", "hidden");
			hiddenField.setAttribute("name", "deleteid");
			hiddenField.setAttribute("value", id);
			form.appendChild(hiddenField);
			document.body.appendChild(form);
			form.submit();	
		});
	</script>
</html>
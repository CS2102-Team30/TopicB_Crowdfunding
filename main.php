<!DOCTYPE html>  
    <head>
        <title>Welcome to Crowdfunding!</title>
        <?php include("./template/head.php"); ?>
        
        <?php            
            //check if logged out
            include_once("./php_funcs/checkLogOut.php");
            //log in to db
            include_once('./php_funcs/connectDB.php');
            // Retrieving projects from DB
            $result = pg_query('SELECT title, advertiser, start_date, duration, amount_funded, funding_sought, projectid, description FROM projects');
            
            //DataTables script here
            include_once("./php_funcs/dataTables.php");          
        ?>        


    </head>
    
    <body>       
        <!-- Nav bar -->
        <?php include("./template/nav.php"); ?>        
        
        <div class="container">
			<br>
            <h2>Browse projects here:</h2>
			
			<!-- Nav tabs -->
			<ul class="nav nav-tabs">
				<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#viewAll">View All</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#viewFunded">View Funded</a></li>
			</ul>
            
			<!-- Tab content -->
			<div class="tab-content">
				<div id="viewAll" class="tab-pane show active">
					<br>
					<h3>Creative projects coming to life.</h3>
					<p> Here are the list of all projects.</p>
					<br>

					<?php include('./template/project_table.php'); ?>
				</div>
				
				<div id="viewFunded" class="tab-pane fade">
					<br>
					<h3>Our success stories.</h3>
					<p> We love to see projects succeed through our platform. <br>
						Here are the list of projects that have met and exceeded their own fund goals.</p>
					<br>
					<?php
						// Retrieving projects from DB
						$result = pg_query('SELECT title, advertiser, start_date, duration, amount_funded, funding_sought, description, projectid FROM projects
							WHERE amount_funded >= funding_sought');
					?>

					<?php include('./template/project_table.php'); ?>
				</div>
			</div>
        </div>
    </body>
</html>
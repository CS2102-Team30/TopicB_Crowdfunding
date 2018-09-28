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
            <h2>Browse projects here:</h2>
			
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" id="viewTabs">
				<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#viewAll">View All</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#viewFunded">View Funded</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#search">Search</a></li>
			</ul>
			
			<!-- Tab content -->
			<div class="tab-content">
				<div id="viewAll" class="tab-pane show active">
					<br>
					<h3>Creative projects coming to life.</h3>
					<p> Here are the list of all projects.</p>
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
                        
                        $query = "SELECT title, advertiser, start_date, duration, amount_funded, funding_sought, description, projectid FROM projects ORDER BY $sort $order";
						$result = pg_query($db, $query);
					?>
                    <?php include ('./template/navSort.php'); ?>
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
                        $query = "SELECT title, advertiser, start_date, duration, amount_funded, funding_sought, description, projectid FROM projects WHERE amount_funded >= funding_sought";
						$result = pg_query($db, $query);
					?>
					<?php include('./template/project_table.php'); ?>
				</div>
				
				<div id="search" class="tab-pane fade">
					<br>
					<h3>Can't find what you're looking for?</h3>
					<p> Don't worry, we got you covered.</p>
					<form action="main.php" method="POST">
						<label for="search_field" class="col-lg-1 col-form-label">Search: </label>
						<input name="search_field" class="form-control" placeholder="Any relevant keywords" required/>
						<br>
						<div class="text-center">
							<button class="btn btn-primary" type="submit" name="search">Search</button>
						</div>
					</form>
					<br> 
					<?php
						if (isset($_POST['search'])) {
							//Searches title and keywords, Finds any values that have "word" in any position, Case-insensitive
							$result = pg_query("SELECT title, advertiser, start_date, duration, amount_funded, funding_sought, description, projectid FROM projects
								WHERE UPPER(title) LIKE UPPER('%$_POST[search_field]%')
								OR UPPER(keywords) LIKE UPPER('%$_POST[search_field]%')");
						}
					?>
					
					<?php include('./template/project_table.php'); ?>
				</div>
			</div>
        </div>
    </body>
    
    <!-- Modal -->
    <?php include("./template/project_modal.php"); ?>
    
	<script>
        $('#viewTabs a').click(function(e) {
            e.preventDefault();
            $(this).tab('show');
        });
        
        // store the currently selected tab in the hash value
        $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
            var id = $(e.target).attr("href").substr(1);
            window.location.hash = id;
        });
        
        // on load of the page: switch to the currently selected tab
        var hash = window.location.hash;
        $('#viewTabs a[href="' + hash + '"]').tab('show');

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
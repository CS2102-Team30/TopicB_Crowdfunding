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
            <h2>Can't find what you're looking for?</h2>
			<p> Don't worry, we got you covered.</p>
			<form action="search.php" method="GET">
				<label for="search_field" class="col-lg-1 col-form-label">Search: </label>
				<input name="search_field" class="form-control" placeholder="Any relevant keywords" required/>
				<br>
				<div class="text-center">
					<button class="btn btn-primary" type="submit" name="search">Search</button>
				</div>
			</form>
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
				
				if (!isset($_GET['search_field'])) {
					$search = null;
				}
				else {
					$search = $_GET['search_field'];
				}
				
                $query = "SELECT title, advertiser, start_date, duration, amount_funded, funding_sought, description, projectid 
					FROM projects
					WHERE UPPER(title) LIKE UPPER('%$search%')
					OR UPPER(keywords) LIKE UPPER('%$search%')
					ORDER BY $sort $order";
				$result = pg_query($db, $query);
			?>
            
			<?php include ('./template/navSort.php'); ?>
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
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
			<form action="search.php" method="POST">
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
					$result = pg_query("SELECT title, advertiser, start_date, duration, amount_funded, funding_sought, description, projectid 
						FROM projects
						WHERE UPPER(title) LIKE UPPER('%$_POST[search_field]%')
						OR UPPER(keywords) LIKE UPPER('%$_POST[search_field]%')");
				}
			?>
            
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
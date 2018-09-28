<!DOCTYPE html>  
<html lang="en">
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
            <h1>Your advertised projects</h1>
            <br>
            
            <?php
                // Retrieving projects from DB
                $result = pg_query("SELECT title, advertiser, start_date, duration, amount_funded, funding_sought, description, projectid FROM projects WHERE advertiser = '$_SESSION[userid]'");
            ?>
             <!-- Display information from Database in table form -->
            <?php include("./template/project_table.php"); ?>
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
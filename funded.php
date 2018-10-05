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
                // sort by amount_funded by default in descending order
                $counter = 0;
                
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
					WHERE amount_funded >= funding_sought
                    AND (UPPER(title) LIKE UPPER('%$search%')
                    OR UPPER(keywords) LIKE UPPER('%$search%'))
					ORDER BY $sort $order
                    LIMIT 10 OFFSET 0";
                    
                    
				$result = pg_query($db, $query);
			?>
            
            <?php include("./template/project_search.php"); ?>
			<?php include('./template/navSort.php'); ?>
            <div id="results">
                <?php include('./template/project_table.php'); ?>
            </div>
            <?php
                if(pg_num_rows($result) == 0) {
                    if($search == null) {
                        echo "There are no successfully funded projects :(";
                    }
                    else {
                        echo "Your search '".$search."' returned with nothing! Try something else.";
                    }
                }
            ?>
        </div>
    </body>
    
    <!-- Modal -->
    <?php include("./template/project_modal.php"); ?>
    <?php include("./php_funcs/load_jquery.php"); ?>
    
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
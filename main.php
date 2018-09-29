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
            <h2>Creative projects coming to life.</h2>
			<p> Here are the list of all projects.</p>
            <br>
            <?php include("./template/project_search.php"); ?>
            
			<?php
				// Retrieving projects from DB
                // sort by amount_funded by default in descending order
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
            
            <?php
                if(pg_num_rows($result) == 0) {
                    if($search == null) {
                        echo "There does not seem to be anything inside the DB";
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
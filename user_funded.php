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
            <h1>Projects You Have Funded</h1>
            <br>
            
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
				
                //check if user even has funded projects
                $query = "SELECT * FROM invest WHERE investor = '$_SESSION[userid]'";
                $result = pg_query($db, $query);

                if(pg_num_rows($result) == 0) {
                    $fundedNothing = true;
                }
                else {
                    $fundedNothing = false;
                }

                if(!$fundedNothing) {
                    $query = "SELECT p.title, p.advertiser, p.start_date, p.duration, p.amount_funded, p.funding_sought, p.description, p.projectid, i.amount 
                        FROM projects p, invest i
                        WHERE i.investor = '$_SESSION[userid]' AND p.projectid = i.projectid
                        AND (UPPER(p.title) LIKE UPPER('%$search%')
                        OR UPPER(p.keywords) LIKE UPPER('%$search%'))
                        ORDER BY $sort $order";
                    
                    $result = pg_query($db, $query);
                }
			?>
        
            <?php include("./template/project_search.php"); ?>
             <!-- Display information from Database in table form -->
            <?php include("./template/navSort.php"); ?>
            <?php include("./template/project_table.php"); ?>
            
            <?php
                if($fundedNothing) {
                    echo "Looks like you have not funded anything!";
                }
                else if(pg_num_rows($result) == 0) {
                    echo "Your search '".$search."' returned with nothing! Try something else.";
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
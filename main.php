<!DOCTYPE html>  
    <head>
        <title>Welcome to Crowdfunding!</title>
        <?php include("./template/head.php"); ?>
    </head>
    
    <body>       
        <?php
            //check if logged out
            include_once("./phpFunctions/checkLogOut.php");
            //log in to db
            include_once('./phpFunctions/connectDB.php');
        ?>
        
        <!-- Nav bar -->
        <?php include("./template/nav.php"); ?>        
        
        <div class="container">
			<br>
            <h1>Creative projects coming to life.</h1>
			<p> Browse all projects here.</p>
            <br>
            
			<?php
                $counter = 0;
                
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
				
                $query = "SELECT * 
					FROM projects 
					WHERE UPPER(title) LIKE UPPER('%$search%')
					ORDER BY $sort $order
                    LIMIT 10 OFFSET 0";
				$result = pg_query($db, $query);
			?>
            
            <?php include("./template/projectSearch.php"); ?>
			<?php include ('./template/navSort.php'); ?>
            <div id="results">
                <?php include('./template/projectTable.php'); ?>
            </div>
            
            <?php
                if(pg_num_rows($result) == 0) {
                    if($search == null) {
                        echo "There does not seem to be any projects inside the database.";
                    }
                    else {
                        echo "We can't find any projects matching your search '".$search."'. Try something else instead.";
                    }
                }
            ?>
        </div>
    </body>
    
    <!-- Modal -->
    <?php include("./template/projectModal.php"); ?>
	<?php include("./template/editModal.php"); ?>
    <?php include("./phpFunctions/loadJquery.php"); ?>
</html>
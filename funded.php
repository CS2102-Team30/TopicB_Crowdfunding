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
            <h1>Our success stories.</h1>
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
                
                if (!isset($_GET['category'])) {
                    $category = 'All';
                }
                else {
                    $category = $_GET['category'];
                }

                if ($category == 'All') {
                    $query = "SELECT *
                        FROM projects
                        WHERE amount_funded >= funding_sought
                        AND (UPPER(title) LIKE UPPER('%$search%'))
                        ORDER BY $sort $order
                        LIMIT 10";
                }
                else {
                    $query = "SELECT *
                        FROM projects p, belongsTo b
                        WHERE p.amount_funded >= p.funding_sought
                        AND (UPPER(p.title) LIKE UPPER('%$search%'))
                        AND p.projectid = b.projectid
                        AND b.category = '$category' 
                        ORDER BY $sort $order
                        LIMIT 10";
                }
                    
				$result = pg_query($db, $query);
			?>
            
            <?php include("./template/projectSearch.php"); ?>
            <?php include("./template/categoriesSort.php"); ?>
			<?php include('./template/navSort.php'); ?>
            <div id="results">
                <?php include('./template/projectTable.php'); ?>
            </div>
            <?php
                if(pg_num_rows($result) == 0) {
                    if($search == null) {
                        echo "There are no successfully funded projects :(";
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
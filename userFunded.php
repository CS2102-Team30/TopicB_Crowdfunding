<!DOCTYPE html>  
<html lang="en">
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
            <h1>Projects You Have Funded</h1>
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
                
                if (!isset($_GET['category'])) {
                    $category = 'All';
                }
                else {
                    $category = $_GET['category'];
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
                    if ($category == 'All') {
                        $query = "SELECT p.title, p.advertiser, p.start_date, p.duration, p.amount_funded, p.funding_sought, p.description, p.projectid, i.amount 
                            FROM projects p, invest i
                            WHERE i.investor = '$_SESSION[userid]' AND p.projectid = i.projectid
                            AND (UPPER(p.title) LIKE UPPER('%$search%'))
                            ORDER BY $sort $order
                            LIMIT 10";
                    }
                    else {
                        $query = "SELECT p.title, p.advertiser, p.start_date, p.duration, p.amount_funded, p.funding_sought, p.description, p.projectid, i.amount 
                            FROM projects p, invest i, belongsTo b
                            WHERE i.investor = '$_SESSION[userid]' AND p.projectid = i.projectid
                            AND (UPPER(p.title) LIKE UPPER('%$search%'))
                            AND p.projectid = b.projectid
                            AND b.category = '$category'
                            ORDER BY $sort $order
                            LIMIT 10";
                    }
                    
                    $result = pg_query($db, $query);
                }
			?>
        
            <?php include("./template/projectSearch.php"); ?>
            <?php include("./template/categoriesSort.php"); ?>
             <!-- Display information from Database in table form -->
            <?php include("./template/navSort.php"); ?>
            <div id="results">
                <?php include('./template/projectTable.php'); ?>
            </div>
            
            <?php
                if($fundedNothing) {
                    echo "Looks like you have not funded anything!";
                }
                else if(pg_num_rows($result) == 0) {
                    echo "We can't find any projects matching your search '".$search."'. Try something else instead.";
                }
            ?>

        </div>
    </body>

    <!-- Modal -->
    <?php include("./template/projectModal.php"); ?>
	<?php include("./template/editModal.php"); ?>
    <?php include("./phpFunctions/loadJquery.php"); ?>
</html>
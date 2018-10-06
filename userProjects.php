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
            <h1>Your advertised projects</h1>
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
				
                //check if user even has projects advertised
                $query = "SELECT * FROM projects WHERE advertiser = '$_SESSION[userid]'";
                $result = pg_query($db, $query);
                
                if(pg_num_rows($result) == 0) {
                    $advertisedNothing = true;
                }
                else {
                    $advertisedNothing = false;
                }
                
                if(!$advertisedNothing) {
                    $query = "SELECT * 
                        FROM projects
                        WHERE advertiser = '$_SESSION[userid]'
                        AND (UPPER(title) LIKE UPPER('%$search%')
                        OR UPPER(keywords) LIKE UPPER('%$search%')) 
                        ORDER BY $sort $order
                        LIMIT 10 OFFSET 0";
                    $result = pg_query($db, $query);
                }
			?>
        
            <?php include("./template/projectSearch.php"); ?>
             <!-- Display information from Database in table form -->
            <?php include("./template/navSort.php"); ?>
            <div id="results">
                <?php include('./template/projectTable.php'); ?>
            </div>
            
           <?php
                if($advertisedNothing) {
                    echo "Looks like you have not advertised anything!";
                }
                else if(pg_num_rows($result) == 0) {
                    echo "Your search '".$search."' returned with nothing! Try something else.";
                }
            ?>
        </div>
    </body>

    <!-- Modal -->
    <?php include("./template/projectModal.php"); ?>
    <?php include("./template/editModal.php"); ?>
	<?php include("./phpFunctions/loadJquery.php"); ?>
</html>
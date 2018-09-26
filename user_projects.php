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
            
            $s = $_GET['s'];
        ?>
        
        <!-- Nav bar -->
        <?php include("./template/nav.php"); ?>
        
        <div class="container">
            <br>
            <h1>Your advertised projects</h1>
            <br>
            
            <?php
                // Retrieving projects from DB
                $result = pg_query("SELECT title, advertiser, start_date, duration, amount_funded, funding_sought FROM projects WHERE advertiser = '$_SESSION[userid]'");
            ?>
             <!-- Display information from Database in table form -->
            <?php include("./template/project_table.php"); ?>
            
            <?php
                if (isset($_POST[logout_submit])) {
                    include('./php_funcs/logOut.php');
                }
            ?>
        </div>
    </body>
</html>
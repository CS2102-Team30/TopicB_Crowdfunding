<!DOCTYPE html>  
<html lang="en">
    <head>
        <title>Welcome to Crowdfunding!</title>
        <?php include("./template/head.php"); ?>
        
        <?php            
            //check if logged out
            include_once("./php_funcs/checkLogOut.php");
            //log in to db
            include_once('./php_funcs/connectDB.php');
            // Retrieving projects from DB
            $result = pg_query("SELECT title, advertiser, start_date, duration, amount_funded, funding_sought, description, projectid FROM projects WHERE advertiser = '$_SESSION[userid]'");
            
            //DataTables script here
            include_once("./php_funcs/dataTables.php");          
        ?>        

    </head>
    
    <body>      
        <!-- Nav bar -->
        <?php include("./template/nav.php"); ?>
        
        <div class="container">
            <br>
            <h1>Your advertised projects</h1>
            <br>
            
             <!-- Display information from Database in table form -->
            <?php include("./template/project_table.php"); ?>
        </div>
    </body>
</html>
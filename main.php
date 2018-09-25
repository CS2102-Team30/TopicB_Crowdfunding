<!DOCTYPE html>  
    <head>
        <title>Welcome to Crowdfunding!</title>
        <?php include("./template/head.php"); ?>
    </head>
    
    <body>
        <?php
            //check if logged out
            include_once("./php_funcs/checkLogOut.php");
        ?>
        
        <!-- Nav bar -->
        <?php include("./template/nav.php"); ?>        
        
        <div class="container">
            <h1>Welcome to the Home Page!</h1>
            <?php
                //log in to db
                include_once('./php_funcs/connectDB.php');	

                if (isset($_POST[logout_submit])) {
                    include('./php_funcs/logOut.php');
                }
            ?>
        </div>
    </body>
</html>
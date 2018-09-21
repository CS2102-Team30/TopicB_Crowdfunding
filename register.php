<!DOCTYPE html>  
<html lang="en">
    <head>
        <title>Register for Crowdfunding!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="./css/bootstrap.css">
        <!-- Boostrap JS dependencies -->
        <script src="./js/bootstrap.js"></script>
    </head>
    
    <body>
        <div class="jumbotron text-center">
            <h1>Welcome to Crowdfunding thingy</h1>
            <p>Something something crowdfunding something</p> 
        </div>       
        
        <div class="container">
            <div class="text-center">
                <h1>Register here</h1>
                <br>
            </div>
            
            <form name="display" action="register.php" method="POST">
                <div class="form-group row">
                    <label for="reg_userid" class="col-sm-1 col-form-label">UserID: </label>
                    <div class="col-sm-10">
                        <input name="reg_userid" class="form-control" placeholder="UserID" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="reg_password" class="col-sm-1 col-form-label">Password: </label>
                    <div class="col-sm-10">
                        <input name="reg_password" type="password" class="form-control" placeholder="Password" required/>
                    </div>
                </div>
                <div class="form-group text-center">
                    <input type="submit" name="signup_submit" value="Sign Up!"/>
                </div>
            </form>
            <br><br>

            <div class="text-center">
                <?php
                    session_start();
                    // Connect to the database
                    $db = pg_connect("host=localhost port=5432 dbname=project1 user=postgres password=test");	
                    if(!$db) {
                        echo "Error : Unable to open database\n";
                    } else {
                        echo "Opened database successfully\n";
                    }
                    
                    if (isset($_POST['signup_submit'])) {
                        $query = "INSERT INTO account VALUES ('$_POST[reg_userid]', '$_POST[reg_password]')";
                        $result = pg_query($db, $query);
                        if (!$result) {
                            echo "Signup failed!";
                        }
                        else {
                            echo "Signup successful! Return to the ";
                            echo '<a href="index.php">main page to log in! </a>';
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>
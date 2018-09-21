<!DOCTYPE html>  
<html lang="en">
    <head>
        <title>Welcome to Crowdfunding!</title>
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
                <h1>Please log in to continue</h1>
                <br>
            </div>
            
            <form name="display" action="index.php" method="POST">
                <div class="form-group row">
                    <label for="userid" class="col-sm-1 col-form-label">UserID: </label>
                    <div class="col-sm-10">
                        <input name="userid" class="form-control" placeholder="UserID" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-1 col-form-label">Password: </label>
                    <div class="col-sm-10">
                        <input name="password" type="password" class="form-control" placeholder="Password" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-1">
                        <input type="submit" name="login_submit" value="Log In"/>
                    </div>
                    <div class="col-sm-10 text-center">
                        Not registered? <a href="register.php">Register here.</a>
                    </div>
                </div>
            </form>
            <br><br><br>

            <div class="text-center">
                <?php
                    session_start();
                    // Connect to the database
                    $db = pg_connect("host=localhost port=5432 dbname=project1 user=postgres password=test");	
                    if(!$db) {
                        echo "Error : Unable to open database <br>";
                    } else {
                        echo "Opened database successfully <br>";
                    }

                    if (isset($_POST['login_submit'])) {
                        $query = "SELECT * FROM account WHERE userid='$_POST[userid]'";
                        $result = pg_query($db, $query);
                        if (!$result) {
                            echo "Login failed!";
                        }
                        else {
                            $row = pg_fetch_assoc($result);
                            if ($_POST[password] != $row[password]) {
                                echo "Login failed!";
                            }
                            else {
                                $_SESSION[userid] = $row[userid];
                                header("Location: mainpage.php");
                            }
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>
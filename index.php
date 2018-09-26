<!DOCTYPE html>  
<html lang="en">
    <head>
        <title>Welcome to Crowdfunding!</title>
        <?php include("./template/head.php"); ?>
    </head>
    
    <body>      
        <?php
            //check if logged in
            include_once("./php_funcs/checkLogIn.php");
        ?>
        
        <!-- Header file -->
        <?php include("./template/jumbotron.php"); ?>
        
        <div class="container">
            <div class="text-center">
                <h1>Please log in to continue</h1>
            </div>
            
            <form action="index.php" method="POST">
                <div class="form-group row">
					<div class="col-lg-4"></div>
                    <label for="userid" class="col-lg-1 col-form-label">UserID: </label>
                    <div class="col-lg-3">
                        <input name="userid" class="form-control" placeholder="UserID" required/>
                    </div>
					<div class="col-lg-4"></div>
                </div>
                <div class="form-group row">
					<div class="col-lg-4"></div>
                    <label for="password" class="col-lg-1 col-form-label">Password: </label>
                    <div class="col-lg-3">
                        <input name="password" type="password" class="form-control" placeholder="Password" required/>
                    </div>
                    <div class="col-lg-4"></div>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary" type="submit" name="login_submit">Log in</button>
                </div>
                <div class="text-center">
                    Not registered? <a href="register.php">Register here.</a>
                </div>
            </form>

            <div class="text-center" style="margin-top: 1%">
                <?php
                    //log in to db
                    include_once('./php_funcs/connectDB.php');

                    if (isset($_POST['login_submit'])) {
                        $query = "SELECT * FROM users WHERE userid='$_POST[userid]'";
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
                                header("Location: main.php");
                            }
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>
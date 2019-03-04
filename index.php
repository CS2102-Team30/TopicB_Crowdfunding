<!DOCTYPE html>  
<html lang="en">
    <head>
        <title>Welcome to Crowdfunding!</title>
        <?php include("./template/head.php"); ?>
    </head>
    
    <body>      
        <?php
            //check if logged in
            include_once("./phpFunctions/checkLogIn.php");

            //log in to db
            include_once('./phpFunctions/connectDB.php');
        ?>
        
        <!-- Header file -->
        <?php include("./template/jumbotron.php"); ?>
        
        <div class="container">
            <div class="text-center">
                <h2>Please log in to continue</h2>
                <br>
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
                    if (isset($_POST['login_submit'])) {
                        $query = "SELECT * FROM users WHERE userid='$_POST[userid]'";
                        $result = pg_query($db, $query);
                        if (pg_num_rows($result) == 0) {
                            echo "Username not inside database!";
                        }
                        else {
                            $row = pg_fetch_assoc($result);
                            if (md5($_POST['password']) != $row['password']) {
                                echo "Wrong password!";
                            }
                            else {
                                $_SESSION['userid'] = $row[userid];
                                $_SESSION['isadmin'] = $row[isadmin];
								header("Location: main.php");
                            }
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>
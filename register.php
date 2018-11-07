<!DOCTYPE html>  
<html lang="en">
    <head>
        <title>Register for Crowdfunding!</title>
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
                <h2>Register here</h2>
                <br>
            </div>
            
            <form action="register.php" method="POST">
                <div class="form-group row">
                    <div class="col-lg-4"></div>
                    <label for="reg_userid" class="col-lg-1 col-form-label">UserID: </label>
                    <div class="col-lg-3">
                        <input name="reg_userid" class="form-control" placeholder="UserID" required/>
                    </div>
                    <div class="col-lg-4"></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4"></div>
                    <label for="reg_password" class="col-lg-1 col-form-label">Password: </label>
                    <div class="col-lg-3">
                        <input name="reg_password" type="password" class="form-control" placeholder="Password" required/>
                    </div>
                    <div class="col-lg-4"></div>
                </div>
                <div class="form-group text-center">
                   <button class="btn btn-primary" type="submit" name="signup_submit">Register</button>
                </div>
                
               <div class="text-center">
                    Already registered? <a href="index.php">Log in here.</a>
                </div>
            </form>

            <div class="text-center" style="margin-top: 1%">
                <?php
                    
                    if (isset($_POST['signup_submit'])) {
                        $hashedPassword = md5($_POST['reg_password']);
                        $query = "INSERT INTO users VALUES ('$_POST[reg_userid]', '$hashedPassword', false)";
                        $result = pg_query($db, $query);
                        if (!$result) {
                            echo "Signup failed! Username taken!";
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
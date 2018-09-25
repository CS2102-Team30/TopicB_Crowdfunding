<!DOCTYPE html>  
<html lang="en">
    <head>
        <title>Register for Crowdfunding!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="./css/styles.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="./css/bootstrap.css">
        <!-- Boostrap JS dependencies -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="./js/bootstrap.js"></script>
    </head>
    
    <body>
        <?php
            //check if logged in
            include_once("./php_funcs/checkLogIn.php");
        ?>
        
        <div class="jumbotron text-center">
            <h1>Welcome to Crowdfunding thingy</h1>
            <p>Something something crowdfunding something</p> 
        </div>
        
        <div class="container">
            <div class="text-center">
                <h1>Register here</h1>
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
                    //log in to db
                    include_once('./php_funcs/connectDB.php');
                    
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
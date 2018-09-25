<!DOCTYPE html>  
<html lang="en">
    <head>
        <title>Welcome to Crowdfunding!</title>
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
            //check if user is logged in, if he is, redirect to main.php
            session_start(); 
            
            if(isset($_SESSION[userid])) {
                header("Location: main.php");
            }
        ?>
        
        <div class="jumbotron text-center">
            <h1>Welcome to Crowdfunding thingy</h1>
            <p>Something something crowdfunding something</p> 
        </div>       
        
        <div class="container">
            <div class="text-center" style="margin: 10px">
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
                                header("Location: main.php");
                            }
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>
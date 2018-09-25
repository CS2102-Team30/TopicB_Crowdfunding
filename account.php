<!DOCTYPE html>  
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
            //check if logged out
            include_once("./php_funcs/checkLogOut.php");
        ?>
        
        <!-- Nav bar -->
        <?php include("./template/nav.php"); ?>
        
        <div class="container">
            <div class="text-center">
                <h1>Account Settings</h1>
                <br>
            </div>
            
            <form action="account.php" method="POST">
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <label for="change_password" class="col-lg-2 col-form-label text-right">New password: </label>
                    <div class="col-lg-3">
                        <input name="change_password" type="password" class="form-control" placeholder="Password" required/>
                    </div>
                    <div class="col-lg-3"></div>
                </div>
                <div class="form-group text-center">
                   <button class="btn btn-primary" type="submit" name="changepwd_submit">Change Password</button>
                </div>
            </form>

            <div class="text-center">
                <?php
                    //log in to db
                    include_once('./php_funcs/connectDB.php');

                    if (isset($_POST[logout_submit])) {
                        include('./php_funcs/logOut.php');
                    }
                    
                    if (isset($_POST[changepwd_submit])) {
                        $query = "UPDATE account SET password = '$_POST[change_password]' WHERE userid = '$_SESSION[userid]'";
                        $result = pg_query($db, $query);
                        if (!$result) {
                            echo "Failed to change password.";
                        }
                        else {
                            echo "Password updated!";
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>
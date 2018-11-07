<!DOCTYPE html>  
    <head>
        <title>Welcome to Crowdfunding!</title>
        <?php include("./template/head.php"); ?>
    </head>
    
    <body>
        <?php
            //check if logged out
            include_once("./phpFunctions/checkLogOut.php");
        ?>
        
        <!-- Nav bar -->
        <?php include("./template/nav.php"); ?>
        
        <div class="container">
            <div class="text-center">
                <br>
                <h1>Account Settings</h1>
                <br>
            </div>
            
            <form action="settings.php" method="POST">
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
                    include_once('./phpFunctions/connectDB.php');
                    
                    if (isset($_POST['changepwd_submit'])) {
                        $hashedPassword = md5($_POST['change_password']);
                        $query = "UPDATE users SET password = '". $hashedPassword ."' WHERE userid = '" .$_SESSION['userid']."'";
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
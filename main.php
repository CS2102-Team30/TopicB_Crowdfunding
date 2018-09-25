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
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#"><img src="./docs/logo.png" width="30" height="30" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="main.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="addproject.php">Add your own Project</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="account.php">Account settings</a>
                    </li>
                </ul>
                <span class="navbar-text" style="margin-right: 1%" >
                    <?php 
                        echo "Logged in as"." $_SESSION[userid]";
                    ?>
                </span>
                <form name="display" class="form-inline" action="main.php" method="POST">
                    <button class="btn btn-outline-danger" type="submit" name="logout_submit">Logout</button>
                </form>
            </div>
        </nav>
        
        <div class="container">
            <h1>Welcome to the Home Page!</h1>
            <?php
                //log in to db
                include_once('./php_funcs/connectDB.php');	

                if (isset($_POST[logout_submit])) {
                    session_unset();
                    session_destroy();
                    header("Location: index.php");
                }
                
                if (isset($_POST[newpassword_submit])) {
                    $query = "UPDATE account SET password = '$_POST[password]' WHERE userid = '$_SESSION[userid]'";
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
    </body>
</html>
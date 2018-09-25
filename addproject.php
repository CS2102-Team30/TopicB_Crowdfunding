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
            session_start();
            
            // to make sure user can only get here if he is logged in
            if (!isset($_SESSION[userid])) {
                header("Location: index.php");
            }
        ?>
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#"><img src="./docs/logo.png" width="30" height="30" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="main.php">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="addproject.php">Add your own Project <span class="sr-only">(current)</span></a>
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
            <h1>Add your project here </h1>
        </div>
    </body>
</html>
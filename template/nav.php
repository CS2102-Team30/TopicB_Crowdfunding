<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    
    <?php
        $curFileName = basename($_SERVER['PHP_SELF']);
    ?>

    <a class="navbar-brand" href="#"><img src="./docs/logo.png" width="30" height="30" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if ($curFileName == "main.php") {?>active<?php }?>">
                <a class="nav-link" href="main.php">Home</a>
            </li>
            <li class="nav-item <?php if ($curFileName == "user_projects.php") {?>active<?php }?>">
                <a class="nav-link" href="user_projects.php">Your projects</a>
            </li>
            <li class="nav-item <?php if ($curFileName == "add_project.php") {?>active<?php }?>">
                <a class="nav-link" href="add_project.php">Start a project</a>
            </li>
            <li class="nav-item <?php if ($curFileName == "account.php") {?>active<?php }?>">
                <a class="nav-link" href="account.php">Settings</a>
            </li>
        </ul>
        <span class="navbar-text" style="margin-right: 1%" >
            Logged in as <?php echo $_SESSION[userid]; ?>
        </span>
        <form name="display" class="form-inline" action="<?php echo $curFileName; ?>" method="POST">
            <button class="btn btn-outline-danger" type="submit" name="logout_submit">Logout</button>
        </form>
    </div>
</nav>
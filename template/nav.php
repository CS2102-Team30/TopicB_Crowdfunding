<!-- Nav bar for the main website once logged in -->
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
            <li class="nav-item dropdown <?php if ($curFileName == "main.php" || $curFileName == "funded.php") {?>active<?php }?>">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMain" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Browse</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMain">
                    <a class="dropdown-item" href="main.php">All Projects</a>
                    <a class="dropdown-item" href="funded.php">Successful Projects</a>
                </div>
            </li>
            <li class="nav-item dropdown <?php if ($curFileName == "user.php") {?>active<?php }?>">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUser" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Manage</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownUser">
                    <a class="dropdown-item" href="userProjects.php">Your Projects</a>
                    <a class="dropdown-item" href="userFunded.php">Your Fundings</a>
                </div>
            </li>
            <li class="nav-item <?php if ($curFileName == "addProject.php") {?>active<?php }?>">
                <a class="nav-link" href="addProject.php">Create</a>
            </li>
            <li class="nav-item <?php if ($curFileName == "settings.php") {?>active<?php }?>">
                <a class="nav-link" href="settings.php">Settings</a>
            </li>
        </ul>
        <span class="navbar-text" style="margin-right: 1%" >
            Logged in as <?php echo $_SESSION['userid']; ?>
        </span>
        <form class="form-inline" action="./phpFunctions/logOut.php">
            <button class="btn btn-outline-danger" type="submit">Logout</button>
        </form>
    </div>
</nav>
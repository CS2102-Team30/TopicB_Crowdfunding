<!DOCTYPE html>  
<head>
    <title>UPDATE PostgreSQL data with PHP</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>li {list-style: none;}</style>
</head>
<body>
    <h1>Welcome to Home Page!</h1>
    <ul>
        <form name="display" action="mainpage.php" method="POST" >
            <li>New Password:</li>
			<li><input type="password" name="password" placeholder="password" required/></li>
			<li><input type="submit" name="newpassword_submit" /></li>
        </form>
	</ul>
	<ul>
        <form name="display" action="mainpage.php" method="POST">
            <button type="submit" name="logout_submit">Logout</button>
        </form>
    </ul>
    <?php
        session_start();

        // connect to the database
        $db = pg_connect("host=localhost port=5432 dbname=project1 user=postgres password=test");	
        echo "Logged in as"." $_SESSION[userid]\n";

        if (isset($_SESSION[userid])) {  // to make sure user can only get here if he is logged in
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
        }
        else {
            header("Location: index.php");
        }
    ?>  
</body>
</html>
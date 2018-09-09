<!DOCTYPE html>  
<head>
    <title>UPDATE PostgreSQL data with PHP</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>li {list-style: none;}</style>
</head>

<body>
    <h2>Login</h2>
    <ul>
        <form name="display" action="index.php" method="POST" >
            <li><input type="text" name="userid" placeholder="userid" required/></li>
            <li><input type="text" name="password" placeholder="password" required/></li>
            <li><input type="submit" name="login_submit" /></li>
        </form>
    </ul>
    <h2>Sign up for new account</h2>
    <ul>
        <form name="display" action="index.php" method="POST" >
            <li><input type="text" name="userid2" placeholder="userid" required/></li>
            <li><input type="text" name="password2" placeholder="password" required/></li>
            <li><input type="submit" name="signup_submit" /></li>
        </form>
    </ul>

    <?php
        // Connect to the database. Please change the password in the following line accordingly
        $db     = pg_connect("host=localhost port=5432 dbname=project1 user=postgres password=test");	
        if(!$db) {
            echo "Error : Unable to open database\n";
        } else {
            echo "Opened database successfully\n";
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
                    echo "Login succeeded!";
                }
            }
        }

        if (isset($_POST['signup_submit'])) {	
            $query = "INSERT INTO account VALUES ('$_POST[userid2]', '$_POST[password2]')";
            $result = pg_query($db, $query);
            if (!$result) {
                echo "Update failed!";
            }
            else {
                echo "Update successful!";
            }
        }
    ?>  
</body>
</html>
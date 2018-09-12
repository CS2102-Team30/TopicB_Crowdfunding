<!DOCTYPE html>  
<head>
    <title>UPDATE PostgreSQL data with PHP</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>li {list-style: none;}</style>
</head>
<body>
    <h2>Supply bookid and enter</h2>
    <ul>
        <form name="display" action="mainpage.php" method="POST" >
            <li>Book ID:</li>
            <li><input type="text" name="bookid" /></li>
            <li><input type="submit" name="submit" /></li>
        </form>
        <form name="display" action="mainpage.php" method="POST">
            <button type="submit" name="logout_submit">Logout</button>
        </form>
    </ul>
    <?php
        session_start();

        // connect to the database
        $db = pg_connect("host=localhost port=5432 dbname=project1 user=postgres password=test");	
        echo "Logged in as"." $_SESSION[userid]";

        if (isset($_SESSION[userid])) {  // to make sure user can only get here if he is logged in
            if (isset($_POST[logout_submit])) {
                session_unset();
                session_destroy();
                header("Location: index.php");
            }
        }
        else {
            header("Location: index.php");
        }
    ?>  
</body>
</html>
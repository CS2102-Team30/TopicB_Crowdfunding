<?php
    if(!empty($_GET['projectid'])){
        
        //Log in to DB
        include_once("./php_funcs/connectDB.php");

        //get content from database
        $result = pg_query("SELECT description FROM projects WHERE projectid = '$_GET[projectid]'");
        $row = pg_fetch_row($result);
        echo "Description<br>";
        echo $row[0];
    }
?>
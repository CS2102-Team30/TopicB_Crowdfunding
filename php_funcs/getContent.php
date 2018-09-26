<?php        
    //Log in to DB
    include_once("connectDB.php");
    //check if logged out
    include_once("checkLogOut.php");
    
    //get content from database
    $result = pg_query("SELECT description FROM projects WHERE projectid = '$_GET[projectid]'");
    $row = pg_fetch_row($result);
    echo $row[0];
?>
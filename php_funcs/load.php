<?php
    //check if logged out
    include_once("checkLogOut.php");
    //log in to db
    include_once('connectDB.php');
    
    // Retrieving projects from DB
    // sort by amount_funded by default in descending order
    $counter = $_POST['counter'];
    $page = $_POST['page'];
    if(!isset($_POST['order'])) {
        $order = "desc";
    }
    else {
        $order = $_POST['order'];
    }
            
    if(!isset($_POST['sort'])) {
        $sort = 'amount_funded';
    }
    else {
        $sort = $_POST['sort'];
    }
    
    if (!isset($_POST['search_field'])) {
        $search = null;
    }
    else {
        $search = $_POST['search_field'];
    }

    if($page == '/main.php') {
        $query = "SELECT title, advertiser, start_date, duration, amount_funded, funding_sought, description, projectid 
            FROM projects 
            WHERE UPPER(title) LIKE UPPER('%$search%')
            OR UPPER(keywords) LIKE UPPER('%$search%') 
            ORDER BY $sort $order
            LIMIT 10 OFFSET $counter";
    } else if($page == '/user_projects.php') {
        $query = "SELECT title, advertiser, start_date, duration, amount_funded, funding_sought, description, projectid 
            FROM projects
            WHERE advertiser = '$_SESSION[userid]'
            AND (UPPER(title) LIKE UPPER('%$search%')
            OR UPPER(keywords) LIKE UPPER('%$search%')) 
            ORDER BY $sort $order
            LIMIT 10 OFFSET 0";
    } else if($page == '/funded.php') {
        $query = "SELECT title, advertiser, start_date, duration, amount_funded, funding_sought, description, projectid 
            FROM projects 
            WHERE amount_funded >= funding_sought
            AND (UPPER(title) LIKE UPPER('%$search%')
            OR UPPER(keywords) LIKE UPPER('%$search%'))
            ORDER BY $sort $order";
    } else if($page == "/user_funded.php") {
        $query = "SELECT p.title, p.advertiser, p.start_date, p.duration, p.amount_funded,  p.funding_sought, p.description, p.projectid, i.amount 
            FROM projects p, invest i
            WHERE i.investor = '$_SESSION[userid]' AND p.projectid = i.projectid
            AND (UPPER(p.title) LIKE UPPER('%$search%')
            OR UPPER(p.keywords) LIKE UPPER('%$search%'))
            ORDER BY $sort $order
            LIMIT 10 OFFSET 0";
    }
    
    $result = pg_query($db, $query);
    
    include('../template/project_table.php');
?>
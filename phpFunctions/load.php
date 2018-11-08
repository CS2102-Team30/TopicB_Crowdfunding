<?php
    /* This page will be called from loadjQuery.php, which will fetch the next 10 projects *
     * The projects will then be appended onto the current page via jQuery.                */
     
    //check if logged out
    include_once("checkLogOut.php");
    //log in to db
    include_once('connectDB.php');
    
    // Retrieving projects from DB
    // sort by amount_funded by default in descending order
    $counter = $_POST['counter'];
    $page = $_POST['page'];
    $category = $_POST['category'];
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

    if($page == 'main.php') {
        if ($category == 'All') { 
            $query = "SELECT * 
            FROM projects 
            WHERE UPPER(title) LIKE UPPER('%$search%')
            ORDER BY $sort $order
            LIMIT 10 OFFSET $counter";
        } else {
            $query = "SELECT *
            FROM projects p, belongsTo b
            WHERE UPPER(p.title) LIKE UPPER('%$search%')
            AND p.projectid = b.projectid
            AND b.category = '$category'
            ORDER BY $sort $order
            LIMIT 10 OFFSET $counter";
        }
    } else if($page == 'userProjects.php') {
        if ($category == 'All') {
            $query = "SELECT * 
            FROM projects
            WHERE advertiser = '$_SESSION[userid]'
            AND (UPPER(title) LIKE UPPER('%$search%')
            ORDER BY $sort $order
            LIMIT 10 OFFSET $counter";
        } else {
            $query = "SELECT * 
            FROM projects p, belongsTo b
            WHERE p.advertiser = '$_SESSION[userid]'
            AND UPPER(p.title) LIKE UPPER('%$search%')
            AND p.projectid = b.projectid
            AND b.category = '$category'
            ORDER BY $sort $order
            LIMIT 10 OFFSET $counter";
        }
    } else if($page == 'funded.php') {
        if ($category == 'All') {
            $query = "SELECT * 
            FROM projects 
            WHERE amount_funded >= funding_sought
            AND (UPPER(title) LIKE UPPER('%$search%'))
            ORDER BY $sort $order
            LIMIT 10 OFFSET $counter";
        } else {
            $query = "SELECT *
            FROM projects p, belongsTo b
            WHERE p.amount_funded >= p.funding_sought
            AND (UPPER(p.title) LIKE UPPER('%$search%'))
            AND p.projectid = b.projectid
            AND b.category = '$category' 
            ORDER BY $sort $order
            LIMIT 10 OFFSET $counter";
        }
    } else if($page == "userFunded.php") {
        if ($category == 'All') {
            $query = "SELECT p.title, p.advertiser, p.start_date, p.duration, p.amount_funded,  p.funding_sought, p.description, p.projectid, i.amount 
            FROM projects p, invest i
            WHERE i.investor = '$_SESSION[userid]' AND p.projectid = i.projectid
            AND (UPPER(p.title) LIKE UPPER('%$search%')
            ORDER BY $sort $order
            LIMIT 10 OFFSET $counter";
        } else {
            $query = "SELECT p.title, p.advertiser, p.start_date, p.duration, p.amount_funded, p.funding_sought, p.description, p.projectid, i.amount 
            FROM projects p, invest i, belongsTo b
            WHERE i.investor = '$_SESSION[userid]' AND p.projectid = i.projectid
            AND (UPPER(p.title) LIKE UPPER('%$search%'))
            AND p.projectid = b.projectid
            AND b.category = '$category'
            ORDER BY $sort $order
            LIMIT 10 OFFSET $counter";
        }
    }
    
    $result = pg_query($db, $query);
    
    include('../template/projectTable.php');
?>
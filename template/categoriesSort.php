<!-- Categories Sort Nav Bar -->
<!-- Queries the database and returns projects according to categories -->
<?php 
    //initialising associative array
    $project_columns = array("advertiser" => "Advertiser", "projectid" => "Project ID", "title" => "Title", "description" => "Description", "start_date" => "Start Date", "duration" => "Duration", "funding_sought" => "Funding Sought", "amount_funded" => "Amount Funded");
    $curFileName = basename($_SERVER['PHP_SELF']);
?>

<?php
    $resultCountArts = 0;
    $resultCountTech = 0;
    $resultCountIllustration = 0;
    $resultCountGames = 0;
    $resultCountFood = 0;
    $resultCountMusic = 0;
    $resultCountPublishing = 0;
    $resultCountFilm = 0;

    if (basename($_SERVER['PHP_SELF']) == 'main.php') {
		$queryCountAll = "SELECT COUNT(*) AS count
            FROM projects
            WHERE UPPER(title) LIKE UPPER('%$search%') 
			AND CURRENT_DATE <= (start_date + INTERVAL '1 day' * duration)" ;

        $queryCount = "SELECT b.category AS category, COUNT(*) AS count
            FROM projects p, belongsTo b
            WHERE UPPER(p.title) LIKE UPPER('%$search%') 
			AND CURRENT_DATE <= (start_date + INTERVAL '1 day' * duration)
            AND p.projectid = b.projectid
            GROUP BY b.category";
    }
    else if (basename($_SERVER['PHP_SELF']) == 'userProjects.php') {
        $queryCountAll = "SELECT COUNT(*) AS count 
            FROM projects
            WHERE advertiser = '$_SESSION[userid]'
            AND UPPER(title) LIKE UPPER('%$search%')";

        $queryCount = "SELECT b.category AS category, COUNT(*) AS count 
            FROM projects p, belongsTo b
            WHERE p.advertiser = '$_SESSION[userid]'
            AND UPPER(p.title) LIKE UPPER('%$search%')
            AND p.projectid = b.projectid
            GROUP BY b.category";
    }
    else if (basename($_SERVER['PHP_SELF']) == 'funded.php') {
        $queryCountAll = "SELECT COUNT(*) AS count
            FROM projects
            WHERE amount_funded >= funding_sought
            AND (UPPER(title) LIKE UPPER('%$search%'))";

        $queryCount = "SELECT b.category AS category, COUNT(*) AS count
            FROM projects p, belongsTo b
            WHERE p.amount_funded >= p.funding_sought
            AND (UPPER(p.title) LIKE UPPER('%$search%'))
            AND p.projectid = b.projectid
            GROUP BY b.category";
    }
    else if (basename($_SERVER['PHP_SELF']) == 'userFunded.php') {
        $queryCountAll = "SELECT COUNT(*) AS count
            FROM projects p, invest i
            WHERE i.investor = '$_SESSION[userid]' AND p.projectid = i.projectid
            AND (UPPER(p.title) LIKE UPPER('%$search%'))";

        $queryCount = "SELECT b.category AS category, COUNT(*) AS count
            FROM projects p, invest i, belongsTo b
            WHERE i.investor = '$_SESSION[userid]' AND p.projectid = i.projectid
            AND (UPPER(p.title) LIKE UPPER('%$search%'))
            AND p.projectid = b.projectid
            GROUP BY b.category";
    }

    $resultCountAll = pg_fetch_assoc(pg_query($db, $queryCountAll));
    $resultCount = pg_query($db, $queryCount);

    while ($rowCount = pg_fetch_assoc($resultCount)) {
        if ($rowCount['category'] == 'Arts') $resultCountArts = $rowCount['count'];
        if ($rowCount['category'] == 'Tech') $resultCountTech = $rowCount['count'];
        if ($rowCount['category'] == 'Illustration') $resultCountIllustration = $rowCount['count'];
        if ($rowCount['category'] == 'Games') $resultCountGames = $rowCount['count'];
        if ($rowCount['category'] == 'Food') $resultCountFood = $rowCount['count'];
        if ($rowCount['category'] == 'Music') $resultCountMusic = $rowCount['count'];
        if ($rowCount['category'] == 'Publishing') $resultCountPublishing = $rowCount['count'];
        if ($rowCount['category'] == 'Film') $resultCountFilm = $rowCount['count'];
    }
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="navbar-brand">Search for category: </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCategoriesSort" aria-controls="navbarCategoriesSort" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCategoriesSort">
        <ul class="navbar-nav mr-auto">
             <li class="nav-item <?php if($category == "All") {?>active<?php }?>">
                <a class="nav-link" href="./<?php echo $curFileName;?>?order=<?php echo $order;?>&sort=<?php echo $sort."&search_field=".$search; ?>&category=All"><?php echo "All categories (".$resultCountAll['count'].")";?></a>
            </li>
            <li class="nav-item <?php if($category == "Arts") {?>active<?php }?>">
                <a class="nav-link" href="./<?php echo $curFileName;?>?order=<?php echo $order;?>&sort=<?php echo $sort."&search_field=".$search; ?>&category=Arts"><?php echo "Arts (".$resultCountArts.")";?></a>
            </li>
			<li class="nav-item <?php if($category == "Tech") {?>active<?php }?>">
                <a class="nav-link" href="./<?php echo $curFileName;?>?order=<?php echo $order;?>&sort=<?php echo $sort."&search_field=".$search; ?>&category=Tech"><?php echo "Tech(".$resultCountTech.")";?></a>
            </li>
			<li class="nav-item <?php if($category == "Illustration") {?>active<?php }?>">
                <a class="nav-link" href="./<?php echo $curFileName;?>?order=<?php echo $order;?>&sort=<?php echo $sort."&search_field=".$search; ?>&category=Illustration"><?php echo "Illustration(".$resultCountIllustration.")";?></a>
            </li>
			<li class="nav-item <?php if($category == "Games") {?>active<?php }?>">
                <a class="nav-link" href="./<?php echo $curFileName;?>?order=<?php echo $order;?>&sort=<?php echo $sort."&search_field=".$search; ?>&category=Games"><?php echo "Games(".$resultCountGames.")";?></a>
            </li>
			<li class="nav-item <?php if($category == "Food") {?>active<?php }?>">
                <a class="nav-link" href="./<?php echo $curFileName;?>?order=<?php echo $order;?>&sort=<?php echo $sort."&search_field=".$search; ?>&category=Food"><?php echo "Food(".$resultCountFood.")";?></a>
            </li>
			<li class="nav-item <?php if($category == "Music") {?>active<?php }?>">
                <a class="nav-link" href="./<?php echo $curFileName;?>?order=<?php echo $order;?>&sort=<?php echo $sort."&search_field=".$search; ?>&category=Music"><?php echo "Music(".$resultCountMusic.")";?></a>
            </li>
			<li class="nav-item <?php if($category == "Publishing") {?>active<?php }?>">
                <a class="nav-link" href="./<?php echo $curFileName;?>?order=<?php echo $order;?>&sort=<?php echo $sort."&search_field=".$search; ?>&category=Publishing"><?php echo "Publishing(".$resultCountPublishing.")";?></a>
            </li>
			<li class="nav-item <?php if($category == "Film") {?>active<?php }?>">
                <a class="nav-link" href="./<?php echo $curFileName;?>?order=<?php echo $order;?>&sort=<?php echo $sort."&search_field=".$search; ?>&category=Film"><?php echo "Film(".$resultCountFilm.")";?></a>
            </li>
        </ul>
    </div>
</nav>
<?php 
    //initialising associative array
    $project_columns = array("advertiser" => "Advertiser", "projectid" => "Project ID", "title" => "Title", "description" => "Description", "start_date" => "Start Date", "duration" => "Duration", "keywords" => "Keywords", "funding_sought" => "Funding Sought", "amount_funded" => "Amount Funded");
    
    $curFileName = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="navbar-brand">Sort by:</div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSort" aria-controls="navbarSort" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSort">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if($sort == "title") {?>active<?php }?>">
                <a class="nav-link" href="./<?php echo $curFileName;?>?order=<?php echo $order;?>&sort=title<?php if($curFileName == "search.php") { echo "&search_field=".$search; }?>"><?php echo $project_columns['title'];?></a>
            </li>
           <li class="nav-item <?php if($sort == "advertiser") {?>active<?php }?>">
                <a class="nav-link" href="./<?php echo $curFileName;?>?order=<?php echo $order;?>&sort=advertiser<?php if($curFileName == "search.php") { echo "&search_field=".$search; }?>"><?php echo $project_columns['advertiser'];?></a>
            </li>
            <li class="nav-item <?php if($sort == "funding_sought") {?>active<?php }?>">
                <a  class="nav-link" href="./<?php echo $curFileName;?>?order=<?php echo $order;?>&sort=funding_sought<?php if($curFileName == "search.php") { echo "&search_field=".$search; }?>"><?php echo $project_columns['funding_sought'];?></a>
            </li>
            <li class="nav-item <?php if($sort == "amount_funded") {?>active<?php }?>">
				<a class="nav-link" href="./<?php echo $curFileName;?>?order=<?php echo $order;?>&sort=amount_funded<?php if($curFileName == "search.php") { echo "&search_field=".$search; }?>"><?php echo $project_columns['amount_funded'];?></a>
            </li>
            <li class="nav-item <?php if($order == "asc") {?>active<?php }?>">
                <a class="nav-link" href="./<?php echo $curFileName;?>?order=asc&sort=<?php echo $sort; if($curFileName == "search.php") { echo "&search_field=".$search; }?>">Ascending</a>
            </li>
            <li class="nav-item <?php if($order == "desc") {?>active<?php }?>">
                <a class="nav-link" href="./<?php echo $curFileName;?>?order=desc&sort=<?php echo $sort; if($curFileName == "search.php") { echo "&search_field=".$search; }?>">Descending</a>
            </li>
        </ul>
    </div>
</nav>
<?php 
    //initialising associative array
    $project_columns = array("advertiser" => "Advertiser", "projectid" => "Project ID", "title" => "Title", "description" => "Description", "start_date" => "Start Date", "duration" => "Duration", "funding_sought" => "Funding Sought", "amount_funded" => "Amount Funded");
    $curFileName = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="navbar-brand">Search for category: </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSort" aria-controls="navbarSort" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSort">
        <ul class="navbar-nav mr-auto">
             <li class="nav-item <?php if($category == "All") {?>active<?php }?>">
                <a class="nav-link" href="./<?php echo $curFileName;?>?order=<?php echo $order;?>&sort=<?php echo $sort."&search_field=".$search; ?>&category=All"><?php echo "All categories";?></a>
            </li>
            <li class="nav-item <?php if($category == "Arts") {?>active<?php }?>">
                <a class="nav-link" href="./<?php echo $curFileName;?>?order=<?php echo $order;?>&sort=<?php echo $sort."&search_field=".$search; ?>&category=Arts"><?php echo "Arts";?></a>
            </li>
			<li class="nav-item <?php if($category == "Tech") {?>active<?php }?>">
                <a class="nav-link" href="./<?php echo $curFileName;?>?order=<?php echo $order;?>&sort=<?php echo $sort."&search_field=".$search; ?>&category=Tech"><?php echo "Tech";?></a>
            </li>
			<li class="nav-item <?php if($category == "Illustration") {?>active<?php }?>">
                <a class="nav-link" href="./<?php echo $curFileName;?>?order=<?php echo $order;?>&sort=<?php echo $sort."&search_field=".$search; ?>&category=Illustration"><?php echo "Illustration";?></a>
            </li>
			<li class="nav-item <?php if($category == "Games") {?>active<?php }?>">
                <a class="nav-link" href="./<?php echo $curFileName;?>?order=<?php echo $order;?>&sort=<?php echo $sort."&search_field=".$search; ?>&category=Games"><?php echo "Games";?></a>
            </li>
			<li class="nav-item <?php if($category == "Food") {?>active<?php }?>">
                <a class="nav-link" href="./<?php echo $curFileName;?>?order=<?php echo $order;?>&sort=<?php echo $sort."&search_field=".$search; ?>&category=Food"><?php echo "Food";?></a>
            </li>
			<li class="nav-item <?php if($category == "Music") {?>active<?php }?>">
                <a class="nav-link" href="./<?php echo $curFileName;?>?order=<?php echo $order;?>&sort=<?php echo $sort."&search_field=".$search; ?>&category=Music"><?php echo "Music";?></a>
            </li>
			<li class="nav-item <?php if($category == "Publishing") {?>active<?php }?>">
                <a class="nav-link" href="./<?php echo $curFileName;?>?order=<?php echo $order;?>&sort=<?php echo $sort."&search_field=".$search; ?>&category=Publishing"><?php echo "Publishing";?></a>
            </li>
			<li class="nav-item <?php if($category == "Film") {?>active<?php }?>">
                <a class="nav-link" href="./<?php echo $curFileName;?>?order=<?php echo $order;?>&sort=<?php echo $sort."&search_field=".$search; ?>&category=Film"><?php echo "Film";?></a>
            </li>
        </ul>
    </div>
</nav>
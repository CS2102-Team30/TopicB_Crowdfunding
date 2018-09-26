<!DOCTYPE html>  
<html lang="en">
    <head>
        <title>Welcome to Crowdfunding!</title>
        <?php include("./template/head.php"); ?>
    </head>
    
    <body>
        <?php
            //check if logged out
            include_once("./php_funcs/checkLogOut.php");
            //log in to db
            include_once('./php_funcs/connectDB.php');
        ?>
        
        <!-- Nav bar -->
        <?php include("./template/nav.php"); ?>
        
        <div class="container">
            <br>
            <h1>Your advertised projects</h1>
            <br>
            
            <?php
                // Retrieving projects from DB
                $result = pg_query("SELECT title, advertiser, start_date, duration, amount_funded, funding_sought FROM projects WHERE advertiser = '$_SESSION[userid]'");
            ?>

            <table class="table table-hover table-bordered thead-light">
                <tr>
                <?php 
                    for($i = 0; $i < pg_num_fields($result); $i++) {
                        $fieldName = pg_field_name($result, $i);
                ?>
                        <th><?php echo $fieldName?></th>
                <?php
                    }
                ?>
                </tr>
                <?php
                    // Getting data
                    while ($row = pg_fetch_row($result))  {
                ?>
                        <tr>
                <?php
                        for($i = 0;$i < 6; $i++) {
                            $cur_row = current($row);
                ?>
                            <td><?php echo $cur_row?></td>
                <?php
                            next($row);
                        }
                ?>
                        </tr>
                <?php
                    }
                    // free result
                    pg_free_result($result);
                ?>
            </table>
            <?php
                if (isset($_POST[logout_submit])) {
                    include('./php_funcs/logOut.php');
                }
            ?>
        </div>
    </body>
</html>
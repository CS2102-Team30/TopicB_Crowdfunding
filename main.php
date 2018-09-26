<!DOCTYPE html>  
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
            <h1>Browse through projects!</h1>
            <br>
            <?php
                // Retrieving projects from DB
                $result = pg_query('SELECT title, advertiser, start_date, duration, amount_funded, funding_sought, projectid FROM projects');
            ?>
            
            <!-- Display information from Database in table form -->
            <?php include('./template/project_table.php'); ?>
            
            <?php
                if (isset($_POST[logout_submit])) {
                    include('./php_funcs/logOut.php');
                }
            ?>
        </div>
        
        <script>
            $(document).ready(function () {
                $(".projectRow").click(function () {
                    console.log($(this).data());
                    var content = './getContent.php?projectid=';
                    content += $(this).data().id;
                    console.log(content);
                    $('.modal-body').load(content, function() {
                        $('#projectModal').modal();
                    });
                });
            });
        </script>       
    </body>
    
<!-- Modal -->
<div id="projectModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="text-left">Modal Header</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>  
    </div>
</div>
</html>
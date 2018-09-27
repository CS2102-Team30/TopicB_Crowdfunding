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
                $result = pg_query("SELECT title, advertiser, start_date, duration, amount_funded, funding_sought, description, projectid FROM projects WHERE advertiser = '$_SESSION[userid]'");
            ?>
             <!-- Display information from Database in table form -->
            <?php include("./template/project_table.php"); ?>
        </div>

        <script>
            $(document).ready(function () {
                $("#projectModal").on('show.bs.modal', function (event) {
					var button = $(event.relatedTarget);
					var modal = $(this);
					modal.find('.modal-title').text("Details about " + button.data('title'));
					modal.find('.modal-body #description').text("Description: " + button.data('description'));
					modal.find('.modal-body #startdate').text("Start Date: " + button.data('startdate'));
					modal.find('.modal-body #duration').text("Duration: " + button.data('duration') + " days");
                });

			// 	console.log($(this).data());
                
            //     content += $(this).data().id;
            //      $('.modal-body').load(content, function() {
            //         $('#projectModal').modal();
            //     });
            });
        </script>
    </body>

    <!-- Modal -->
    <div id="projectModal" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="text-left"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
					<p id="description"/>
					<p id="startdate"/>
					<p id="duration"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>  
        </div>
    </div>
</html>
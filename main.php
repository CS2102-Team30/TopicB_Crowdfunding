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
            <h2>Browse projects here:</h2>
			
			<!-- Nav tabs -->
			<ul class="nav nav-tabs">
				<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#viewAll">View All</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#viewFunded">View Funded</a></li>
			</ul>
            
			<!-- Tab content -->
			<div class="tab-content">
				<div id="viewAll" class="tab-pane show active">
					<br>
					<h3>Creative projects coming to life.</h3>
					<p> Here are the list of all projects.</p>
					<br>
					<?php
						// Retrieving projects from DB
						$result = pg_query('SELECT title, advertiser, start_date, duration, amount_funded, funding_sought, projectid, description FROM projects');
                        
                        // Converting to JSON object for DataTables to utilise
                        $resultArray = pg_fetch_all($result);
					?>

					<?php include('./template/project_table.php'); ?>
				</div>
				
				<div id="viewFunded" class="tab-pane fade">
					<br>
					<h3>Our success stories.</h3>
					<p> We love to see projects succeed through our platform. <br>
						Here are the list of projects that have met and exceeded their own fund goals.</p>
					<br>
					<?php
						// Retrieving projects from DB
						$result = pg_query('SELECT title, advertiser, start_date, duration, amount_funded, funding_sought, description, projectid FROM projects
							WHERE amount_funded >= funding_sought');
					?>

					<?php include('./template/project_table.php'); ?>
				</div>
			</div>
        </div>
        
        <!-- DataTable JS Script here -->
        <script>
            function format ( d ) {
                // `d` is the original data object for the row
                console.log(d.start_date);
                var startDate = new Date(d.start_date);
                var endDate = new Date(d.start_date);
                endDate.setTime(endDate.getTime() + d.duration*86400000);
                
                return '<table>'+
                    '<tr>'+
                        '<td>Description:</td>'+
                        '<td>'+d.description+'</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<td>Duration of project:</td>'+
                        '<td>'+startDate.toLocaleDateString("en-UK")+' to '+endDate.toLocaleDateString("en-UK")+'</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<td>Progress:</td>'+
                        '<td>'+'$' + d.amount_funded + ' raised/' + '$' + d.funding_sought+' required'+'</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<td>Project ID:</td>'+
                        '<td>'+d.projectid+'</td>'+
                    '</tr>'+
                '</table>';
            }
            
            var resultdata = <?php echo json_encode($resultArray); ?>;
            
            $(document).ready(function() {
                var table = $('#projectTable').DataTable({
                    "data": resultdata,
                    "columnDefs": [
                        { 
                            "className": "details-control",
                            "targets": "_all"
                        },
                        {
                            "targets": [3],
                            "visible": false
                        },
                        {
                            "targets": [4],
                            "visible": false
                        }
                    ],
                    "columns": [
                        { "data": "title" },
                        { "data": "advertiser" },
                        { "data": "amount_funded" },
                        { "data": "description" },
                        { "data": "projectid" },
                    ],
                    "order": [[2, 'asc']]
                });
            
                // Add event listener for opening and closing details
                $('#projectTable tbody').on('click', 'td.details-control', function () {
                    var tr = $(this).closest('tr');
                    var row = table.row( tr );
             
                    if ( row.child.isShown() ) {
                        // This row is already open - close it
                        row.child.hide();
                        tr.removeClass('shown');
                    }
                    else {
                        // Open this row
                        row.child( format(row.data()) ).show();
                        tr.addClass('shown');
                    }
                });
            });
        </script>
    </body>
</html>
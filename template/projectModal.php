<!-- This is Modal where project details are shown in -->
<script>
    $(document).ready(function () {
        $("#projectModal").on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            modal.find('.modal-title').text("Details about " + button.data('title')).val(button.data('title'));
            modal.find('.modal-body #description').text("Description: " + button.data('description')).val(button.data('description'));
            modal.find('.modal-body #startdate').text("Start Date: " + button.data('startdate')).val(button.data('startdate'));
            modal.find('.modal-body #duration').text("Duration: " + button.data('duration') + " days").val(button.data('duration'));
            modal.find('.modal-body #projectid').text(button.data('projectid'));
            modal.find('.modal-footer #deletebutton').val(button.data('projectid'));
            modal.find('.modal-body #projectid').val(button.data('projectid'));
			modal.find('.modal-body #amount_sought').val(button.data('funding'));
            
            //check if current date is greater than start date + duration
            var now = new Date();
            var startDateString = button.data('startdate');
            var duration = button.data('duration');
            
            //splitting startDate and creating date object
            var parts = startDateString.split('-');
            var startDate = new Date(parts[0], parts[1] - 1, parts[2]);
            
            //add duration (in days) to startDate
            var endDate = startDate.setTime(startDate.getTime() + (duration+1) * 86400000);
            //converting back to date object
            var endDate = new Date(endDate);
            var currentAmt = button.data('funded');
            var neededAmt = button.data('funding');
            if(now > endDate || currentAmt >= neededAmt) {
                $("#submit-funding").hide();
				$("#deletebutton").hide();
            } else {
                $("#submit-funding").show();
				$("#deletebutton").show();
            }
			if(now > endDate) {
                $("#projectExpiredText").show();
            } else {
                $("#projectExpiredText").hide();
            }
			if(currentAmt >= neededAmt) {
                $("#projectSucceededText").show();
			} else {
                $("#projectSucceededText").hide();
            }
        });
        
    // 	console.log($(this).data());
        
    //     content += $(this).data().id;
    //      $('.modal-body').load(content, function() {
    //         $('#projectModal').modal();
    //     });
	
    });
</script>

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
                
                <form id="submit-funding" method="POST" action="./phpFunctions/processFund.php">
                    <div class="form-group row">
                        <label for="fund" class="col-lg-3 col-form-label text-right">Fund them! $</label>
                        <div class="col-lg-4">
                            <input name="amount" class="form-control" placeholder="amount" type="number" min="0" max = "2147483647" required />
                        </div>
                        <input name="projectid" type="hidden" id="projectid" value="" required />
                        <input name="amount_sought" type="hidden" id="amount_sought" value="" required />
						<div class="col-lg-2">
                            <button class="btn btn-primary" type="submit">Fund!</button>
                        </div>
                    </div>
					<p>Note that the amount you enter will replace your previously submitted amount (if any). Enter $0 if you wish to remove your previously submitted amount.</p>
                </form>
                <div id="projectExpiredText">
                    <b>This project has expired!</b>
                </div>
				<div id="projectSucceededText">
                    <b>This project has already been fully funded!</b>
                </div>
            </div>
            <div class="modal-footer">
				<?php if($_SERVER['PHP_SELF'] == '/userProjects.php' || $_SESSION['isadmin'] == "t") { ?>
					<button id="deletebutton" type="button" class="btn btn-secondary mr-auto" data-modal-action="delete">Delete</button>
                <?php } ?>
				<?php if($_SESSION['isadmin'] == "t") { ?>
					<button id="editbutton" type="button" class="btn btn-secondary mr-auto" data-modal-action="edit" data-dismiss="modal">Edit</button>
                <?php } ?>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>  
    </div>
</div>
<script>
	$("[data-modal-action=delete]").click(function (event) {
			var button = $(event.target);
			var id = button.val();
			$("#projectModal").modal("hide");

			var form = document.createElement("form");
			form.setAttribute("method", "post");
			form.setAttribute("action", "phpFunctions/processDelete.php");

			var hiddenField = document.createElement("input");
			hiddenField.setAttribute("type", "hidden");
			hiddenField.setAttribute("name", "deleteid");
			hiddenField.setAttribute("value", id);
			form.appendChild(hiddenField);
			document.body.appendChild(form);
			form.submit();	
		});
	$("[data-modal-action=edit]").click(function (event) {
			$('#edit_title').val($('#projectModal').find('.modal-title').val());
			$('#edit_projectid').val($('#projectid').val());
			$('#edit_description').val($('#description').val());
			$('#edit_amount_sought').val($('#amount_sought').val());
			$('#edit_start_date').val($('#startdate').val());	
			$('#edit_duration').val($('#duration').val());
			
			$('#editModal').modal('show');
		});	
</script>
<script>
    $(document).ready(function () {
        $("#projectModal").on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            modal.find('.modal-title').text("Details about " + button.data('title'));
            modal.find('.modal-body #description').text("Description: " + button.data('description'));
            modal.find('.modal-body #startdate').text("Start Date: " + button.data('startdate'));
            modal.find('.modal-body #duration').text("Duration: " + button.data('duration') + " days");
            modal.find('.modal-body #projectid').text(button.data('projectid'));
            modal.find('.modal-footer #deletebutton').val(button.data('projectid'));
            modal.find('.modal-body #projectid').val(button.data('projectid'));
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
                
                <form id="submit-funding" method="POST" action="./php_funcs/process_fund.php">
                    <div class="form-group row">
                        <label for="fund" style="padding-right: 0" class="col-lg-3 col-form-label text-right">Fund them! $</label>
                        <div class="col-lg-4">
                            <input name="amount" style="padding-left: 1%" class="form-control" placeholder="amount" type="number" min="1" required />
                        </div>
                        <input name="projectid" type="hidden" id="projectid" value="" required />
                        <div class="col-lg-2">
                            <button class="btn btn-primary" type="submit">Fund!</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="deletebutton" type="button" class="btn btn-secondary mr-auto" data-modal-action="delete">Delete</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>  
    </div>
</div>
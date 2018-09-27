<?php
    // Converting to JSON object for DataTables to utilise
    // Make sure you have queried the DB before using this script.
    $resultArray = pg_fetch_all($result);
?>
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
                '<td>'+startDate.toLocaleDateString("en-GB")+' to '+endDate.toLocaleDateString("en-GB")+'</td>'+
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
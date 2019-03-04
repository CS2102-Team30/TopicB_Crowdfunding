<script>
    //function that handles loading more entries. Will call load.php to fetch next 10 entries from database
    $(document).ready(function() {
        $(document).on('click', '#btn_more', function() {
            var counter = $(this).data("counter");
            var order = "<?php echo $order ?>";
            var sort = "<?php echo $sort ?>";
            var category= "<?php echo $category ?>";
            var page = "<?php echo basename($_SERVER['PHP_SELF']) ?>";
            <?php 
                if($search != null) {
                    echo 'var search_field ="'.$search.'";';
                }
                else {
                    echo 'var search_field = "";';
                }
            ?>
            $('#btn_more').html("Loading...");
            $.ajax( {
                url:"./phpFunctions/load.php",
                method:"POST",
                data:{counter:counter,
                      search_field:search_field,
                      sort:sort,
                      order:order,
                      category:category,
                      page:page},
                dataType:"text",
                success:function(data) {
                     if($.trim(data)) {
                          $('#load_more').remove();
                          $('#results').append(data);
                     }
                }
            });
        });
    });
</script>
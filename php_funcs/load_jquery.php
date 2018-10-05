<script>
    //function that handles loading more entries
    $(document).ready(function() {
        $(document).on('click', '#btn_more', function() {
            var counter = $(this).data("counter");
            var order = "<?php echo $order ?>";
            var sort = "<?php echo $sort ?>";
            var page = "<?php echo $_SERVER['PHP_SELF'] ?>";
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
                url:"./php_funcs/load.php",
                method:"POST",
                data:{counter:counter,
                      search_field:search_field,
                      sort:sort,
                      order:order,
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
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
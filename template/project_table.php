<table class="table table-hover table-bordered thead-light">
    <tr>
    <?php
        //last row is which we do not want to load. hence -1 in for loop
        for($i = 0; $i < pg_num_fields($result)-1; $i++) {
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
            <tr class="projectRow" data-id="<?php echo $projectid;?>">
    <?php
            for($i = 0;$i < 6; $i++) {
                $cur_row = current($row);
    ?>
                <td><?php echo $cur_row?></td>
    <?php
                next($row);
            }
            $projectid = current($row);
            next($row);
    ?>
            </tr>
    <?php
        }
        // free result
        pg_free_result($result);
    ?>
</table>
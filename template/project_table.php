<table id="projecttable" class="table table-hover table-bordered thead-light">
    <thead><tr>
    <?php
        //last column is project id which we do not want to load in the table. hence -1 in for loop
        $minus = 1;
        for($i = 0; $i < pg_num_fields($result)- $minus; $i++) {
            $fieldName = pg_field_name($result, $i);
    ?>
            <th><?php echo $fieldName?></th>
    <?php
        }
    ?>
    </tr></thead>
    <tbody>
    <?php
        // Getting data, index var stores the index of the rows
        $index = 0;
        while ($row = pg_fetch_row($result))  {
            $projectid = $row[pg_num_fields($result)-1];
    ?>
            <tr class="projectRow" data-id="<?php echo $projectid;?>">
    <?php
            for($i = 0;$i < pg_num_fields($result)- $minus; $i++) {
                $cur_row = current($row);
    ?>
                <td><?php echo $cur_row?></td>
    <?php
                next($row);
            }
            $index++;
    ?>
            </tr>
    <?php
        }
    ?>
    </tbody>
</table>
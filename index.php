<?php include_once 'db_manager.php'?>
<table>
    <tr>
        <th>Constituencies</th>
        <th>Wards</th>
    </tr>
    <?php
        foreach (all_constituencies() as $constituency) {
            if (sizeof(get_wards($constituency['id'])) <= 0) {
//                print_r(get_sub_counties($county['id']));
    ?>
        <tr>
            <td><?=$constituency['name']?></td>
            <td><a href="add_wards.php?name=<?=$constituency['name']?>&constituency_id=<?=$constituency['id']?>">Add  Wards</a> </td>
        </tr>

    <?php } }?>
</table>

<?php
#----- Require -----#
require("../../../connection/connection.php");

if (!empty($_POST['plaint_id'])) { ?>
    <div class="table-responsive">
        <table class="align-middle mb-0 table table-borderless table-striped table-hover table-login">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>ของกลาง</th>
                    <th class="text-center">จำนวน</th>
                    <th class="text-center">หน่อย</th>
                    <th class="text-center">แก้ใข</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = '1';
                $sqlp = "SELECT * FROM plaint WHERE id > '0' AND status = '1' AND offender = '" . $id . "' ORDER BY id ASC";
                $resulp = mysqli_query($connection, $sqlp);
                while ($rowp = mysqli_fetch_assoc($resulp)) {
                ?>
                    <tr>
                        <td class="text-center text-muted"><?php echo $i; ?></td>
                        <td><?php echo get_value('plaint_type', 'id', 'name', $rowp['plaint_type'], $connection); ?></td>
                        <td class="text-center"><?php echo DateThai($rowp['plaint_date']); ?></td>
                        <td class="text-center"><?php echo date('H:i', strtotime($rowp['plaint_time'])) . " น."; ?></td>
                        <td class="text-center"><?php echo $rowp['plaint_address']; ?></td>
                        <td class="text-center">
                            <a href="#view" onclick="view_material('<?php echo $rowp['id']; ?>', 'ajax_view_material')"><i class="fas fa-eye"></i></a>
                        </td>
                        <td class="text-center">
                            <a href="./?mode=offender/save_plaint&offen=<?php echo $id; ?>&id=<?php echo $rowp['id']; ?>"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                <?php $i++;
                } ?>
            </tbody>
        </table>
    </div>
<?php } ?>
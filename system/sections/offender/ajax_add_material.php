<?php
#----- Require -----#
require("../../../connection/connection.php");

#----- Save Database -----#
if (!empty($_POST['material_type'])) {
    if ($_POST['material_type'] == 'add_material_type') {
        $sql = "INSERT INTO material_type () VALUES ()";
        $result = mysqli_query($connection, $sql);
        $id = mysqli_insert_id($connection);

        if (!empty($id)) {
            $sql = "UPDATE material_type SET ";
            $sql .= "status = '1',";
            $sql .= "name = '$name',";
            $sql .= "unit = '$unit',";
            $sql .= "last_edit = now() ";
            $sql .= " WHERE id = '$id'";

            $result = mysqli_query($connection, $sql); ?>

            <label for="material_type" class=""><b> หลักฐาน </b></label>
            <select id="material_type" name="material_type" class="form-control" onchange="add_material('ajax_add_material')">
                <option value="" id="zero_material"> กรุณาเลือก... </option>
                <?php
                $sqlmt = "SELECT * FROM material_type WHERE id > '0' AND status = '1' ORDER BY id ASC";
                $resulmt = mysqli_query($connection, $sqlmt);
                while ($rowmt = mysqli_fetch_assoc($resulmt)) {
                ?>
                    <option value="<?php echo $rowmt['id']; ?>" ><?php echo $rowmt['name']; ?></option>
                <?php } /* while ($rowpt = mysqli_fetch_assoc($resulpt)) { */ ?>
                <option value="add_material_type"> เพิ่มหลักฐาน </option>
            </select>
        <?php
        }
    } else {
        ?>
        <label for="plaint_time" class=""><b> หน่วย </b></label>
        <input name="unit" id="unit" type="text" class="form-control" value="<?php echo get_value('material_type', 'id', 'unit', $_POST['material_type'], $connection); ?>" readonly>
<?php
    }
}
mysqli_close($connection);
?>
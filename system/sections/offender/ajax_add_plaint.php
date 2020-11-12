<?php
#----- Require -----#
require("../../../connection/connection.php");

#----- Save Database -----#
if (!empty($_POST['plaint_type'])) {
    $sql = "INSERT INTO plaint_type () VALUES ()";
    $result = mysqli_query($connection, $sql);
    $id = mysqli_insert_id($connection);

    if (!empty($id)) {
        $sql = "UPDATE plaint_type SET ";
        $sql .= "status = '1',";
        $sql .= "name = '" . $_POST['plaint_type'] . "',";
        $sql .= "last_edit = now() ";
        $sql .= " WHERE id = '$id'";

        $result = mysqli_query($connection, $sql); ?>

        <label for="plaint_type" class=""><b>ข้อหา</b></label>
        <select id="plaint_type" name="plaint_type" class="form-control" onchange="add_plaintt('ajax_add_plaint')">
            <option value="" id="zero_plaint_type"> กรุณาเลือก... </option>
            <?php
            $sqlpt = "SELECT * FROM plaint_type WHERE id > '0' AND status = '1' ORDER BY id ASC";
            $resulpt = mysqli_query($connection, $sqlpt);
            while ($rowpt = mysqli_fetch_assoc($resulpt)) {
            ?>
                <option value="<?php echo $rowpt['id']; ?>" <?php if ($rowpt['id'] == '') {
                                                                echo "selected";
                                                            } ?>><?php echo $rowpt['name']; ?></option>
            <?php } /* while ($rowpt = mysqli_fetch_assoc($resulpt)) { */ ?>
            <option value="add_plaint_type"> เพิ่มข้อหา </option>
        </select>
<?php
    }
}
mysqli_close($connection);
?>

<?php
$offen = $_GET['offen'];
$id = $_GET['id'];
if (!empty($id)) {
    $sql = "SELECT * FROM plaint WHERE id = '$id'";
    $result = mysqli_query($connection, $sql);
    $total = mysqli_num_rows($result);

    if ($total == 0) {
        echo "<meta http-equiv=\"refresh\" content=\"0; url = './?mode=offender/index'\" >";
    }

    $row = mysqli_fetch_assoc($result);

    $page_title = $row['offen'];
} else {
    $page_title = "Create";
}    
?>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-3 widget-content">
            <div class="widget-content-outer">
                <div class="widget-content-left">
                    <h5><b>เพิ่มข้อหา</b></h5>
                    <form method="POST" action="./?mode=offender/save_plaint&id=<?php echo $id; ?>" enctype="multipart/form-data">
                        <input type="hidden" name="page_title" id="page_title" value="<?php echo $page_title; ?>">
                        <input type="hidden" name="offen" id="offen" value="<?php echo $offen; ?>">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="plaint_type" class=""><b>ข้อหา</b></label>
                                    <select id="plaint_type" name="plaint_type" class="form-control" onchange="add_plaintt('add_plaint_type')">
                                        <option value=""> กรุณาเลือก... </option>
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
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="plaint_date" class=""><b>วันที่</b></label>
                                    <input name="plaint_date" id="plaint_date" type="date" class="form-control" value="<?php echo $row['plaint_date']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="plaint_time" class=""><b>เวลา</b></label>
                                    <input name="plaint_time" id="plaint_time" type="time" class="form-control" value="<?php echo $row['plaint_time']; ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    <label for="plaint_address" class=""><b>สถานที่</b></label>
                                    <textarea class="form-control" name="plaint_address" id="plaint_address" rows="6"><?php echo $row['plaint_address']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button class="mt-2 btn btn-success"><i class="fas fa-plus"></i>&nbsp; บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php mysqli_close($connection); ?>
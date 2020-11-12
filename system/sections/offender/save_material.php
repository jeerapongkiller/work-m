<?php 
#----- Require -----#
require("../../../connection/connection.php");

if (!empty($_POST['plaint'])) { ?>
    <form method="POST" action="./?mode=offender/process_material" enctype="multipart/form-data">
        <input type="hidden" name="plaint" id="plaint" value="<?php echo $_POST['plaint']; ?>">
        <div class="form-row">
            <div class="col-md-4">
                <div class="position-relative form-group text-left">
                    <label for="material" class=""><b>ของกลาง</b></label>
                    <select id="material" name="material" class="form-control">
                        <option value=""> กรุณาเลือก... </option>
                        <?php
                        $sqlm = "SELECT * FROM material WHERE id > '0' AND status = '1' ORDER BY id ASC";
                        $resulm = mysqli_query($connection, $sqlm);
                        while ($rowm = mysqli_fetch_assoc($resulm)) {
                        ?>
                            <option value="<?php echo $rowm['id']; ?>" ><?php echo $rowm['name']; ?></option>
                        <?php } /* while ($rowm = mysqli_fetch_assoc($resulm)) { */ ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="position-relative form-group text-left">
                    <label for="plaint_date" class=""><b>วันที่</b></label>
                    <input name="plaint_date" id="plaint_date" type="date" class="form-control" value="<?php echo !empty($row['plaint_date']) ? $row['plaint_date'] : ''; ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="position-relative form-group text-left">
                    <label for="plaint_time" class=""><b>เวลา</b></label>
                    <input name="plaint_time" id="plaint_time" type="time" class="form-control" value="<?php echo !empty($row['plaint_time']) ? $row['plaint_time'] : ''; ?>">
                </div>
            </div>
            <div class="col-md-12">
                <div class="position-relative form-group text-left">
                    <label for="plaint_address" class=""><b>สถานที่</b></label>
                    <textarea class="form-control" name="plaint_address" id="plaint_address" rows="6"><?php echo !empty($row['plaint_address']) ? $row['plaint_address'] : ''; ?></textarea>
                </div>
            </div>
        </div>
        <div class="text-right">
            <button class="mt-2 btn btn-success"><i class="fas fa-plus"></i>&nbsp; บันทึก</button>
        </div>
    </form>
<?php } ?>
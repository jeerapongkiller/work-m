<?php
$id = $_GET['id'];
if (!empty($id)) {
    $sql = "SELECT * FROM offender WHERE id = '$id'";
    $result = mysqli_query($connection, $sql);
    $total = mysqli_num_rows($result);

    if ($total == 0) {
        echo "<meta http-equiv=\"refresh\" content=\"0; url = './?mode=offender/index'\" >";
    }

    $row = mysqli_fetch_assoc($result);

    $page_title = $row['name'];
} else {
    $page_title = "Create";
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-3 widget-content">
            <div class="widget-content-outer">
                <div class="widget-content-left">
                    <h5><b>เพิ่มพนักงาน</b></h5>
                    <form method="POST" action="./?mode=offender/process&id=<?php echo $id; ?>" enctype="multipart/form-data">
                        <input type="hidden" name="page_title" id="page_title" value="<?php echo $page_title; ?>">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="titlename" class=""><b>คำนำหน้า</b></label>
                                    <select id="titlename" name="titlename" class="form-control">
                                        <option value=""> กรุณาเลือก... </option>
                                        <?php
                                        $sqltt = "SELECT * FROM titlename WHERE id > '0' ORDER BY id ASC";
                                        $resultt = mysqli_query($connection, $sqltt);
                                        while ($rowtt = mysqli_fetch_assoc($resultt)) {
                                        ?>
                                            <option value="<?php echo $rowtt['id']; ?>" <?php if ($rowtt['id'] == $row['titlename']) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $rowtt['name']; ?></option>
                                        <?php } /* while($rowtt = mysqli_fetch_assoc($resultt)){ */ ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="firstname" class=""><b>ชื่อ</b></label>
                                    <input name="firstname" id="firstname" type="text" class="form-control" value="<?php echo $row['firstname']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="lastname" class=""><b>นามสกุล</b></label>
                                    <input name="lastname" id="lastname" type="text" class="form-control" value="<?php echo $row['lastname']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="id_card" class=""><b>รหัสบัตรประชาชน</b></label>
                                    <input name="id_card" id="id_card" type="text" class="form-control" value="<?php echo $row['id_card']; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group">
                                    <label for="age" class=""><b>อายุ</b></label>
                                    <input name="age" id="age" type="text" class="form-control" value="<?php echo $row['age']; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group">
                                    <label for="sex" class=""><b>เพศ</b></label>
                                    <input name="sex" id="sex" type="text" class="form-control" value="<?php echo $row['sex']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="phone" class=""><b>เบอร์โทร</b></label>
                                    <input name="phone" id="phone" type="text" class="form-control" value="<?php echo $row['phone']; ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    <label for="address" class=""><b>ที่อยู่</b></label>
                                    <textarea class="form-control" name="address" id="address" rows="6"><?php echo $row['address']; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="photo1" class=""><b>รูป (หน้าผู้กระทำความผิด)</b></label>
                                    <input type="file" name="photo1" id="photo1" class="dropify" data-default-file="assets/images/offender/<?php echo $row['photo1']; ?>" data-max-file-size="2M" data-allowed-file-extensions="jpg jpeg png" data-show-remove="false" />
                                    <input type="hidden" name="photo_de1" id="photo_de1" value="<?php echo $row['photo1']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="photo2" class=""><b>รูป (เพิ่มเติม)</b></label>
                                    <input type="file" name="photo2" id="photo2" class="dropify" data-default-file="assets/images/offender/<?php echo $row['photo2']; ?>" data-max-file-size="2M" data-allowed-file-extensions="jpg jpeg png" data-show-remove="false" />
                                    <input type="hidden" name="photo_de2" id="photo_de2" value="<?php echo $row['photo2']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="photo3" class=""><b>รูป (เพิ่มเติม)</b></label>
                                    <input type="file" name="photo3" id="photo3" class="dropify" data-default-file="assets/images/offender/<?php echo $row['photo3']; ?>" data-max-file-size="2M" data-allowed-file-extensions="jpg jpeg png" data-show-remove="false" />
                                    <input type="hidden" name="photo_de3" id="photo_de3" value="<?php echo $row['photo3']; ?>">
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

<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-header mt-2 mb-3">
                <h5><b>ข้อหา</b></h5>
                <div class="btn-actions-pane-right">
                    <div role="group" class="btn-group-sm btn-group">
                        <a href="./?mode=offender/create_plaint&offen=<?php echo $id; ?>" class="mb-3 btn btn-info btn-lg" ><i class="fas fa-plus"></i>&nbsp; เพิ่มข้อหา</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover table-login">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>ข้อหา</th>
                            <th class="text-center">วันที่จับ</th>
                            <th class="text-center">เวลาจับ</th>
                            <th class="text-center">สถานที่จับ</th>
                            <th class="text-center">หลักฐาน</th>
                            <th class="text-center">แก้ใข</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $i = '1';
                            $sqlp = "SELECT * FROM plaint WHERE id > '0' AND status = '1' AND offender = '". $id ."' ORDER BY id ASC";
                            $resulp = mysqli_query($connection, $sqlp);
                            while ($rowp = mysqli_fetch_assoc($resulp)) {
                        ?>
                        <tr>
                            <td class="text-center text-muted"><?php echo $i; ?></td>
                            <td><?php echo get_value('plaint_type', 'id', 'name', $rowp['plaint_type'], $connection); ?></td>
                            <td class="text-center"><?php echo $rowp['plaint_date']; ?></td>
                            <td class="text-center"><?php echo $rowp['plaint_time']; ?></td>
                            <td class="text-center"><?php echo $rowp['plaint_address']; ?></td>
                            <td class="text-center">
                                <a href="#"><i class="fas fa-eye"></i></a>
                            </td>
                            <td class="text-center">
                                <a href="./?mode=offender/create_plaint&offen=<?php echo $id; ?>&id=<?php echo $rowp['id']; ?>"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
            <div class="d-block text-center card-footer">

            </div>
        </div>
    </div>
</div>

<?php mysqli_close($connection); ?>
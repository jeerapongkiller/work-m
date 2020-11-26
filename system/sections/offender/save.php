<?php
$id = !empty($_GET['id']) ? $_GET['id'] : '';
if (!empty($id)) {
    $sql = "SELECT * FROM offender WHERE id = '$id'";
    $result = mysqli_query($connection, $sql);
    $total = mysqli_num_rows($result);

    if ($total == 0) {
        echo "<meta http-equiv=\"refresh\" content=\"0; url = './?mode=offender/index'\" >";
    }

    $row = mysqli_fetch_assoc($result);

    $page_title = $row['firstname'] . ' ' . $row['lastname'];
} else {
    $page_title = "Create";
}
?>

<script>
    function number_control() {
        var id_card = document.getElementById('id_card');
        id_card.value = id_card.value.replace(/[^0-9]+/, '');
    }

    function view_material(plaint_id, plaint_name, page) {
        if (plaint_id != '') {
            jQuery.ajax({
                url: "sections/offender/" + page + ".php",
                data: {
                    plaint_id: plaint_id
                },
                type: "POST",
                success: function(response) {
                    if (response) {
                        swal.fire({
                            title: 'ข้อหา '+plaint_name,
                            width: 1000,
                            html: response,
                            showConfirmButton: false,
                            showCancelButton: false,
                            showCloseButton: true
                        }).then((result) => {

                        });
                    }else{
                        alert('test')
                    }
                }
            });
        } else {
            Swal.fire('สร้างใบวางบิลไม่สำเร็จ!', 'กรุณาเลือกสินค้า', 'error')
        }
    }
</script>

<div class="row">
    <div class="col-md-8">
        <div class="nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./?mode=offender/index">การจับกุม</a></li>
                <li class="breadcrumb-item active"><?php echo $page_title; ?></li>
            </ol>
        </div>
    </div>
    <div class="col-md-4 text-right">
        <!-- <div class="text-right">
            <a href="./?mode=offender/save" class="mb-3 btn btn-info btn-lg"><i class="fas fa-plus"></i>&nbsp; เพิ่มข้อมูล</a>
        </div> -->
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-3 widget-content">
            <div class="widget-content-outer">
                <div class="widget-content-left">
                    <h5><b>เพิ่มผู้ต้องหา</b></h5>
                    <form class="needs-validation" method="POST" action="./?mode=offender/process&id=<?php echo $id; ?>" enctype="multipart/form-data" novalidate>
                        <input type="hidden" name="page_title" id="page_title" value="<?php echo $page_title; ?>">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="titlename" class=""><b>คำนำหน้า</b></label>
                                    <select id="titlename" name="titlename" class="form-control" required>
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
                                    <div class="invalid-feedback">
                                        กรุณาระบุ คำนำหน้า!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="firstname" class=""><b>ชื่อ</b></label>
                                    <input name="firstname" id="firstname" type="text" class="form-control" value="<?php echo !empty($row['firstname']) ? $row['firstname'] : ''; ?>" required>
                                    <div class="invalid-feedback">
                                        กรุณาระบุ ชื่อ!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="lastname" class=""><b>นามสกุล</b></label>
                                    <input name="lastname" id="lastname" type="text" class="form-control" value="<?php echo !empty($row['lastname']) ? $row['lastname'] : ''; ?>" required>
                                    <div class="invalid-feedback">
                                        กรุณาระบุ นามสกุล!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="id_card" class=""><b>รหัสบัตรประชาชน</b></label>
                                    <input name="id_card" id="id_card" type="text" class="form-control" value="<?php echo !empty($row['id_card']) ? $row['id_card'] : ''; ?>" onkeyup="number_control()" required>
                                    <div class="invalid-feedback">
                                        กรุณาระบุ รหัสบัตรประชาชน!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group">
                                    <label for="age" class=""><b>อายุ</b></label>
                                    <input name="age" id="age" type="text" class="form-control" value="<?php echo !empty($row['age']) ? $row['age'] : ''; ?>" required>
                                    <div class="invalid-feedback">
                                        กรุณาระบุ อายุ!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group">
                                    <label for="sex" class=""><b>เพศ</b></label>
                                    <select id="sex" name="sex" class="form-control" required>
                                        <option value=""> กรุณาเลือก... </option>
                                        <option value="ชาย" <?php echo !empty($row['sex']) && $row['sex'] == 'ชาย' ? 'selected' : ''; ?>> ชาย </option>
                                        <option value="หญิง" <?php echo !empty($row['sex']) && $row['sex'] == 'หญิง' ? 'selected' : ''; ?>> หญิง </option>
                                    </select>
                                    <div class="invalid-feedback">
                                        กรุณาระบุ เพศ!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="phone" class=""><b>เบอร์โทร</b></label>
                                    <input name="phone" id="phone" type="text" class="form-control" value="<?php echo !empty($row['phone']) ? $row['phone'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    <label for="address" class=""><b>ที่อยู่</b></label>
                                    <textarea class="form-control" name="address" id="address" rows="6"><?php echo !empty($row['address']) ? $row['address'] : ''; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="photo1" class=""><b>รูป (หน้าผู้กระทำความผิด)</b></label>
                                    <?php $photo1 = !empty($row['photo1']) ? $row['photo1'] : ''; ?>
                                    <input type="file" name="photo1" id="photo1" class="dropify" data-default-file="assets/images/offender/<?php echo $photo1; ?>" data-max-file-size="2M" data-allowed-file-extensions="jpg jpeg png" data-show-remove="false" />
                                    <input type="hidden" name="photo_de1" id="photo_de1" value="<?php echo $photo1; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="photo2" class=""><b>รูป (เพิ่มเติม)</b></label>
                                    <?php $photo2 = !empty($row['photo2']) ? $row['photo2'] : ''; ?>
                                    <input type="file" name="photo2" id="photo2" class="dropify" data-default-file="assets/images/offender/<?php echo $photo2; ?>" data-max-file-size="2M" data-allowed-file-extensions="jpg jpeg png" data-show-remove="false" />
                                    <input type="hidden" name="photo_de2" id="photo_de2" value="<?php echo $photo2; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="photo3" class=""><b>รูป (เพิ่มเติม)</b></label>
                                    <?php $photo3 = !empty($row['photo3']) ? $row['photo3'] : ''; ?>
                                    <input type="file" name="photo3" id="photo3" class="dropify" data-default-file="assets/images/offender/<?php echo $photo3; ?>" data-max-file-size="2M" data-allowed-file-extensions="jpg jpeg png" data-show-remove="false" />
                                    <input type="hidden" name="photo_de3" id="photo_de3" value="<?php echo $photo3; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button class="mt-2 btn btn-success"><i class="fas fa-plus"></i>&nbsp; บันทึก</button>
                        </div>
                    </form>
                    <script>
                        // Example starter JavaScript for disabling form submissions if there are invalid fields
                        (function() {
                            'use strict';
                            window.addEventListener('load', function() {
                                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                var forms = document.getElementsByClassName('needs-validation');
                                // Loop over them and prevent submission
                                var validation = Array.prototype.filter.call(forms, function(form) {
                                    form.addEventListener('submit', function(event) {
                                        if (form.checkValidity() === false) {
                                            event.preventDefault();
                                            event.stopPropagation();
                                        }
                                        form.classList.add('was-validated');
                                    }, false);
                                });
                            }, false);
                        })();
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($id)) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header mt-2 mb-3">
                    <h5><b>ข้อหา</b></h5>
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <a href="./?mode=offender/save_plaint&offen=<?php echo $id; ?>" class="mb-3 btn btn-info btn-lg"><i class="fas fa-plus"></i>&nbsp; เพิ่มข้อหา</a>
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
                                <th class="text-center">รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = '1';
                            $sqlp = "SELECT * FROM plaint WHERE id > '0' AND status = '1' AND offender = '" . $id . "' ORDER BY id ASC";
                            $resulp = mysqli_query($connection, $sqlp);
                            while ($rowp = mysqli_fetch_assoc($resulp)) {
                                $plaint_type = get_value('plaint_type', 'id', 'name', $rowp['plaint_type'], $connection);
                            ?>
                                <tr>
                                    <td class="text-center text-muted"><?php echo $i; ?></td>
                                    <td><?php echo $plaint_type; ?></td>
                                    <td class="text-center"><?php echo DateThai($rowp['plaint_date']); ?></td>
                                    <td class="text-center"><?php echo date('H:i', strtotime($rowp['plaint_time'])) . " น."; ?></td>
                                    <td class="text-center"><?php echo $rowp['plaint_address']; ?></td>
                                    <td class="text-center">
                                        <a href="./?mode=offender/save_plaint&offen=<?php echo $id; ?>&id=<?php echo $rowp['id']; ?>"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                </div>
                <div class="d-block text-center card-footer">

                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php mysqli_close($connection); ?>
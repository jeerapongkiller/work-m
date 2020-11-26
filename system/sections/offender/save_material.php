<?php

$offen = !empty($_GET['offen']) ? $_GET['offen'] : '';
$plaint = !empty($_GET['plaint']) ? $_GET['plaint'] : '';
$id = !empty($_GET['id']) ? $_GET['id'] : '';

$name_offen = get_value('offender', 'id', 'firstname', $offen, $connection) . ' ' . get_value('offender', 'id', 'lastname', $offen, $connection);
$plaint_type = get_value('plaint', 'id', 'plaint_type', $plaint, $connection);
$name_plaint = get_value('plaint_type', 'id', 'name', $plaint_type, $connection);

if (!empty($id)) {
    $sql = "SELECT * FROM material WHERE id = '$id'";
    $result = mysqli_query($connection, $sql);
    $total = mysqli_num_rows($result);

    if ($total == 0) {
        echo "<meta http-equiv=\"refresh\" content=\"0; url = './?mode=offender/index'\" >";
    }

    $row = mysqli_fetch_assoc($result);

    $page_title = get_value('material_type', 'id', 'name', $row['material_type'], $connection);
} else {
    $page_title = "Create";
}
?>

<script>
    function number_control() {
        var id_card = document.getElementById('id_card');
        id_card.value = id_card.value.replace(/[^0-9]+/, '');
    }

    function add_material(page) {
        var material_type = document.getElementById('material_type').value;
        if (material_type == 'add_material_type') {
            Swal.fire({
                title: 'เพิ่มหลักฐาน',
                input: 'text',
                showCancelButton: true,
                showCloseButton: true,
                confirmButtonText: 'บันทึกข้อมูล',
                cancelButtonText: 'ปิด',
                inputValidator: (result) => {
                    if (!result) {
                        return 'กรุณากรอกข้อมูล!'
                    }
                }
            }).then((result) => {
                if (result.value) {
                    jQuery.ajax({
                        url: "sections/offender/" + page + ".php",
                        data: {
                            material_type: result.value
                        },
                        type: "POST",
                        success: function(response) {
                            Swal.fire({
                                title: "บันทึกข้อมูลสำเร็จ!",
                                type: "success"
                            }).then(function() {
                                $("#div-material-type").html(response);
                            });
                        },
                        error: function() {
                            Swal.fire('บันทึกข้อมูลไม่สำเร็จ!', 'กรุณาลองใหม่อีกครั้ง', 'error')
                        }
                    });
                } else {
                    document.getElementById("zero_material").selected = "true";
                }
            })
        }  else {
            jQuery.ajax({
                url: "sections/offender/" + page + ".php",
                data: {
                    material_type: material_type
                },
                type: "POST",
                success: function(response) {
                    $("#div-unit").html(response);
                },
                error: function() {
                    Swal.fire('บันทึกข้อมูลไม่สำเร็จ!', 'กรุณาลองใหม่อีกครั้ง', 'error')
                }
            });
        }
    }
</script>

<div class="row">
    <div class="col-md-8">
        <div class="nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./?mode=offender/index">การจับกุม</a></li>
                <li class="breadcrumb-item"><a href="./?mode=offender/save&id=<?php echo $offen; ?>"><?php echo $name_offen; ?></a></li>
                <li class="breadcrumb-item"><a href="./?mode=offender/save_plaint&id=<?php echo $plaint; ?>&offen=<?php echo $offen; ?>"><?php echo $name_plaint; ?></a></li>
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
                    <h5><b>เพิ่มหลักฐาน</b></h5>
                    <form class="needs-validation" method="POST" action="./?mode=offender/process_material&id=<?php echo $id; ?>" enctype="multipart/form-data" novalidate>
                        <input type="hidden" name="page_title" id="page_title" value="<?php echo $page_title; ?>">
                        <input type="hidden" name="offen" id="offen" value="<?php echo $offen; ?>">
                        <input type="hidden" name="plaint" id="plaint" value="<?php echo $plaint; ?>">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="position-relative form-group" id="div-material-type">
                                    <label for="material_type" class=""><b> หลักฐาน </b></label>
                                    <select id="material_type" name="material_type" class="form-control" onchange="add_material('ajax_add_material')" required>
                                        <option value="" id="zero_material"> กรุณาเลือก... </option>
                                        <?php
                                        $sqlmt = "SELECT * FROM material_type WHERE id > '0' AND status = '1' ORDER BY id ASC";
                                        $resulmt = mysqli_query($connection, $sqlmt);
                                        while ($rowmt = mysqli_fetch_assoc($resulmt)) {
                                            $material_type = !empty($row['material_type']) ? $row['material_type'] : '0';
                                        ?>
                                            <option value="<?php echo $rowmt['id']; ?>" <?php if ($rowmt['id'] == $material_type) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $rowmt['name']; ?></option>
                                        <?php } /* while ($rowpt = mysqli_fetch_assoc($resulpt)) { */ ?>
                                        <option value="add_material_type"> เพิ่มหลักฐาน </option>
                                    </select>
                                    <div class="invalid-feedback">
                                        กรุณาระบุ หลักฐาน!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="material_num" class=""><b> จำนวน </b></label>
                                    <input name="material_num" id="material_num" type="number" class="form-control" value="<?php echo !empty($row['material_num']) ? $row['material_num'] : ''; ?>" onkeyup="number_control()" required>
                                    <div class="invalid-feedback">
                                        กรุณาระบุ จำนวน!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group" id="div-unit">
                                    <label for="unit" class=""><b> หน่วย </b></label>
                                    <input name="unit" id="unit" type="text" class="form-control" value="<?php echo !empty($row['unit']) ? $row['unit'] : ''; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    <label for="material_detail" class=""><b>รายละเอียด</b></label>
                                    <textarea class="form-control" name="material_detail" id="material_detail" rows="6"><?php echo !empty($row['material_detail']) ? $row['material_detail'] : ''; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="photo1" class=""><b>รูป (หน้าผู้กระทำความผิด)</b></label>
                                    <?php $photo1 = !empty($row['photo1']) ? $row['photo1'] : ''; ?>
                                    <input type="file" name="photo1" id="photo1" class="dropify" data-default-file="assets/images/material/<?php echo $photo1; ?>" data-max-file-size="2M" data-allowed-file-extensions="jpg jpeg png" data-show-remove="false" />
                                    <input type="hidden" name="photo_de1" id="photo_de1" value="<?php echo $photo1; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="photo2" class=""><b>รูป (เพิ่มเติม)</b></label>
                                    <?php $photo2 = !empty($row['photo2']) ? $row['photo2'] : ''; ?>
                                    <input type="file" name="photo2" id="photo2" class="dropify" data-default-file="assets/images/material/<?php echo $photo2; ?>" data-max-file-size="2M" data-allowed-file-extensions="jpg jpeg png" data-show-remove="false" />
                                    <input type="hidden" name="photo_de2" id="photo_de2" value="<?php echo $photo2; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="photo3" class=""><b>รูป (เพิ่มเติม)</b></label>
                                    <?php $photo3 = !empty($row['photo3']) ? $row['photo3'] : ''; ?>
                                    <input type="file" name="photo3" id="photo3" class="dropify" data-default-file="assets/images/material/<?php echo $photo3; ?>" data-max-file-size="2M" data-allowed-file-extensions="jpg jpeg png" data-show-remove="false" />
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

<?php mysqli_close($connection); ?>
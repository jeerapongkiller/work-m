<?php

$offen = !empty($_GET['offen']) ? $_GET['offen'] : '';
$plaint = !empty($_GET['plaint']) ? $_GET['plaint'] : '';
$id = !empty($_GET['id']) ? $_GET['id'] : '';

$name_offen = get_value('offender', 'id', 'firstname', $offen, $connection) . ' ' . get_value('offender', 'id', 'lastname', $offen, $connection);
$plaint_type = get_value('plaint', 'id', 'plaint_type', $plaint, $connection);
$name_plaint = get_value('plaint_type', 'id', 'name', $plaint_type, $connection);

if (!empty($id)) {
    $sql = "SELECT * FROM plaint WHERE id = '$id'";
    $result = mysqli_query($connection, $sql);
    $total = mysqli_num_rows($result);

    if ($total == 0) {
        echo "<meta http-equiv=\"refresh\" content=\"0; url = './?mode=offender/index'\" >";
    }

    $row = mysqli_fetch_assoc($result);

    $page_title = get_value('plaint_type', 'id', 'name', $row['plaint_type'], $connection);
} else {
    $page_title = "Create";
}
?>

<script>
    function add_material(page) {
        var material = document.getElementById('material').value;
        if (material == 'add_material_type') {
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
                            material: result.value
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
        } 
        else {
            jQuery.ajax({
                url: "sections/offender/" + page + ".php",
                data: {
                    material: result.value
                },
                type: "POST",
                success: function(response) {
                    Swal.fire({
                        title: "บันทึกข้อมูลสำเร็จ!",
                        type: "success"
                    }).then(function() {
                        $("#plaint_date").html(response);
                    });
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
                    <form method="POST" action="./?mode=offender/process_plaint&id=<?php echo $id; ?>" enctype="multipart/form-data">
                        <input type="hidden" name="page_title" id="page_title" value="<?php echo $page_title; ?>">
                        <input type="hidden" name="offen" id="offen" value="<?php echo $offen; ?>">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="position-relative form-group" id="div-material-type">
                                    <label for="material" class=""><b> หลักฐาน </b></label>
                                    <select id="material" name="material" class="form-control" onchange="add_material('ajax_add_material')">
                                        <option value="" id="zero_material"> กรุณาเลือก... </option>
                                        <?php
                                        $sqlm = "SELECT * FROM material WHERE id > '0' AND status = '1' ORDER BY id ASC";
                                        $resulm = mysqli_query($connection, $sqlm);
                                        while ($rowm = mysqli_fetch_assoc($resulm)) {
                                            $material = !empty($rowm['plaint_type']) ? $rowm['plaint_type'] : '0';
                                        ?>
                                            <option value="<?php echo $rowm['id']; ?>" <?php if ($rowm['id'] == $material) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $rowm['name']; ?></option>
                                        <?php } /* while ($rowpt = mysqli_fetch_assoc($resulpt)) { */ ?>
                                        <option value="add_material_type"> เพิ่มหลักฐาน </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="plaint_date" class=""><b> จำนวน </b></label>
                                    <input name="plaint_date" id="plaint_date" type="text" class="form-control" value="<?php echo !empty($row['plaint_date']) ? $row['plaint_date'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="plaint_time" class=""><b> หน่วย </b></label>
                                    <input name="plaint_time" id="plaint_time" type="text" class="form-control" value="<?php echo !empty($row['plaint_time']) ? $row['plaint_time'] : ''; ?>" readonly>
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
                </div>
            </div>
        </div>
    </div>
</div>

<?php mysqli_close($connection); ?>
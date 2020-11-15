<?php
$offen = !empty($_GET['offen']) ? $_GET['offen'] : '';
$id = !empty($_GET['id']) ? $_GET['id'] : '';
$name_offen = get_value('offender', 'id', 'firstname', $offen, $connection) . ' ' . get_value('offender', 'id', 'lastname', $offen, $connection);
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
    function add_plaintt(page) {
        var plaint_type = document.getElementById('plaint_type').value;
        if (plaint_type == 'add_plaint_type') {
            Swal.fire({
                title: 'เพิ่มข้อหา',
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
                            plaint_type: result.value
                        },
                        type: "POST",
                        success: function(response) {
                            Swal.fire({
                                title: "บันทึกข้อมูลสำเร็จ!",
                                type: "success"
                            }).then(function() {
                                $("#div-plaint-type").html(response);
                            });
                        },
                        error: function() {
                            Swal.fire('บันทึกข้อมูลไม่สำเร็จ!', 'กรุณาลองใหม่อีกครั้ง', 'error')
                        }
                    });
                } else {
                    document.getElementById("zero_plaint_type").selected = "true";
                }
            })
        }
    }
</script>

<div class="row">
    <div class="col-md-8">
        <div class="nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./?mode=offender/index">การจับกุม</a></li>
                <li class="breadcrumb-item"><a href="./?mode=offender/save&id=<?php echo $offen; ?>"><?php echo $name_offen; ?></a></li>
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
                    <h5><b>เพิ่มข้อหา</b></h5>
                    <form method="POST" action="./?mode=offender/process_plaint&id=<?php echo $id; ?>" enctype="multipart/form-data">
                        <input type="hidden" name="page_title" id="page_title" value="<?php echo $page_title; ?>">
                        <input type="hidden" name="offen" id="offen" value="<?php echo $offen; ?>">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="position-relative form-group" id="div-plaint-type">
                                    <label for="plaint_type" class=""><b>ข้อหา</b></label>
                                    <select id="plaint_type" name="plaint_type" class="form-control" onchange="add_plaintt('ajax_add_plaint')">
                                        <option value="" id="zero_plaint_type"> กรุณาเลือก... </option>
                                        <?php
                                        $sqlpt = "SELECT * FROM plaint_type WHERE id > '0' AND status = '1' ORDER BY id ASC";
                                        $resulpt = mysqli_query($connection, $sqlpt);
                                        while ($rowpt = mysqli_fetch_assoc($resulpt)) {
                                            $plaint_type = !empty($row['plaint_type']) ? $row['plaint_type'] : '0';
                                        ?>
                                            <option value="<?php echo $rowpt['id']; ?>" <?php if ($rowpt['id'] == $plaint_type) {
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
                                    <input name="plaint_date" id="plaint_date" type="date" class="form-control" value="<?php echo !empty($row['plaint_date']) ? $row['plaint_date'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="plaint_time" class=""><b>เวลา</b></label>
                                    <input name="plaint_time" id="plaint_time" type="time" class="form-control" value="<?php echo !empty($row['plaint_time']) ? $row['plaint_time'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    <label for="plaint_address" class=""><b>สถานที่</b></label>
                                    <textarea class="form-control" name="plaint_address" id="plaint_address" rows="6"><?php echo !empty($row['plaint_address']) ? $row['plaint_address'] : ''; ?></textarea>
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

<?php if(!empty($id)){ ?>
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-header mt-2 mb-3">
                <h5><b>หลักฐาน</b></h5>
                <div class="btn-actions-pane-right">
                    <div role="group" class="btn-group-sm btn-group">
                        <a href="./?mode=offender/save_material&offen=<?php echo $offen; ?>&plaint=<?php echo $id; ?>" class="mb-3 btn btn-info btn-lg"><i class="fas fa-plus"></i>&nbsp; เพิ่มหลักฐาน</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover table-login">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>หลักฐาน</th>
                            <th class="text-center">จำนวน</th>
                            <th class="text-center">หน่วย</th>
                            <th class="text-center">แก้ใข</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = '1';
                            $sqlm = "SELECT * FROM material WHERE id > '0' AND status = '1' AND plaint = '" . $id . "' ORDER BY id ASC";
                            $resulm = mysqli_query($connection, $sqlm);
                            while ($rowm = mysqli_fetch_assoc($resulm)) {
                                $material_type = get_value('material_type', 'id', 'name', $rowm['material_type'], $connection);
                                $material_unit = get_value('material_type', 'id', 'unit', $rowm['material_type'], $connection);
                        ?>
                        <tr>
                            <td class="text-center text-muted"> <?php echo $i; ?> </td>
                            <td> <?php echo $material_type; ?> </td>
                            <td class="text-center"> <?php echo $rowm['material_num']; ?> </td>
                            <td class="text-center"> <?php echo $material_unit; ?> </td>
                            <td class="text-center">
                                <a href="./?mode=offender/save_material&id=<?php echo $rowm['id']; ?>&offen=<?php echo $offen; ?>&plaint=<?php echo $id; ?>"><i class="fas fa-edit"></i></a>
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
<?php }
mysqli_close($connection);
 ?>
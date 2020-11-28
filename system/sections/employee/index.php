<div class="row">
    <div class="col-md-8">
        <div class="nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">พนักงาน</li>
            </ol>
        </div>
    </div>
    <div class="col-md-4 text-right">
        <div class="text-right">
            <a href="./?mode=employee/save" class="mb-3 btn btn-info btn-lg"><i class="fas fa-plus"></i>&nbsp; เพิ่มข้อมูล</a>
        </div>
    </div>
</div>

<script>
    function delete_employee(id, name) {
        Swal.fire({
            type: 'warning',
            title: 'คุณแน่ใจไหม?',
            text: "คุณต้องการลบข้อมูลนี้ใช่หรือไม่?",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่ ลบข้อมูล!',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.value) {
                jQuery.ajax({
                    url: "sections/employee/delete.php",
                    data: {
                        id: id
                    },
                    type: "POST",
                    success: function(response) {
                        Swal.fire({
                            title: "ลบข้อมูลเสร็จสิ้น!",
                            text: "ข้อมูลที่คุณเลือกถูกลบออกจากระบบแล้ว",
                            type: "success"
                        }).then(function() {
                            location.href = "<?php echo $_SERVER['REQUEST_URI']; ?>";
                        });
                    },
                    error: function() {
                        Swal.fire('ลบข้อมูลไม่สำเร็จ!', 'กรุณาลองใหม่อีกครั้ง', 'error')
                    }
                });
            }
        })
        return true;
    }

    function restore_employee(id, name) {
        Swal.fire({
            type: 'warning',
            title: 'คุณแน่ใจไหม?',
            text: "คุณต้องการคืนข้อมูลนี้ใช่หรือไม่?",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่ คืนข้อมูล!',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.value) {
                jQuery.ajax({
                    url: "sections/employee/restore.php",
                    data: {
                        id: id
                    },
                    type: "POST",
                    success: function(response) {
                        Swal.fire({
                            title: "คืนข้อมูลเสร็จสิ้น!",
                            text: "ข้อมูลที่คุณเลือกกลับเข้าสู่ระบบแล้ว",
                            type: "success"
                        }).then(function() {
                            location.href = "<?php echo $_SERVER['REQUEST_URI']; ?>";
                        });
                    },
                    error: function() {
                        Swal.fire('คืนข้อมูลไม่สำเร็จ!', 'กรุณาลองใหม่อีกครั้ง', 'error')
                    }
                });
            }
        })
        return true;
    }
</script>

<?php
#------ Search Employee -------#
$search_position = !empty($_POST['search_position']) ? $_POST['search_position'] : '';
$search_fname = !empty($_POST['search_fname']) ? $_POST['search_fname'] : '';
$search_lname = !empty($_POST['search_lname']) ? $_POST['search_lname'] : '';
?>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-3 widget-content">
            <div class="widget-content-outer">
                <div class="widget-content-left">
                    <h5><b>ค้นหาพนักงาน</b></h5>
                    <form method="post" id="frmsearch" name="frmsearch" action="./?mode=<?php echo $_GET["mode"]; ?>">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="search_position" class="">ตำแหน่ง</label>
                                    <select id="search_position" name="search_position" class="form-control">
                                        <option value=""> กรุณาเลือก... </option>
                                        <?php
                                        $sqlps = "SELECT * FROM position WHERE id > '0' ORDER BY id ASC";
                                        $resulps = mysqli_query($connection, $sqlps);
                                        while ($rowps = mysqli_fetch_assoc($resulps)) {
                                        ?>
                                            <option value="<?php echo $rowps['id']; ?>" <?php if ($rowps['id'] == $search_position) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $rowps['name'] . " / " . $rowps['acronym']; ?></option>
                                        <?php } /* while($rowps = mysqli_fetch_assoc($resulps)){ */ ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="search_fname" class="">ชื่อ</label>
                                    <input name="search_fname" id="search_fname" type="text" value="<?php echo $search_fname; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="search_lname" class="">สกุล</label>
                                    <input name="search_lname" id="search_lname" type="text" value="<?php echo $search_lname; ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button class="mt-2 btn btn-success" type="submit"><i class="fas fa-search"></i>&nbsp; ค้นหา</button>
                            <button class="mt-2 btn btn-focus" type="button" onclick="window.location.href='./?mode=employee/index'"><i class="fas fa-redo"></i>&nbsp; ล้างค่าใหม่</button>
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
            <div class="card-header mt-3 mb-3">
                <h5><b>รายงานการจับกุม</b></h5>
            </div>
            <div class="table-responsive">
                <table id="datatable" class="align-middle mb-0 table table-borderless table-striped table-hover table-login">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>ชื่อ-สกุล</th>
                            <th class="text-center">เบอร์โทร</th>
                            <th class="text-center">แก้ใข</th>
                            <th class="text-center">ลบ</th>
                            <?php if ($_SESSION["admin"]["permission"] == 'Administrator') { ?>
                                <th class="text-center">คืน</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = '1';
                        $sqlem = "SELECT * FROM employee WHERE id > '0' AND permission = 'Member' ";
                        if (!empty($search_position)) {
                            $sqlem .= "AND position = '" . $search_position . "' ";
                        }
                        if (!empty($search_fname)) {
                            $sqlem .= "AND firstname LIKE '" . $search_fname . "%' ";
                        }
                        if (!empty($search_lname)) {
                            $sqlem .= "AND lastname LIKE '" . $search_lname . "%' ";
                        }
                        if ($_SESSION["admin"]["permission"] != 'Administrator') {
                            $sqlem .= "AND status = '1' ";
                        }
                        $sqlem .= "ORDER BY id ASC";
                        $resulem = mysqli_query($connection, $sqlem);
                        while ($rowem = mysqli_fetch_assoc($resulem)) {
                            $titlename = get_value("titlename", "id", "name", $rowem['titlename'], $connection);
                            $position = get_value("position", "id", "acronym", $rowem['position'], $connection);
                            $full_name = $position . ' ' . $rowem['firstname'] . ' ' . $rowem['lastname'];
                        ?>
                            <tr>
                                <td class="text-center text-muted"><?php echo $i; ?></td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="widget-content-left">
                                                    <img width="40" height="40" class="rounded-circle" src="assets/images/employee/<?php echo $rowem['photo']; ?>" alt="">
                                                </div>
                                            </div>
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading"><?php echo $full_name; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center"><?php echo $rowem['phone']; ?></td>
                                <td class="text-center">
                                    <a href="./?mode=employee/save&id=<?php echo $rowem['id']; ?>"><i class="fas fa-edit"></i></a>
                                </td>
                                <td class="text-center">
                                    <a href="#" onclick="delete_employee('<?php echo $rowem['id']; ?>', '<?php echo $full_name; ?>')"><i class="fas fa-trash-alt" style="color: #FF0000;"></i></a>
                                </td>
                                <?php if ($_SESSION["admin"]["permission"] == 'Administrator') { ?>
                                    <td class="text-center">
                                        <?php if ($rowem['status'] == '2') { ?> <a href="#" onclick="restore_employee('<?php echo $rowem['id']; ?>', '<?php echo $full_name; ?>')"><i class="fas fa-undo-alt" style="color: #00FF00;"></i></a> <?php } ?>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php $i++;
                        }
                        mysqli_close($connection);
                        ?>
                    </tbody>
                </table>
            </div>
            <hr>
        </div>
    </div>
</div>
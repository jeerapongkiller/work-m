<div class="text-right">
    <a href="./?mode=material/save" class="mb-3 btn btn-info btn-lg"><i class="fas fa-plus"></i>&nbsp; เพิ่มข้อมูล</a>
</div>

<script>
    function delete_material(id, name) {
        bootbox.confirm({
            backdrop: true,
            closeButton: false,
            message: "<h5 class=\"text-center mt-3 mb-3\"> คุณต้องการลบ <b>'"+name+"'</b> ใช้หรือไม่? </h5>",
            buttons: {
                cancel: {
                    label: '<i class="fa fa-times"></i>&nbsp;&nbsp; ยกเลิก',
                    className: 'btn-danger'
                },
                confirm: {
                    label: '<i class="fa fa-check"></i>&nbsp;&nbsp; ยืนยัน',
                    className: 'btn-success'
                }
            },
            callback: function(result) {
                if(result){
                    jQuery.ajax({
                        url: "sections/material/delete.php",
                        data: {
                            id: id,
                            name: name
                        },
                        type: "POST",
                        success: function(response) {
                            bootbox.alert({
                                message: "<h5 class=\"text-center mt-3 mb-3\"> ทำการลบ <b>'"+response+"'</b> สำเร็จแล้ว! </h5>",
                                backdrop: true,
                                closeButton: false,
                                buttons: {
                                    ok: { label: 'ตกลง' }
                                },
                                callback: function(result) {
                                    location.href = "<?php echo $_SERVER['REQUEST_URI']; ?>";
                                }
                            });
                        },
                        error: function() {}
                    });
                }
            }
        });
    }
</script>

<?php
#------ Search Employee -------#
$search_name = !empty($_POST['search_name']) ? $_POST['search_name'] : '';
?>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-3 widget-content">
            <div class="widget-content-outer">
                <div class="widget-content-left">
                    <h5><b>ค้นหาของกลาง</b></h5>
                    <form method="post" id="frmsearch" name="frmsearch" action="./?mode=<?php echo $_GET["mode"]; ?>">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="search_name" class="">ชื่อของกลาง</label>
                                    <input name="search_name" id="search_name" type="text" value="<?php echo $search_name; ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button class="mt-2 btn btn-success" type="submit"><i class="fas fa-search"></i>&nbsp; ค้นหา</button>
                            <button class="mt-2 btn btn-focus" type="button" onclick="window.location.href='./?mode=material/index'"><i class="fas fa-redo"></i>&nbsp; ล้างค่าใหม่</button>
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
                <h5><b>รายการของกลาง</b></h5>
            </div>
            <div class="table-responsive">
                <table id="datatable" class="align-middle mb-0 table table-borderless table-striped table-hover table-login">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>ชื่อของกลาง</th>
                            <th class="text-center">หน่วย</th>
                            <th class="text-center">แก้ใข</th>
                            <th class="text-center">ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = '1';
                        $sqlmt = "SELECT * FROM material_type WHERE id > '0'";
                        if (!empty($search_name)) {
                            $sqlmt .= "AND name LIKE '" . $search_name . "%' ";
                        }
                        $sqlmt .= "ORDER BY id ASC";
                        $resulmt = mysqli_query($connection, $sqlmt);
                        while ($rowmt = mysqli_fetch_assoc($resulmt)) {
                            $photo = !empty($rowmt['photo']) ? "assets/images/material_type/".$rowmt['photo'] : "assets/images/no-image.jpg" ;
                        ?>
                            <tr>
                                <td class="text-center text-muted"><?php echo $i; ?></td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="widget-content-left">
                                                    <img width="40" height="40" class="rounded-circle" src="<?php echo $photo; ?>" alt="">
                                                </div>
                                            </div>
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading"><?php echo $rowmt['name']; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center"><?php echo $rowmt['unit']; ?></td>
                                <td class="text-center">
                                    <a href="./?mode=material/save&id=<?php echo $rowmt['id']; ?>"><i class="fas fa-edit"></i></a>
                                </td>
                                <td class="text-center">
                                    <a href="#" onclick="delete_material('<?php echo $rowmt['id']; ?>', '<?php echo $rowmt['name']; ?>')"><i class="fas fa-trash-alt" style="color: #FF0000;"></i></a>
                                </td>
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
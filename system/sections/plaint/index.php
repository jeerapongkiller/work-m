<div class="row">
    <div class="col-md-8">
        <div class="nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">ข้อหา</li>
            </ol>
        </div>
    </div>
    <div class="col-md-4 text-right">
        <div class="text-right">
            <a href="./?mode=plaint/save" class="mb-3 btn btn-info btn-lg"><i class="fas fa-plus"></i>&nbsp; เพิ่มข้อมูล</a>
        </div>
    </div>
</div>

<script>
    function delete_plaint(id, name) {
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
                        url: "sections/plaint/delete.php",
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
                    <h5><b>ค้นหารายการข้อหา</b></h5>
                    <form method="post" id="frmsearch" name="frmsearch" action="./?mode=<?php echo $_GET["mode"]; ?>">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="search_name" class="">ข้อหา</label>
                                    <input name="search_name" id="search_name" type="text" value="<?php echo $search_name; ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button class="mt-2 btn btn-success" type="submit"><i class="fas fa-search"></i>&nbsp; ค้นหา</button>
                            <button class="mt-2 btn btn-focus" type="button" onclick="window.location.href='./?mode=plaint/index'"><i class="fas fa-redo"></i>&nbsp; ล้างค่าใหม่</button>
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
                <h5><b>รายการข้อหา</b></h5>
            </div>
            <div class="table-responsive">
                <table id="datatable" class="align-middle mb-0 table table-borderless table-striped table-hover table-login">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>ข้อหา</th>
                            <th class="text-center">แก้ใข</th>
                            <th class="text-center">ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = '1';
                        $sqlpt = "SELECT * FROM plaint_type WHERE id > '0'";
                        if (!empty($search_name)) {
                            $sqlpt .= "AND name LIKE '" . $search_name . "%' ";
                        }
                        $sqlpt .= "ORDER BY id ASC";
                        $resulpt = mysqli_query($connection, $sqlpt);
                        while ($rowpt = mysqli_fetch_assoc($resulpt)) {
                        ?>
                            <tr>
                                <td class="text-center text-muted"><?php echo $i; ?></td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading"><?php echo $rowpt['name']; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="./?mode=plaint/save&id=<?php echo $rowpt['id']; ?>"><i class="fas fa-edit"></i></a>
                                </td>
                                <td class="text-center">
                                    <a href="#" onclick="delete_plaint('<?php echo $rowpt['id']; ?>', '<?php echo $rowpt['name']; ?>')"><i class="fas fa-trash-alt" style="color: #FF0000;"></i></a>
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
<?php
#------ Search Employee -------#
// $search_position = !empty($_POST['search_position']) ? $_POST['search_position'] : '';
// $search_fname = !empty($_POST['search_fname']) ? $_POST['search_fname'] : '';
// $search_lname = !empty($_POST['search_lname']) ? $_POST['search_lname'] : '';
?>

<div class="row">
    <div class="col-md-8">
        <div class="nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">การจับกุม</li>
            </ol>
        </div>
    </div>
    <div class="col-md-4 text-right">
        <div class="text-right">
            <a href="./?mode=offender/save" class="mb-3 btn btn-info btn-lg"><i class="fas fa-plus"></i>&nbsp; เพิ่มข้อมูล</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-3 widget-content">
            <div class="widget-content-outer">
                <div class="widget-content-left">
                    <h5><b>ค้นหารายงานการจับกุม</b></h5>
                    <form method="post" id="frmsearch" name="frmsearch" action="./?mode=<?php echo $_GET["mode"]; ?>">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="firstname" class="">ชื่อ</label>
                                    <input name="firstname" id="firstname" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="lastname" class="">นามสกุล</label>
                                    <input name="lastname" id="lastname" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group">
                                    <label for="sex" class="">เพศ</label>
                                    <input name="sex" id="sex" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group">
                                    <label for="age" class="">อายุ</label>
                                    <input name="age" id="age" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="plaint" class="">ข้อหา</label>
                                    <input name="plaint" id="plaint" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="address_off" class="">สถานที่จับ</label>
                                    <input name="address_off" id="address_off" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="date_from" class="">วันที่จับ (จาก)</label>
                                    <input name="date_from" id="date_from" class="form-control" type="text" data-provide="datepicker" data-date-language="th-th" data-date-format="dd/mm/yyyy" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="date_to" class="">วันที่จับ (ถึง)</label>
                                    <input name="date_to" id="date_to" class="form-control" type="text" data-provide="datepicker" data-date-language="th-th" data-date-format="dd/mm/yyyy">
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button class="mt-2 btn btn-success" type="submit"><i class="fas fa-search"></i>&nbsp; ค้นหา</button>
                            <button class="mt-2 btn btn-focus" type="button" onclick="window.location.href='./?mode=offender/index'"><i class="fas fa-redo"></i>&nbsp; ล้างค่าใหม่</button>
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
                            <th class="text-center">รายละเอียด</th>
                            <th class="text-center">ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = '1';
                            $sqlof = "SELECT * FROM offender WHERE id > '0'";
                            $sqlof .= "ORDER BY id ASC";
                            $resulof = mysqli_query($connection, $sqlof);
                            while ($rowof = mysqli_fetch_assoc($resulof)) {
                                $titlename = get_value("titlename", "id", "name", $rowof['titlename'], $connection);
                                $full_name = $titlename . ' ' . $rowof['firstname'] . ' ' . $rowof['lastname'];
                        ?>
                        <tr>
                            <td class="text-center text-muted"><?php echo $i; ?></td>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="widget-content-left">
                                                <img width="40" class="rounded-circle" src="assets/images/offender/<?php echo $rowof['photo1']; ?>" alt="">
                                            </div>
                                        </div>
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading"><?php echo $full_name; ?></div>
                                            <div class="widget-subheading opacity-7">
                                                <b>เพศ :</b> <?php echo $rowof['sex']; ?>
                                                <b>อายุ :</b> <?php echo $rowof['age']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="./?mode=offender/save&id=<?php echo $rowof['id']; ?>"><i class="fas fa-edit"></i></a>
                            </td>
                            <td class="text-center">
                                <a href="#" onclick="delete_offender('<?php echo $rowof['id']; ?>', '<?php echo $full_name; ?>')"><i class="fas fa-trash-alt" style="color: #FF0000;"></i></a>
                            </td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
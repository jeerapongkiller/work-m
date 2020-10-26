<?php
    $id = $_GET['id'];
    if(!empty($id)){
		$sql = "SELECT * FROM employee WHERE id = '$id'";
		$result = mysqli_query($connection, $sql);
		$total = mysqli_num_rows($result);
		
		if($total == 0){ echo "<meta http-equiv=\"refresh\" content=\"0; url = './?mode=employee/index'\" >"; }
		
		$row = mysqli_fetch_assoc($result);
		
		$page_title = $row['username'];
	}else{
		$page_title = "Create";
	}
?>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-3 widget-content">
            <div class="widget-content-outer">
                <div class="widget-content-left">
                    <h5><b>เพิ่มพนักงาน</b></h5>
                    <form method="POST" action="./?mode=employee/process&id=<?php echo $id; ?>" enctype="multipart/form-data">
                        <input type="hidden" name="page_title" id="page_title" value="<?php echo $page_title; ?>">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="username" class="">ชื่อผู้ใช้</label>
                                    <input name="username" id="username" type="text" class="form-control" value="<?php echo $row['username']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="password" class="">รหัสผ่าน</label>
                                    <input name="password" id="password" type="text" class="form-control" value="<?php echo $row['password']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="titlename" class="">คำนำหน้า</label>
                                    <select id="titlename" name="titlename" class="form-control">
									    <option value=""> กรุณาเลือก... </option>
                                        <?php
                                            $sqltt = "SELECT * FROM titlename WHERE id > '0' ORDER BY id ASC";
                                            $resultt = mysqli_query($connection, $sqltt);
                                            while($rowtt = mysqli_fetch_assoc($resultt)){
                                        ?>
                                            <option value="<?php echo $rowtt['id']; ?>" <?php if($rowtt['id'] == $row['titlename']){ echo "selected"; } ?>><?php echo $rowtt['name']; ?></option>
                                        <?php } /* while($rowtt = mysqli_fetch_assoc($resultt)){ */ ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="firstname" class="">ชื่อ</label>
                                    <input name="firstname" id="firstname" type="text" class="form-control" value="<?php echo $row['firstname']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="lastname" class="">นามสกุล</label>
                                    <input name="lastname" id="lastname" type="text" class="form-control" value="<?php echo $row['lastname']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="position" class="">ตำแหน่ง</label>
                                    <select id="position" name="position" class="form-control">
									    <option value=""> กรุณาเลือก... </option>
                                        <?php
                                            $sqlps = "SELECT * FROM position WHERE id > '0' ORDER BY id ASC";
                                            $resulps = mysqli_query($connection, $sqlps);
                                            while($rowps = mysqli_fetch_assoc($resulps)){
                                        ?>
                                            <option value="<?php echo $rowps['id']; ?>" <?php if($rowps['id'] == $row['position']){ echo "selected"; } ?>><?php echo $rowps['name']." / ".$rowps['acronym']; ?></option>
                                        <?php } /* while($rowps = mysqli_fetch_assoc($resulps)){ */ ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="phone" class="">เบอร์โทร</label>
                                    <input name="phone" id="phone" type="text" class="form-control" value="<?php echo $row['phone']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="address" class="">ที่อยู่</label>
                                    <textarea class="form-control" name="address" id="address" rows="8"><?php echo $row['address']; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="photo" class="">รูป</label>
                                    <input type="file" name="photo" id="photo" class="dropify" data-default-file="assets/images/employee/<?php echo $row['photo']; ?>" data-max-file-size="2M" data-allowed-file-extensions="jpg jpeg png" data-show-remove="false" />
                                    <input type="hidden" name="photo_de" id="photo_de" value="<?php echo $row['photo']; ?>">
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
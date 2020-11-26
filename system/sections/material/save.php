<?php
    $id = $_GET['id'];
    if(!empty($id)){
		$sql = "SELECT * FROM material_type WHERE id = '$id'";
		$result = mysqli_query($connection, $sql);
		$total = mysqli_num_rows($result);
		
		if($total == 0){ echo "<meta http-equiv=\"refresh\" content=\"0; url = './?mode=material/index'\" >"; }
		
		$row = mysqli_fetch_assoc($result);
		
		$page_title = $row['name'];
	}else{
		$page_title = "Create";
	}
?>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-3 widget-content">
            <div class="widget-content-outer">
                <div class="widget-content-left">
                    <h5><b>เพิ่มของกลาง</b></h5>
                    <form class="needs-validation" method="POST" action="./?mode=material/process&id=<?php echo $id; ?>" enctype="multipart/form-data" novalidate>
                        <input type="hidden" name="page_title" id="page_title" value="<?php echo $page_title; ?>">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="name" class="">ชื่อของกลาง</label>
                                    <input name="name" id="name" type="text" class="form-control" value="<?php echo $row['name']; ?>" required>
                                    <div class="invalid-feedback">
                                        กรุณาระบุ ชื่อของกลาง!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="unit" class="">หน่วย</label>
                                    <input name="unit" id="unit" type="text" class="form-control" value="<?php echo $row['unit']; ?>" required>
                                    <div class="invalid-feedback">
                                        กรุณาระบุ หน่วย!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="detail" class="">รายละเอียดเพิ่มเติม</label>
                                    <textarea class="form-control" name="detail" id="detail" rows="8"><?php echo $row['detail']; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="photo" class="">รูป</label>
                                    <input type="file" name="photo" id="photo" class="dropify" data-default-file="assets/images/material/<?php echo $row['photo']; ?>" data-max-file-size="2M" data-allowed-file-extensions="jpg jpeg png" data-show-remove="false" />
                                    <input type="hidden" name="photo_de" id="photo_de" value="<?php echo $row['photo']; ?>">
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
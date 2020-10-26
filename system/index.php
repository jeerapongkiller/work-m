<?php
#----- Require -----#
require("../connection/connection.php");

if (!empty($_GET["mode"]) && !empty($_SESSION["admin"]["id"])) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Police System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="assets/css/main.css" rel="stylesheet">
    <link href="assets/fontawesome/css/all.css" rel="stylesheet">
    <link href="assets/dropify/dist/css/dropify.min.css" rel="stylesheet">
    <link href="assets/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/bootstrap/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />
    <link href="assets/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <!-- ============================================================== -->
        <!-- Header Page -->
        <!-- ============================================================== -->
        <?php include "header.php"; ?>

        <!-- ============================================================== -->
        <!-- Option Page -->
        <!-- ============================================================== -->
        <?php // include "option.php"; 
        ?>

        <div class="app-main">

            <!-- ============================================================== -->
            <!-- Menu Page -->
            <!-- ============================================================== -->
            <?php include "menu.php"; ?>

            <div class="app-main__outer">
                <div class="app-main__inner">
                    <!-- ============================================================== -->
                    <!-- Footer Page -->
                    <!-- ============================================================== -->
                    <?php include "sections/" . $_GET["mode"] . ".php"; ?>
                    <?php // include "sections/employee/save.php"; 
                    ?>

                </div>

                <!-- ============================================================== -->
                <!-- Footer Page -->
                <!-- ============================================================== -->
                <?php include "footer.php"; ?>

            </div>
        </div>
    </div>
    <script type="text/javascript" src="assets/scripts/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!---- Sweetalert 2 popup js ---->
    <script src="assets/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <?php if (!empty($_GET["message"])) {
        switch ($_GET["message"]) {
            case "error":
                $message_type = "error";
                $message_title = "ทำใหม่อีกครั้ง!";
                break;
            case "success":
                $message_type = "success";
                $message_title = "ทำรายการสำเร็จแล้ว";
                break;
        } ?>
        <script>
            Swal.fire({
                type: '<?php echo $message_type; ?>',
                title: '<?php echo $message_title; ?>'
            })
        </script>
    <?php } ?>
    <!-- images js -->
    <script src="assets/dropify/dist/js/dropify.min.js"></script>
    <script>
        $(document).ready(function() {
            // Basic
            $('.dropify').dropify();

            // Used events
            var drEvent = $('#input-file-events').dropify();

            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });

            drEvent.on('dropify.errors', function(event, element) {
                console.log('Has Errors');
            });

            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function(e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });
    </script>
    <!-- datatable js -->
    <script type="text/javascript" src="assets/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/datatables/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                searching: false,
                "pagingType": "numbers"
            });
        } );
    </script>
    <!--- datepicker js ---->
    <script  type="text/javascript" src="assets/bootstrap/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script  type="text/javascript" src="assets/bootstrap/bootstrap-datepicker/locales/bootstrap-datepicker.th.min.js"></script>
</body>

</html>
<?php
}else{
    #--- Login Page ---#
    session_destroy();
    mysqli_close($connection);
    include "sections/employee/login.php";
}
?>
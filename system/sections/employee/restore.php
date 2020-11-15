<?php
    #----- Require -----#
    require("../../../connection/connection.php");

    if(!empty($_POST['id'])){

        $sql = "UPDATE employee SET ";
        $sql .= "status = '1',";
        $sql .= "last_edit = now() ";
        $sql .= " WHERE id = '".$_POST['id']."' ";

        $result = mysqli_query($connection, $sql);
    }
    mysqli_close($connection);
?>
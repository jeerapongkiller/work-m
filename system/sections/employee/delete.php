<?php
    #----- Require -----#
    require("../../../connection/connection.php");

    if(!empty($_POST['id'])){
        #---- Delete Images ----#
        // $uploaddir = "../../assets/images/employee/";
        // $photo_de = get_value("employee", "id", "photo", $_POST['id'], $connection);
        // unlink($uploaddir.$photo_de);

        #---- Delete Data ----#
        // $sqlem = "DELETE FROM employee WHERE id = '".$_POST['id']."' ";
        // $resulem = mysqli_query($connection, $sqlem);
        
        $sql = "UPDATE employee SET ";
        $sql .= "status = '2',";
        $sql .= "last_edit = now() ";
        $sql .= " WHERE id = '".$_POST['id']."' ";

        $result = mysqli_query($connection, $sql);
    }
    mysqli_close($connection);
?>
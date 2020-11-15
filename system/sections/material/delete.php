<?php
    #----- Require -----#
    require("../../../connection/connection.php");

    if(!empty($_POST['id'])){
        #---- Delete Images ----#
        $uploaddir = "../../assets/images/material/";
        $photo_de = get_value("material", "id", "photo", $_POST['id'], $connection);
        unlink($uploaddir.$photo_de);

        #---- Delete Data ----#
        $sqlmt = "DELETE FROM material_type WHERE id = '".$_POST['id']."' ";
        $resulmt = mysqli_query($connection, $sqlmt);

        echo $_POST['name'];
    }
    mysqli_close($connection);
?>
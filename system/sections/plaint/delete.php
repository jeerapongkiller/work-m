<?php
    #----- Require -----#
    require("../../../connection/connection.php");

    if(!empty($_POST['id'])){
        #---- Delete Data ----#
        $sqlpt = "DELETE FROM plaint_type WHERE id = '".$_POST['id']."' ";
        $resulpt = mysqli_query($connection, $sqlpt);

        echo $_POST['name'];
    }
    mysqli_close($connection);
?>
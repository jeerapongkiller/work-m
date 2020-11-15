<?php
    #----- Require -----#
    require("../../../connection/connection.php");

    if(!empty($_POST['username'])){
        $sql = "SELECT * FROM employee WHERE username = '".$_POST['username']."' ";
        $query_num = mysqli_query($connection, $sql);
        $check_num = mysqli_num_rows($query_num);
        
        echo $check_num > '0' ? 'error' : '' ;
    }
?>
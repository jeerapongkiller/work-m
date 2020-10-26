<?php
    #----- Require -----#
    require("../../../connection/connection.php");

    if(!empty($_POST['login_username']) && !empty($_POST['login_password'])){
        $sql = "SELECT * FROM employee WHERE username = '".$_POST['login_username']."' AND password = '".$_POST['login_password']."' ";
        $query_num = mysqli_query($connection, $sql);
        $check_num = mysqli_num_rows($query_num);

        if($check_num > '0'){
            $query = mysqli_query($connection, $sql);
            $row = mysqli_fetch_assoc($query);

            $titlename = get_value("titlename", "id", "name", $row['titlename'], $connection);
            $acronym = get_value("position", "id", "acronym", $row['position'], $connection);
            $position = get_value("position", "id", "name", $row['position'], $connection);
            $full_name = $acronym . ' ' . $row['firstname'] . ' ' . $row['lastname'];

            $_SESSION["admin"]["id"] = $row["id"];
            // $_SESSION["admin"]["permission"] = $row["permission"];
            $_SESSION["admin"]["firstname"] = $row["firstname"];
            $_SESSION["admin"]["lastname"] = $row["lastname"];
            $_SESSION["admin"]["photo"] = $row["photo"];
            $_SESSION["admin"]["full_name"] = $full_name;
            $_SESSION["admin"]["position"] = $position;
            $_SESSION["admin"]["timestamp"] = time();

        }

        mysqli_close($connection);
        echo "<meta http-equiv=\"refresh\" content=\"0; url = '../.././?mode=offender/index'\" >";
    }else{
        
        echo "<meta http-equiv=\"refresh\" content=\"0; url = './'\" >";
    }
?>
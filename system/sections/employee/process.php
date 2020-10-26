<?php
	#----- General Information -----#
    $id = !empty($_GET['id']) ? $_GET['id'] : "" ;
    $page_title = !empty($_POST['page_title']) ? $_POST['page_title'] : "" ;
    $username = !empty($_POST['username']) ? $_POST['username'] : "" ;
    $password = !empty($_POST['password']) ? $_POST['password'] : "" ;
    $titlename = !empty($_POST['titlename']) ? $_POST['titlename'] : "" ;
    $firstname = !empty($_POST['firstname']) ? $_POST['firstname'] : "" ;
    $lastname = !empty($_POST['lastname']) ? $_POST['lastname'] : "" ;
    $position = !empty($_POST['position']) ? $_POST['position'] : "" ;
    $phone = !empty($_POST['phone']) ? $_POST['phone'] : "" ;
    $address = !empty($_POST['address']) ? $_POST['address'] : "" ;
    $photo_de = !empty($_POST['photo_de']) ? $_POST['photo_de'] : "" ;
    #----- Picture -----#
    $photo_time = time();
    $uploaddir = "assets/images/employee/";
	$photo = $_FILES["photo"]["tmp_name"];
	$photo_name = $_FILES["photo"]["name"];
    #----- General Information -----#

    if(!empty($username) && !empty($password)) {
        #----- Save Database -----#
		if(empty($id)) {
			$sql = "INSERT INTO employee () VALUES ()";
			$result = mysqli_query($connection, $sql);
			$id = mysqli_insert_id($connection);
        }

        #----- Upload Images -----#
        if($page_title == "Create"){
            if(!empty($photo)){
                $no = "_1";
                $ext = explode(".",$photo_name);
                $ext_n = count($ext) - 1;
                $photo_fullname = $photo_time.$no.".".$ext[$ext_n];
                $uploadfile = $uploaddir."$photo_fullname";
                if(move_uploaded_file($photo, $uploadfile)){ 

                }
            }
        }else{
            if(!empty($photo)){
                unlink($uploaddir.$photo_de);
                $no = "_1";
                $ext = explode(".",$photo_name);
                $ext_n = count($ext) - 1;
                $photo_fullname = $photo_time.$no.".".$ext[$ext_n];
                $uploadfile = $uploaddir."$photo_fullname";
                if(move_uploaded_file($photo, $uploadfile)){ 

                }
            }else{
                $photo_fullname = $photo_de;
            }
        }

        if(!empty($id)) {
            $sql = "UPDATE employee SET ";
            $sql .= "status = '1',";
            $sql .= "username = '$username',";
            $sql .= "password = '$password',";
            $sql .= "titlename = '$titlename',";
            $sql .= "firstname = '$firstname',";
            $sql .= "lastname = '$lastname',";
            $sql .= "position = '$position',";
            $sql .= "phone = '$phone',";
            $sql .= "address = '$address',";
            $sql .= "photo = '$photo_fullname',";
			$sql .= "last_edit = now() ";
			$sql .= " WHERE id = '$id'";

            $result = mysqli_query($connection, $sql);

            $return_url = '&id='.$id;
            $message_alert = 'success';
        }
        echo "<meta http-equiv=\"refresh\" content=\"0; url='./?mode=employee/save" . $return_url . "&message=" . $message_alert . "'\" >";
    }else{
        $message_alert = 'error';
        echo "<meta http-equiv=\"refresh\" content=\"0; url='./?mode=employee/index" . $return_url . "&message=" . $message_alert . "'\" >";
    }
    mysqli_close($connection);
?>
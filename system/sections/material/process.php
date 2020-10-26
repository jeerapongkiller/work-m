<?php
	#----- General Information -----#
    $id = !empty($_GET['id']) ? $_GET['id'] : "" ;
    $page_title = !empty($_POST['page_title']) ? $_POST['page_title'] : "" ;
    $name = !empty($_POST['name']) ? $_POST['name'] : "" ;
    $unit = !empty($_POST['unit']) ? $_POST['unit'] : "" ;
    $detail = !empty($_POST['detail']) ? $_POST['detail'] : "" ;
    $photo_de = !empty($_POST['photo_de']) ? $_POST['photo_de'] : "" ;
    #----- Picture -----#
    $photo_time = time();
    $uploaddir = "assets/images/material/";
	$photo = $_FILES["photo"]["tmp_name"];
	$photo_name = $_FILES["photo"]["name"];
    #----- General Information -----#

    if(!empty($name) && !empty($unit)) {
        #----- Save Database -----#
		if(empty($id)) {
			$sql = "INSERT INTO material () VALUES ()";
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
            $sql = "UPDATE material SET ";
            $sql .= "status = '1',";
            $sql .= "name = '$name',";
            $sql .= "unit = '$unit',";
            $sql .= "detail = '$detail',";
            $sql .= "photo = '$photo_fullname',";
			$sql .= "last_edit = now() ";
			$sql .= " WHERE id = '$id'";

            $result = mysqli_query($connection, $sql);

            $return_url = '&id='.$id;
            $message_alert = 'success';
        }
        echo "<meta http-equiv=\"refresh\" content=\"0; url='./?mode=material/save" . $return_url . "&message=" . $message_alert . "'\" >";
    }else{
        $message_alert = 'error';
        echo "<meta http-equiv=\"refresh\" content=\"0; url='./?mode=material/index" . $return_url . "&message=" . $message_alert . "'\" >";
    }
    mysqli_close($connection);
?>
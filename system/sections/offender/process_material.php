<?php
	#----- General Information -----#
    $id = !empty($_GET['id']) ? $_GET['id'] : "" ;
    $page_title = !empty($_POST['page_title']) ? $_POST['page_title'] : "" ;
    $plaint = !empty($_POST['plaint']) ? $_POST['plaint'] : "" ;
    $offen = !empty($_POST['offen']) ? $_POST['offen'] : "" ;
    $material_type = !empty($_POST['material_type']) ? $_POST['material_type'] : "" ;
    $material_num = !empty($_POST['material_num']) ? $_POST['material_num'] : "" ;
    $material_detail = !empty($_POST['material_detail']) ? $_POST['material_detail'] : "" ;
    #----- Picture -----#
    $photo_time = time();
    $uploaddir = "assets/images/material/";
    $photo1 = $_FILES["photo1"]["tmp_name"];
    $photo2 = $_FILES["photo2"]["tmp_name"];
    $photo3 = $_FILES["photo3"]["tmp_name"];
    $photo_name1 = $_FILES["photo1"]["name"];
    $photo_name2 = $_FILES["photo2"]["name"];
    $photo_name3 = $_FILES["photo3"]["name"];
    #----- General Information -----#

    if(!empty($plaint) && !empty($material_type)) {
        #----- Save Database -----#
		if(empty($id)) {
			$sql = "INSERT INTO material () VALUES ()";
			$result = mysqli_query($connection, $sql);
			$id = mysqli_insert_id($connection);
        }

        #----- Upload Images -----#
        if($page_title == "Create"){
            if(!empty($photo1)){
                $no = "_1";
                $ext = explode(".",$photo_name1);
                $ext_n = count($ext) - 1;
                $photo_fullname1 = $photo_time.$no.".".$ext[$ext_n];
                $uploadfile = $uploaddir."$photo_fullname1";
                if(move_uploaded_file($photo1, $uploadfile)){ 
                }
            }
            if(!empty($photo2)){
                $no = "_2";
                $ext = explode(".",$photo_name2);
                $ext_n = count($ext) - 1;
                $photo_fullname2 = $photo_time.$no.".".$ext[$ext_n];
                $uploadfile = $uploaddir."$photo_fullname2";
                if(move_uploaded_file($photo2, $uploadfile)){ 
                }
            }
            if(!empty($photo3)){
                $no = "_3";
                $ext = explode(".",$photo_name3);
                $ext_n = count($ext) - 1;
                $photo_fullname3 = $photo_time.$no.".".$ext[$ext_n];
                $uploadfile = $uploaddir."$photo_fullname3";
                if(move_uploaded_file($photo3, $uploadfile)){ 
                }
            }
        }else{
            if(!empty($photo1)){
                unlink($uploaddir.$photo_de1);
                $no = "_1";
                $ext = explode(".",$photo_name1);
                $ext_n = count($ext) - 1;
                $photo_fullname1 = $photo_time.$no.".".$ext[$ext_n];
                $uploadfile = $uploaddir."$photo_fullname1";
                if(move_uploaded_file($photo1, $uploadfile)){ 
                }
            }else{
                $photo_fullname1 = $photo_de1;
            }
            if(!empty($photo2)){
                unlink($uploaddir.$photo_de2);
                $no = "_2";
                $ext = explode(".",$photo_name2);
                $ext_n = count($ext) - 1;
                $photo_fullname2 = $photo_time.$no.".".$ext[$ext_n];
                $uploadfile = $uploaddir."$photo_fullname2";
                if(move_uploaded_file($photo2, $uploadfile)){ 
                }
            }else{
                $photo_fullname2 = $photo_de2;
            }
            if(!empty($photo3)){
                unlink($uploaddir.$photo_de3);
                $no = "_3";
                $ext = explode(".",$photo_name3);
                $ext_n = count($ext) - 1;
                $photo_fullname3 = $photo_time.$no.".".$ext[$ext_n];
                $uploadfile = $uploaddir."$photo_fullname3";
                if(move_uploaded_file($photo3, $uploadfile)){ 
                }
            }else{
                $photo_fullname3 = $photo_de3;
            }
        }

        if(!empty($id)) {
            $sql = "UPDATE material SET ";
            $sql .= "status = '1',";
            $sql .= "plaint = '$plaint',";
            $sql .= "material_type = '$material_type',";
            $sql .= "material_num = '$material_num',";
            $sql .= "material_detail = '$material_detail',";
            $sql .= "photo1 = '$photo_fullname1',";
            $sql .= "photo2 = '$photo_fullname2',";
            $sql .= "photo3 = '$photo_fullname3',";
			$sql .= "last_edit = now() ";
			$sql .= " WHERE id = '$id'";

            $result = mysqli_query($connection, $sql);

            $return_url = '&id='.$id.'&offen='.$offen.'&plaint='.$plaint;
            $message_alert = 'success';

        }
        echo "<meta http-equiv=\"refresh\" content=\"0; url='./?mode=offender/save_material" . $return_url . "&message=" . $message_alert . "'\" >";
    }else{
        $message_alert = 'error';
        echo "<meta http-equiv=\"refresh\" content=\"0; url='./?mode=offender/index" . $return_url . "&message=" . $message_alert . "'\" >";
    }
    mysqli_close($connection);
?>
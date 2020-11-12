<?php
	#----- General Information -----#
    $id = !empty($_GET['id']) ? $_GET['id'] : "" ;
    $page_title = !empty($_POST['page_title']) ? $_POST['page_title'] : "" ;
    $titlename = !empty($_POST['titlename']) ? $_POST['titlename'] : "" ;
    $firstname = !empty($_POST['firstname']) ? $_POST['firstname'] : "" ;
    $lastname = !empty($_POST['lastname']) ? $_POST['lastname'] : "" ;
    $id_card = !empty($_POST['id_card']) ? $_POST['id_card'] : "" ;
    $age = !empty($_POST['age']) ? $_POST['age'] : "" ;
    $sex = !empty($_POST['sex']) ? $_POST['sex'] : "" ;
    $phone = !empty($_POST['phone']) ? $_POST['phone'] : "" ;
    $address = !empty($_POST['address']) ? $_POST['address'] : "" ;
    $photo_de1 = !empty($_POST['photo_de1']) ? $_POST['photo_de1'] : "" ;
    $photo_de2 = !empty($_POST['photo_de2']) ? $_POST['photo_de2'] : "" ;
    $photo_de3 = !empty($_POST['photo_de3']) ? $_POST['photo_de3'] : "" ;
    #----- Picture -----#
    $photo_time = time();
    $uploaddir = "assets/images/offender/";
    $photo1 = $_FILES["photo1"]["tmp_name"];
    $photo2 = $_FILES["photo2"]["tmp_name"];
    $photo3 = $_FILES["photo3"]["tmp_name"];
    $photo_name1 = $_FILES["photo1"]["name"];
    $photo_name2 = $_FILES["photo2"]["name"];
    $photo_name3 = $_FILES["photo3"]["name"];
    #----- General Information -----#

    if(!empty($firstname) && !empty($lastname)) {
        #----- Save Database -----#
		if(empty($id)) {
			$sql = "INSERT INTO offender () VALUES ()";
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
                if(move_uploaded_file($photo2, $uploadfile)){ 
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
            $sql = "UPDATE offender SET ";
            $sql .= "status = '1',";
            $sql .= "titlename = '$titlename',";
            $sql .= "firstname = '$firstname',";
            $sql .= "lastname = '$lastname',";
            $sql .= "id_card = '$id_card',";
            $sql .= "age = '$age',";
            $sql .= "sex = '$sex',";
            $sql .= "phone = '$phone',";
            $sql .= "address = '$address',";
            $sql .= "photo1 = '$photo_fullname1',";
            $sql .= "photo2 = '$photo_fullname2',";
            $sql .= "photo3 = '$photo_fullname3',";
			$sql .= "last_edit = now() ";
			$sql .= " WHERE id = '$id'";

            $result = mysqli_query($connection, $sql);

            $return_url = '&id='.$id;
            $message_alert = 'success';

        }
        echo "<meta http-equiv=\"refresh\" content=\"0; url='./?mode=offender/save" . $return_url . "&message=" . $message_alert . "'\" >";
    }else{
        $message_alert = 'error';
        echo "<meta http-equiv=\"refresh\" content=\"0; url='./?mode=offender/index" . $return_url . "&message=" . $message_alert . "'\" >";
    }
    mysqli_close($connection);
?>
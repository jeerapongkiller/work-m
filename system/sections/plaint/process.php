<?php
	#----- General Information -----#
    $id = !empty($_GET['id']) ? $_GET['id'] : "" ;
    $page_title = !empty($_POST['page_title']) ? $_POST['page_title'] : "" ;
    $name = !empty($_POST['name']) ? $_POST['name'] : "" ;
    $detail = !empty($_POST['detail']) ? $_POST['detail'] : "" ;
    #----- General Information -----#

    if(!empty($name)) {
        #----- Save Database -----#
		if(empty($id)) {
			$sql = "INSERT INTO plaint_type () VALUES ()";
			$result = mysqli_query($connection, $sql);
			$id = mysqli_insert_id($connection);
        }

        if(!empty($id)) {
            $sql = "UPDATE plaint_type SET ";
            $sql .= "status = '1',";
            $sql .= "name = '$name',";
            $sql .= "detail = '$detail',";
			$sql .= "last_edit = now() ";
			$sql .= " WHERE id = '$id'";

            $result = mysqli_query($connection, $sql);

            $return_url = '&id='.$id;
            $message_alert = 'success';
        }
        echo "<meta http-equiv=\"refresh\" content=\"0; url='./?mode=plaint/save" . $return_url . "&message=" . $message_alert . "'\" >";
    }else{
        $message_alert = 'error';
        echo "<meta http-equiv=\"refresh\" content=\"0; url='./?mode=plaint/index" . $return_url . "&message=" . $message_alert . "'\" >";
    }
    mysqli_close($connection);
?>
<?php
	#----- General Information -----#
    $id = !empty($_GET['id']) ? $_GET['id'] : "" ;
    $page_title = !empty($_POST['page_title']) ? $_POST['page_title'] : "" ;
    $offen = !empty($_POST['offen']) ? $_POST['offen'] : "" ;
    $plaint_type = !empty($_POST['plaint_type']) ? $_POST['plaint_type'] : "" ;
    $plaint_date = !empty($_POST['plaint_date']) ? $_POST['plaint_date'] : "" ;
    $plaint_time = !empty($_POST['plaint_time']) ? $_POST['plaint_time'] : "" ;
    $plaint_address = !empty($_POST['plaint_address']) ? $_POST['plaint_address'] : "" ;
    #----- General Information -----#

    if(!empty($offen)) {
        #----- Save Database -----#
		if(empty($id)) {
			$sql = "INSERT INTO plaint () VALUES ()";
			$result = mysqli_query($connection, $sql);
			$id = mysqli_insert_id($connection);
        }

        if(!empty($id)) {
            $sql = "UPDATE plaint SET ";
            $sql .= "status = '1',";
            $sql .= "offender = '$offen',";
            $sql .= "plaint_type = '$plaint_type',";
            $sql .= "plaint_date = '$plaint_date',";
            $sql .= "plaint_time = '$plaint_time',";
            $sql .= "plaint_address = '$plaint_address',";
			$sql .= "last_edit = now() ";
			$sql .= " WHERE id = '$id'";

            $result = mysqli_query($connection, $sql);

            $return_url = '&id='.$id.'&offen='.$offen;
            $message_alert = 'success';
        }
        echo "<meta http-equiv=\"refresh\" content=\"0; url='./?mode=offender/save_plaint" . $return_url . "&message=" . $message_alert . "'\" >";
    }else{
        $message_alert = 'error';
        echo "<meta http-equiv=\"refresh\" content=\"0; url='./?mode=offender/index" . $return_url . "&message=" . $message_alert . "'\" >";
    }
    mysqli_close($connection);
?>
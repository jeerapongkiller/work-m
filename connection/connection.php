<?php 
	session_start();
	date_default_timezone_set("Asia/Bangkok");

	#----- Configuration -----#
	$hostname_connection = "localhost";
	$database_connection = "system_police";
	$username_connection = "root";
	$password_connection = "123456789";

    $connection = mysqli_connect($hostname_connection, $username_connection, $password_connection, $database_connection);
    
	if (!$connection) {
		die("Connection failed: " . mysqli_connect_error());
	}

	mysqli_set_charset($connection,"utf8");

	$today = date("Y-m-d");
	$times = date("H:i:s");

	#----- Func : get_value -----#
	function get_value($table,$field_id,$field_name,$val,$conn)
	{
		$sqlgv = "SELECT $field_id , $field_name FROM $table WHERE $field_id = '$val'";
		$resultgv = mysqli_query($conn, $sqlgv);
		$numrowgv = mysqli_num_rows($resultgv);

		if(!empty($numrowgv)){
			$rows = mysqli_fetch_array($resultgv);
			$value = "$rows[1]";
			//$value = preg_replace("~'~","",$value);
		}else{
			$value = "";
		}

		return $value;
	}
	#----- Func : get_value -----#
?>
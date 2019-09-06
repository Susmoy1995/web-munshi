<?php 
	// session_start();
	$conn = mysqli_connect("localhost", "root", "", "project");
	if(!$conn) {
		die("Connection Failed: ".mysqli_connect_error());
	}

	$sql = "SELECT last_date FROM month_record WHERE user_id=".$_SESSION["user_id"];
	$result = mysqli_query($conn, $sql)or die(mysqli_error($conn));
	

	while($row = mysqli_fetch_assoc($result)) {
		$last_date = $row["last_date"];
	}
	$last_date = strtotime($last_date);
	$last_date = date('Y-m-d', $last_date);

	$updateDate = Date('Y-m-d', strtotime($last_date."+30 days"));

	date_default_timezone_set('Asia/Dhaka');
	current_date = date('Y-m-d');

	$current_date = new DateTime(current_date);
	$last_date = new DateTime($last_date);
	$interval = $current_date->diff($last_date);

	if($interval->days >= 2) {

		$updateSql = "UPDATE month_record SET first_date='"$last_date"', last_date='".$updateDate."' WHERE user_id=".$_SESSION["user_id"];
		if(mysqli_query($conn, $updateSql)) {

		} else {
			echo "Error occured: ".mysqli_error($conn);
		}
	}

	mysqli_close($conn);

 ?>
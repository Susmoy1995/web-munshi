<?php 

	function income_validation($topic, $val, $details) {
		$error_log = array();

		if(empty($topic)) {
			$error_log['topicErr'] = "Topic must be added";
		} else {
			$topic = test_input($topic);
		}

		if(empty($val)) {
			$error_log['val'] = "Value must be added";
		} else {
			$val = test_input($val);
			// check value in number
			if (!preg_match("/^[0-9 ]*$/",$val)) {
		      $error_log['numberErr'] = "Only numbers allowed in case of expense value"; 
		    }
		}

		$details = test_input($details);

		if(count($error_log) == 0) {
			$conn = mysqli_connect("localhost", "root", "", "project");
			if(!$conn) {
				die("Connection Failed".mysqli_connect_error());
			}
			date_default_timezone_set('Asia/Dhaka');
			$date = date('Y-m-d');
			$sql = "INSERT INTO income_record VALUES (NULL, '".$topic."', '".$details."', '".$val."', '".$date."', ".$_SESSION["user_id"].")";

			if(mysqli_query($conn, $sql)) {
				$error_log["item_add"] = "New income added";
			} else {
				$error_log["error"] = "Error occured not added";
			}
			mysqli_close($conn);
			return $error_log;
		} else {
			return $error_log;
		}
	}

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
 ?>
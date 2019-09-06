<?php 
	// session_start();

	function validation($prev_password, $new_password) {
		$log = array();

		if(empty($prev_password)) {
			$log["prev_password_error"] = "Previous password not filled";
		}
		elseif ($prev_password != $_SESSION["user_password"]) {
			$log["prev_password_error"] = "wrong old password input";
		}
		else {
			$prev_password = test_input($prev_password);
		}

		if(empty($new_password)) {
			$log["new_password_error"] = "New Password not filled";
		} 
		elseif($prev_password == $new_password) {
			$log["new_password_error"] = "New password must be different from old password";
 		}
		else {
			$new_password = test_input($new_password);
		}

		if(count($log) == 0) {
			$conn = mysqli_connect("localhost", "root", "", "project");
			if(!$conn) {
				die("Connectin failed: ".mysqli_connect_error());
			}

			$sql = "UPDATE users SET user_password='".$new_password."' WHERE user_id=".$_SESSION["user_id"];
			if(mysqli_query($conn, $sql)) {
				$log["update"] = "New password updated";
				$_SESSION["user_password"] = $new_password;
			} else {
				$log["update_failed"] = "New password couldn't update";
 			}

 			mysqli_close($conn);
 			return $log;
		}
		else {
			return $log;
		}
	}

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);

		return $data;
	}

 ?>
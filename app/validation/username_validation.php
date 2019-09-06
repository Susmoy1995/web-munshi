<?php 
	
	 // session_start();

	function validation($username, $password) {

		$log = array();

		if(empty($username)) {
			$log["username_error"] = "username must be filled";
		} 
		elseif($username == $_SESSION["username"]) {
			$log["username_error"] = "username must be new one";
 		}
		else {
			$username = test_input($username);
		}

		if(empty($password)) {
			$log["password_error"] = "password must be filled";
		} 
		elseif($password != $_SESSION["user_password"]) {
			$log["password_error"] = "wrong password input";
		}
		else {
			$password = test_input($password);
		}

		if(count($log) == 0) {
			$conn = mysqli_connect("localhost", "root", "", "project");
			if(!$conn) {
				die("Connection failed: ".mysqli_connect_error());
			} 

			//sql = "UPDATE users SET username='".$username."' WHERE user_id=".$_SESSION["user_id"]."";
			$sql = "UPDATE users SET username='".$username."' WHERE user_id=".$_SESSION["user_id"];
			if (mysqli_query($conn, $sql)) {
				$log["update"] = "New username updated";
				$_SESSION["username"] = $username;
			} else {
				$log["update_failed"] = "Update failed";
			}
			mysqli_close($conn);
			return $log;
		} else {
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
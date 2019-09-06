<?php 
		session_start();
		// define variables and set to empty values
		
		function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}

		function login_validation($email, $password) {
			// $emailErr = $passErr = "";
			// $stat = true;
			$error_log = array();

			if(empty($email)) {
				$error_log['emailErr'] = "Email is required";
				// $stat = false;
			} else {
				$email = test_input($email);

				if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$error_log['invalid_email_format'] = "Invalid email format";
					// $stat = false;
				}
			}

			if(empty($password)) {
				$error_log['passErr'] = "Password is required";
				// $stat = false;
			} else {
				$password = test_input($password);
			}

			if(count($error_log) == 0) {
				
				$conn = mysqli_connect("localhost", "root", "", "project");
				if(!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}

				$sql = "SELECT * FROM users WHERE user_email='".$email."' AND user_password='".$password."'";
				$result = mysqli_query($conn, $sql)or die(mysqli_error($conn));

				if(mysqli_num_rows($result) > 0) {
					
					while($row = mysqli_fetch_assoc($result)) {
						$_SESSION["logged_in"] = 1;
        				$_SESSION["user_id"] = $row["user_id"];
        				$_SESSION["username"] = $row["username"];
        				$_SESSION["user_password"] = $row["user_password"];
        				$_SESSION["user_email"] = $row["user_email"];
        				$_SESSION["created_at"] = $row["created_at"];     
    				}
				}
				else {
					$error_log['account_not_found'] = "user account not found";
					return $error_log;
				}

				mysqli_close($conn);
				header("Location:./user/expense.php");

			} else {
				return $error_log;
			}
		}

	 ?>
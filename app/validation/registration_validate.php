<?php 

	// define variables and set to empty values
	
	function register_validate($un, $email, $pass)
	{
		$error_log = array();

		if (empty($un)) {
		    $error_log['usernameErr'] = "Name is required";
		    
		} else {
		    $un = test_input($un);
		    // check if name only contains letters and whitespace
		    if (!preg_match("/^[a-zA-Z ]*$/",$un)) {
		      $error_log['usernameFormatErr'] = "Only letters and white space allowed in username"; 
		    }
		  }
		  
		if (empty($email)) {
		    $error_log['emailErr'] = "Email is required";
		} else {
		    $email = test_input($email);
		    // check if e-mail address is well-formed
		    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		      $error_log['emailFormatErr'] = "Invalid email format"; 
		    }
		}

		if (empty($pass)) {
		    $error_log['passErr'] = "Password is required";
		} else {
		    $pass = test_input($pass);
		} 
		

		if(count($error_log) == 0) {
			// insert into users table
			$conn = mysqli_connect("localhost", "root", "", "project");
			if(!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

			$email_sql = "SELECT * FROM users WHERE user_email='".$email."'";
			$result = mysqli_query($conn, $email_sql)or die(mysqli_error($conn));

			if(mysqli_num_rows($result) == 0)
			{
				date_default_timezone_set('Asia/Dhaka');
				$date = date('Y-m-d');
				$sql = "INSERT INTO users VALUES (NULL, '".$un."', '".$email."', '".$pass."', '".$date."')";

				if(mysqli_query($conn, $sql)) {
					$error_log['success'] = "Account added";

					$getUserId = "SELECT created_at, user_id FROM users WHERE user_email='".$email."'";
					$neo_result = mysqli_query($conn, $getUserId)or die(mysqli_error($conn));

					while($row = mysqli_fetch_assoc($neo_result)) {
						$dateAfterThirty = Date('Y-m-d', strtotime("+30 days"));
						$insertIntoMonthRecord = "INSERT INTO month_record VALUES (NULL, ".$row["user_id"].", '".$row["created_at"]."', '".$dateAfterThirty."')";

						if(mysqli_query($conn, $insertIntoMonthRecord)) {

						}
					}


				} else {
					$error_log['error'] = "Error occured: ".mysqli_close($conn)."<br/>query :".$sql."<br/>connection: ".$conn;
				}
			}
			else {
				$error_log["email_exists"] = "This email address already in use";
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
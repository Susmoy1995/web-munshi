<?php 

	session_start();
	if(isset($_SESSION["logged_in"])) {
		header("Location:./user/expense.php");
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		include './validation/registration_validate.php';
		$errors = register_validate($_POST["username"], $_POST["email"], $_POST["password"]);		  
	}

 ?>

<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="./css/register.css">
	<script type="text/javascript">
		function validate() {
			var flag = true;

			var uname_msg = document.getElementById('uname_msg');
			var email_msg = document.getElementById('email_msg');
			var pass_msg = document.getElementById('pass_msg');
			var conf_pass_msg = document.getElementById('conf_pass_msg');

			if(document.fm.username.value.length == 0) {
				uname_msg.style.color = "red";
				uname_msg.innerHTML = "Username must be filled";
				flag = false;
			} 
			
			if(document.fm.email.value.length == 0) {
				email_msg.style.color = "red";
				email_msg.innerHTML = "Email must be filled";
				flag = false;	
			}

			if(document.fm.email.value.length != 0) {
				var x = document.fm.email.value;
				var atpos = x.indexOf("@");
				var dotpos = x.indexOf(".");

				if(atpos < 1 || dotpos < atpos + 2 || dotpos+2 >= x.length) {
					email_msg.style.color = "red";
					email_msg.innerHTML = "Correct email address must be filled";
					flag = false;
				}
			}

			if(document.fm.password.value.length == 0) {
				pass_msg.style.color = "red";
				pass_msg.innerHTML = "Password must be filled";
				flag = false;
			}

			if(document.fm.conf_password.value.length == 0) {
				conf_pass_msg.style.color = "red";
				conf_pass_msg.innerHTML = "Confirm password must be filled";
				flag = false;
			}

			if(document.fm.password.value != document.fm.conf_password.value) {
				conf_pass_msg.style.color = "red";
				conf_pass_msg.innerHTML = "Password don't match";
				flag = false;
			}

			return flag;
		}
	</script>
</head>
<body>
	<div id="home-div"><a id="home" href="base.php"> &lt; Back to home</a></div>
	<form name="fm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	<table style="border: 1; border-collapse: collapse;">
		<tr>
			<td colspan="2" align="center"><h1>Registration Form</h1></td>
		</tr>
		<tr>
			<td>Username</td>
			<td><input type="text" name="username"><span id="uname_msg"></span></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type="text" name="email"><span id="email_msg"></span></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="password"><span id="pass_msg"></span></td>
		</tr>
		<tr>
			<td>Confirm Password</td>
			<td><input type="password" name="conf_password"><span id="conf_pass_msg"></span></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" onclick="return validate();" value="Register"></td>
		</tr>
	</table>
<a id="link" href="login.php">Already have an account? Click here</a>
	</form>

	<ul>
		<?php
			if(isset($errors) && $errors != null) { 
				foreach ($errors as $key => $value) {
					if($value != "") {
						echo "<li style='color: red;'>".$value."</li>";
					}
				}
			}
		 ?>
	</ul>
</body>
</html>
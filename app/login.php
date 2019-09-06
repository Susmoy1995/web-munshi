<?php 
	session_start();
	if(isset($_SESSION["logged_in"])) {
		header("Location:./user/expense.php");
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		include './validation/login_validation.php';
		$errors = login_validation($_POST["email"], $_POST["password"]);		  
	}

 ?>

<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="./css/login.css">
	<script type="text/javascript">
		function validate() {
			var flag = true;

			var email_msg = document.getElementById('email_msg');
			var pass_msg = document.getElementById('pass_msg');

			if(document.fm.email.value.length == 0) {
				email_msg.style.color = "red";
				email_msg.innerHTML = "Email must be filled";
				flag = false;
			}

			// if(document.fm.email.value.length != 0) {
			// 	var x = document.fm.email.value;
			// 	var atpos = x.indexOf("@");
			// 	var dotpos = x.indexOf(".");

			// 	if(atpos < 1 || dotpos < atpos + 2 || dotpos+2 >= x.length) {
			// 		email_msg.style.color = "red";
			// 		email_msg.innerHTML = "Correct email address must be filled";
			// 		flag = false;
			// 	}
			// }

			if(document.fm.password.value.length == 0) {
				pass_msg.style.color = "red";
				pass_msg.innerHTML = "Password must be filled";
				flag = false;
			}

			return flag;
		}
	</script>
</head>
<body>
	<div id="home-div"><a id="home" href="base.php"> &lt; Back to home</a></div>
	<form name="fm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	<table>
		<tr>
			<td colspan="2" align="center"><h1>Login Form</h1></td>
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
			<td colspan="2" align="center"><input type="submit" onclick="return validate();" value="Login"></td>
			
		</tr>
	</table>
	<div style="text-align: center"><a href="register.php">Need an account? Click here</a></div>
	</form>


	<ul>
		<?php 
			if(isset($errors) && $errors != null) {
				foreach ($errors as $key => $value) {
					echo "<li style='color: red;'>".$value."</li>";
				}
			}
		 ?>
	</ul>
</body>
</html>
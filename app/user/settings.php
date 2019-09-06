<?php 
	session_start();
	if(!isset($_SESSION["logged_in"])) {
		header("Location:../login.php");
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if(isset($_POST["prev_password"]) && isset($_POST["new_password"])) {
			include '../validation/password_validation.php';
			$log1 = validation($_POST["prev_password"], $_POST["new_password"]);		  
		}

		elseif (isset($_POST["new_username"]) && isset($_POST["password"])) {
			include '../validation/username_validation.php';
			$log2 = validation($_POST["new_username"], $_POST["password"]);
		}
	}
 ?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/settings.css">
	<title>Settings</title>
</head>
<body>

	<div class="flex-container">

	<div class="link">
		<a href="../base.php"><img src="../static/home.jpg"><br>Home</a>
		<a href="month_record.php"><img src="../static/record.png"><br>record</a>
		<a href="income.php">
			<img src="../static/money.png"><br>
			income
		</a>
		<a href="expense.php">
			<img src="../static/money.png"><br>
			expense
		</a>
		<a href="settings.php" class="active">
			<img src="../static/settings.png"><br>
			settings
		</a>
		<a style="background-color: red;" href="logout.php">
			<img src="../static/logout.png"><br>
			logout
		</a>
	</div>
	
	<div class="form1">
	<form name="passfm" method="post" onsubmit="return validate1();" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<h2>Password change</h2>
		<table>
			<tr>
				<td>Previous Password</td>
				<td><input type="password" name="prev_password"><span id="prev_msg"></span></td>
			</tr>
			<tr>
				<td>New Password</td>
				<td><input type="password" name="new_password"><span id="new_msg"></span></td>
			</tr>
			<tr>
				<td><input type="submit" value="change"></td>
			</tr>
		</table>
	</form>

	<ul>
		<?php 
			if(isset($log1) && count($log1) != 0) {
				foreach ($log1 as $key => $value) {
					if($value != "") {
						echo "<li style='color: red;'>".$value."</li>";
					}
				}
			}
		 ?>
	</ul>
	</div>

	<div class="form2">
	<form name="namefm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<h2>Username change</h2>
		<table>
			<tr>
				<td>New Username</td>
				<td><input type="text" name="new_username"><span id="name_msg"></span></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="password"><span id="pass_msg"></span></td>
			</tr>
			<tr>
				<td><input type="submit" onclick="return validate2();" value="change"></td>
			</tr>
		</table>
	</form>

	<ul>
		<?php 
			if(isset($log2) && count($log2) != 0) {
				foreach ($log2 as $key => $value) {
					if($value != "") {
						echo "<li style='color: red;'>".$value."</li>";
					}
				}
			}
		 ?>
	</ul>
	</div>

	</div>
</body>
</html>
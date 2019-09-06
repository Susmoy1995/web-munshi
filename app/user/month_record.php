<?php 
	session_start();

	if(!isset($_SESSION["logged_in"])) {
		header("Location:../login.php");
	}

	//date_default_timezone_set('Asia/Dhaka');
	//$curr_date = date('Y-m-d');

	$date = new DateTime($_SESSION["created_at"]); // Y-m-d
	// echo $date->format("%Y-%m-%d");
	$date->add(new DateInterval('P30D'));
	$date_after_thirty = $date->format('Y-m-d');

 ?>

<html>
<head>
	<title>Month record</title>
	<link rel="stylesheet" type="text/css" href="../css/month_record.css">
</head>
<body>
	<div class="flex-container">
	<div class="link">
		<a href="../base.php"><img src="../static/home.jpg"><br>Home</a>
		<a href="month_record.php" class="active"><img src="../static/record.png"><br>record</a>
		<a href="income.php">
			<img src="../static/money.png"><br>
			income
		</a>
		<a href="expense.php">
			<img src="../static/money.png"><br>
			expense
		</a>
		<a href="settings.php">
			<img src="../static/settings.png"><br>
			settings
		</a>
		<a style="background-color: red;" href="logout.php">
			<img src="../static/logout.png"><br>
			logout
		</a>
	</div>

		<div class="form">
			<?php 
				date_default_timezone_set('Asia/Dhaka');
				$curr_date = date('Y-m-d');

				if($curr_date != $date_after_thirty) {
					echo "Your month is not over yet";
				} else {
					echo "Your monthly record book is ready";
				}
			 ?>
			<ul>
				<li><a href="income_record.php">Income record</a></li>
		 		<li><a href="expense_record.php">Expense record</a></li>
			</ul>
		 	
	 	</div>
	 </div>
</body>
</html>
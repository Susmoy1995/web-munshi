<?php
	session_start();

	require '../check_dateUpdate.php';

	if(!isset($_SESSION["logged_in"])) {
		header("Location:../login.php");
		//echo "error";
	}

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		include '../validation/expense_validation.php';
		// echo "topic: ".$_POST['expense_topic']."<br/>value: ".$_POST['expense_value'];
		$errors = expense_validation($_POST['expense_topic'], $_POST['expense_value'], $_POST['expense_details']);
	}
 ?>

<html>
<head>
	<title>Expense</title>
	<link rel="stylesheet" type="text/css" href="../css/expense.css">

	<script type="text/javascript">
		function validate() {
			var topic_msg = document.getElementById('topic_msg');
			var val_msg = document.getElementById('val_msg');
			var stat = true;

			if(document.fm.expense_topic.value.length == 0 || document.fm.expense_topic.value.trim().length == 0) {
				topic_msg.style.color = "red";
				topic_msg.innerHTML = "Expense topic is required";
				stat = false;
			}

			if(document.fm.expense_value.value.length == 0 || document.fm.expense_value.value.trim().length == 0) {
				val_msg.style.color = "red";
				val_msg.innerHTML = "Expense value is required";
				stat = false;
			}

			if(isNaN(document.fm.expense_value.value)) {
				val_msg.style.color = "red";
				val_msg.innerHTML = "Only numbers will be allowed";
				stat = false;
			}

			return stat;
		}


		function showHint() {
			var  xmlhttp = new XMLHttpRequest();
			var str = document.getElementById('search').value;
			console.log(str);

			xmlhttp.onreadystatechange = function() {
				//alert(xmlhttp.rxmlhttpeadyState);
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {			
					//document.getElementById("spinner").style.visibility= "hidden";
					var m=document.getElementById("txtHint");
					m.innerHTML=xmlhttp.responseText;;
				}
			};

			var url="expense_server.php?query="+str;
			//alert(url);
			xmlhttp.open("GET", url,true);
			xmlhttp.send();
		}

		function showAll() {
			var  xmlhttp = new XMLHttpRequest();
			var str = "";
			console.log(str);

			xmlhttp.onreadystatechange = function() {
				//alert(xmlhttp.rxmlhttpeadyState);
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {			
					//document.getElementById("spinner").style.visibility= "hidden";
					var m=document.getElementById("txtHint");
					m.innerHTML=xmlhttp.responseText;;
				}
			};

			var url="expense_server.php?query="+str;
			//alert(url);
			xmlhttp.open("GET", url,true);
			xmlhttp.send();
		}

	</script>
</head>
<body onload="showAll()">
	<div class="flex-container">
	
	<div class="link">
		<a href="../base.php"><img src="../static/home.jpg"><br>Home</a>
		<a href="month_record.php"><img src="../static/record.png"><br>record</a>
		<a href="income.php">
			<img src="../static/money.png"><br>
			income
		</a>
		<a href="expense.php" class="active">
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
	<form name="fm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<table style="border-collapse: collapse;">
			<tr>
				<td><input type="text" name="expense_topic" placeholder="Enter your expense topic"><span id="topic_msg"></span></td>
			</tr>
			<tr>
				<td><input type="text" name="expense_value" placeholder="Enter value"><span id="val_msg"></span></td>
			</tr>
			<tr>
				<td><textarea name="expense_details" rows="10" cols="50" placeholder="Enter your expense details if needed"></textarea></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" onclick="return validate();" value="add"></td>
			</tr>
		</table>
	</form>

	<ul>
		<?php 
			if(isset($errors) && count($errors) != 0) {
				foreach ($errors as $key => $value) {
					echo "<li style='color: red;'>".$value."</li>";
				}
			}
		 ?>
	</ul>
	</div>

	<div class="src">
		
		<input type="text" id="search" name="search">
		<input type="submit" onclick="showHint()" value="get">
		<input type="submit" onclick="showAll()" value="show all">
		
		<ul id="txtHint"></ul>
	</div>

	</div>
</body>
</html>
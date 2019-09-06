<?php 
	session_start();

	if(!isset($_SESSION["logged_in"])) {
		header("Location:../login.php");
		//echo "error";
	}
 ?>

 <html>
 <head>
 	<title>Expense Record</title>
 	<link rel="stylesheet" type="text/css" href="../css/expense_record.css">
 	<script type="text/javascript">
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

			var url="expense_record_server.php?query="+str;
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

			var url="expense_record_server.php?query="+str;
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
			<div>
				<input type="text" id="search">
				<input type="submit" onclick="showHint()" value="get">
				<input type="submit" onclick="showAll()" value="show all">
				<a href="../pdf/pdf_expense.php">Download PDF</a>
			</div>

			<div id="txtHint"></div>
		</div>
	</div>
 </body>
 </html>

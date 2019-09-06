<style type="text/css">
	table {
		width: 100%;
	}

	th, td {
		border: 1px solid black;
	}
	td {
		padding: 10px;
	}
</style>


<?php 
		session_start();

		

		$conn = mysqli_connect("localhost", "root", "", "project");
		if(!$conn) {
			die("Connection failed: ".mysqli_connect_error());
		}

		$log = 0;
		$total = 0;

		$date_sql = "SELECT SUM(income_record.income_value) AS total_val, income_record.income_date FROM income_record, month_record WHERE income_record.user_id=month_record.user_id AND income_record.user_id=".$_SESSION["user_id"]." AND income_record.income_date BETWEEN month_record.first_date AND month_record.last_date GROUP BY income_date";
		$date_result = mysqli_query($conn, $date_sql)or die(mysqli_error($conn));

		while($date_row = mysqli_fetch_assoc($date_result)) {
			// echo "<h1>".$date_row["expense_date"]."</h1>";

			if(isset($_REQUEST["query"]) && strlen($_REQUEST["query"]) == 0) {
				$income_sql = "SELECT * FROM income_record WHERE user_id=".$_SESSION["user_id"]." AND income_date='".$date_row["income_date"]."'";
				$log = 1;
			} else {
				$income_sql = "SELECT * FROM income_record WHERE income LIKE '%".$_REQUEST["query"]."%' AND user_id=".$_SESSION["user_id"]." AND income_date='".$date_row["income_date"]."'";
				$log = 2;
			}

			$income_result = mysqli_query($conn, $income_sql)or die(mysqli_error($conn));

			if(mysqli_num_rows($income_result) > 0) {
			echo "<h1>".$date_row["income_date"]."</h1>";
			echo "<table style='border: 1px solid black; border-collapse: collapse;'>";
			echo "<tr style='border: 1px solid black;'>";
				echo "<th>Income</th>";
				echo "<th>Income details</th>";
				echo "<th>Income value</th>";
			echo "</tr>";
			
				while($income_row = mysqli_fetch_assoc($income_result)) {
					if($log == 2) { 
						echo "<tr style='border: 1px solid black; background-color:rgb(250,250,210)'>";
					}
					else {
						echo "<tr style='border: 1px solid black;'>";
					}
					echo "<td>".$income_row["income"]."</td>";
					if($income_row["income_desc"] != null) { 
						echo "<td>".$income_row["income_desc"]."</td>";
					}
					else {
						echo "<td><i>No description</i></td>";
					}
					echo "<td>".$income_row["income_value"]."</td>";
					echo "</tr>";
				}

				echo "<hr/>";
			}
			
			if($log == 1) 
			{
					echo "Total Income: <b>".$date_row["total_val"]."</b>";
			}
			echo "</table>";

			$total = $total + $date_row["total_val"];
		}

		if($log == 1) {
			echo "<hr/>";
			echo "<center> Total Income : ".$total."</center>";
		}
		
		mysqli_close($conn);
 ?>
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
		$total = 0.0;

		$date_sql = "SELECT SUM(expense_record.expense_value) AS total_val, expense_record.expense_date FROM expense_record, month_record WHERE expense_record.user_id=month_record.user_id AND expense_record.user_id=".$_SESSION["user_id"]." AND expense_record.expense_date BETWEEN month_record.first_date AND month_record.last_date GROUP BY expense_record.expense_date";
		$date_result = mysqli_query($conn, $date_sql)or die(mysqli_error($conn));

		while($date_row = mysqli_fetch_assoc($date_result)) {
			// echo "<h1>".$date_row["expense_date"]."</h1>";

			if(isset($_REQUEST["query"]) && strlen($_REQUEST["query"]) == 0) {
				$expense_sql = "SELECT * FROM expense_record WHERE user_id=".$_SESSION["user_id"]." AND expense_date='".$date_row["expense_date"]."'";
				$log = 1;
			} else {
				$expense_sql = "SELECT * FROM expense_record WHERE expense LIKE '%".$_REQUEST["query"]."%' AND user_id=".$_SESSION["user_id"]." AND expense_date='".$date_row["expense_date"]."'";
				$log = 2;
			}

			$expense_result = mysqli_query($conn, $expense_sql)or die(mysqli_error($conn));

			if(mysqli_num_rows($expense_result) > 0) {
			echo "<h1>".$date_row["expense_date"]."</h1>";
			echo "<table style='border: 1px solid black; border-collapse: collapse;'>";
			echo "<tr style='border: 1px solid black;'>";
				echo "<th>Expense</th>";
				echo "<th>Expense details</th>";
				echo "<th>Expense value</th>";
			echo "</tr>";
			
				while($expense_row = mysqli_fetch_assoc($expense_result)) {
					if($log == 2) { 
						echo "<tr style='border: 1px solid black; background-color:rgb(250,250,210)'>";
					}
					else {
						echo "<tr style='border: 1px solid black;'>";
					}
					echo "<td>".$expense_row["expense"]."</td>";
					if($expense_row["expense_desc"] != null) { 
						echo "<td>".$expense_row["expense_desc"]."</td>";
					}
					else {
						echo "<td><i>No description</i></td>";
					}
					echo "<td>".$expense_row["expense_value"]."</td>";
					echo "</tr>";
				}

				echo "<hr/>";
			}
			
			if($log == 1) 
			{
					echo "Total expense: <b>".$date_row["total_val"]."</b>";
			}
			echo "</table>";

			$total = $total + $date_row["total_val"];
		}

		if($log == 1) {
			echo "<hr/>";
			echo "<center>Total Expense : ".$total."</center>";
		}
		mysqli_close($conn);
 ?>
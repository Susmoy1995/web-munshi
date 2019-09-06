
<?php 
	session_start();
	require './vendor/autoload.php';

	$mpdf = new \Mpdf\Mpdf();

	$conn = mysqli_connect("localhost", "root", "", "project");
	if(!$conn) {
		die("Connection failed: ".mysqli_connect_error());
	}

	$total = 0;
	$data = "";

	$data .= "<h1 align='center'>".$_SESSION["username"]."'s Expense Record</h1>";

	$date_sql = "SELECT SUM(expense_record.expense_value) AS total_val, expense_record.expense_date FROM expense_record, month_record WHERE expense_record.user_id=month_record.user_id AND expense_record.user_id=".$_SESSION["user_id"]." AND expense_record.expense_date BETWEEN month_record.first_date AND month_record.last_date GROUP BY expense_record.expense_date";

	$date_result = mysqli_query($conn, $date_sql)or die(mysqli_error($conn));

	while($date_row = mysqli_fetch_assoc($date_result)) {
		$expense_sql = "SELECT * FROM expense_record WHERE user_id=".$_SESSION["user_id"]." AND expense_date='".$date_row["expense_date"]."'";
		$expense_result = mysqli_query($conn, $expense_sql)or die(mysqli_error($conn));

		if(mysqli_num_rows($expense_result) > 0) {
			$data .= "<h2>".$date_row["expense_date"]."</h2>";
			$data .= "Total Expense: <b>".$date_row["total_val"]."</b>";

			$data .= "<table style='width: 100%; border: 1px solid black; border-collapse: collapse;'>";
			$data .= "<tr>";
				$data .= "<th style='border: 1px solid black;'>Expense</th>";
				$data .= "<th style='border: 1px solid black;'>Expense details</th>";
				$data .= "<th style='border: 1px solid black;'>Expense value</th>";
			$data .= "</tr>";

			while($expense_row = mysqli_fetch_assoc($expense_result)) {
				$data .= "<tr>";

				$data .= "<td style='border: 1px solid black; padding: 10px;'>".$expense_row["expense"]."</td>";
					if($expense_row["expense_desc"] != null) { 
						$data .= "<td style='border: 1px solid black; padding: 10px;'>".$expense_row["expense_desc"]."</td>";
					}
					else {
						$data .= "<td style='border: 1px solid black; padding: 10px;'><i>No description</i></td>";
					}
					$data .= "<td style='border: 1px solid black; padding: 10px;'>".$expense_row["expense_value"]."</td>";
				$data .= "</tr>";
			}

			// $data .= "<hr/>";
		}
		// $data .= "<hr/>";
		// $data .= "Total Income: <b>".$date_row["total_val"]."</b>";
		$data .= "</table>";

		$total = $total + $date_row["total_val"];

		$data .= "<hr/>";
		
	}

	$data .= "<p align='center'><strong> Total Expense : ".$total."</strong></p>";

	mysqli_close($conn);

	$mpdf->WriteHTML($data);
	$mpdf->Output("expense_record.pdf", "D");

	header('Location:'.$_SERVER['HTTP_REFERER']);
 ?>
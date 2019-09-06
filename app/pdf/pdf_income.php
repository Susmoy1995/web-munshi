
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

	$data .= "<h1 align='center'>".$_SESSION["username"]."'s Income Record</h1>";

	$date_sql = "SELECT SUM(income_record.income_value) AS total_val, income_record.income_date FROM income_record, month_record WHERE income_record.user_id=month_record.user_id AND income_record.user_id=".$_SESSION["user_id"]." AND income_record.income_date BETWEEN month_record.first_date AND month_record.last_date GROUP BY income_date";
	$date_result = mysqli_query($conn, $date_sql)or die(mysqli_error($conn));

	while($date_row = mysqli_fetch_assoc($date_result)) {
		$income_sql = "SELECT * FROM income_record WHERE user_id=".$_SESSION["user_id"]." AND income_date='".$date_row["income_date"]."'";
		$income_result = mysqli_query($conn, $income_sql)or die(mysqli_error($conn));

		if(mysqli_num_rows($income_result) > 0) {
			$data .= "<h2>".$date_row["income_date"]."</h2>";
			$data .= "Total Income: <b>".$date_row["total_val"]."</b>";

			$data .= "<table style='width: 100%; border: 1px solid black; border-collapse: collapse;'>";
			$data .= "<tr>";
				$data .= "<th style='border: 1px solid black;'>Income</th>";
				$data .= "<th style='border: 1px solid black;'>Income details</th>";
				$data .= "<th style='border: 1px solid black;'>Income value</th>";
			$data .= "</tr>";

			while($income_row = mysqli_fetch_assoc($income_result)) {
				$data .= "<tr>";

				$data .= "<td style='border: 1px solid black; padding: 10px;'>".$income_row["income"]."</td>";
					if($income_row["income_desc"] != null) { 
						$data .= "<td style='border: 1px solid black; padding: 10px;'>".$income_row["income_desc"]."</td>";
					}
					else {
						$data .= "<td style='border: 1px solid black; padding: 10px;'><i>No description</i></td>";
					}
					$data .= "<td style='border: 1px solid black; padding: 10px;'>".$income_row["income_value"]."</td>";
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

	$data .= "<p align='center'><strong> Total Income : ".$total."</strong></p>";

	mysqli_close($conn);

	$mpdf->WriteHTML($data);
	$mpdf->Output("income_record.pdf", "D");

	header('Location:'.$_SERVER['HTTP_REFERER']);
 ?>
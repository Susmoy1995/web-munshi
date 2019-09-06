<style type="text/css">
	table {
		border-collapse: collapse;
	}
	.heading, .animate {
		border: 1px solid black;
	}
	.animate {
		padding: 10px;
	}

</style>

<?php 
	session_start();
	$conn = mysqli_connect("localhost", "root", "", "project");
	if(!$conn) {
		die("Connection failed: ".mysqli_connect_error());
	}

	date_default_timezone_set("Asia/Dhaka");
	$date = date('Y-m-d');

	if (isset($_REQUEST["query"]) && strlen($_REQUEST["query"]) == 0) {
		
		$sql = "SELECT * FROM income_record WHERE income_date='".$date."' AND user_id=".$_SESSION["user_id"]." ORDER BY income_id DESC";
		$result = mysqli_query($conn, $sql)or die(mysqli_error($conn));

		echo "<table width='100%' align='center' style='border: 1px solid black;'>";
			echo "<tr>";
			 echo "<th class='heading'>Income</th>";
			 echo "<th class='heading'>Income Details</th>";
			 echo "<th class='heading'>Income value</th>";
			echo "</tr>";
		while($row = mysqli_fetch_assoc($result)) {
			// echo "<li>".$row["income"]." -> ".$row["income_value"]."</li>";
			echo "<tr>";
				echo "<td class='animate' align='center'>".$row["income"]."</td>";
				echo "<td class='animate' align='center'>".$row["income_desc"]."</td>";
				echo "<td class='animate' align='center'>".$row["income_value"]."</td>";
			echo "</tr>";
		}
		echo "</table>";
	} 

	elseif(isset($_REQUEST["query"]) && !empty($_REQUEST["query"])) {
		$sql = "SELECT * FROM income_record WHERE income LIKE '%".$_REQUEST["query"]."%' AND income_date='".$date."' AND user_id=".$_SESSION["user_id"]." ORDER BY income_id DESC";
		$result = mysqli_query($conn, $sql)or die(mysqli_error($conn));
		
		echo "<table width='100%' align='center' style='border: 1px solid black;'>";
			echo "<tr>";
			 echo "<th class='heading'>Income</th>";
			 echo "<th class='heading'>Income Details</th>";
			 echo "<th class='heading'>Income value</th>";
			echo "</tr>";

		if(mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				// echo "<li>".$row["income"]." -> ".$row["income_value"]."</li>";
				echo "<tr>";
				echo "<td class='animate' align='center'>".$row["income"]."</td>";
				echo "<td class='animate' align='center'>".$row["income_desc"]."</td>";
				echo "<td class='animate' align='center'>".$row["income_value"]."</td>";
			echo "</tr>";
			}

			echo "</table>";
		} else {
			echo "<p>Not found</p>";
		}
	}


	mysqli_close($conn);

 ?>
<?php
	if (isset($_POST['fhStatus'])) {
		include '../../security/connection.php';
		$fosterhomeId = $_POST['fosterhomeId'];

		$fosterStatusno = "";
		if ($_POST['fosterStatusno'] == 1) {
			$fosterStatusno = "0";
		} else {
			$fosterStatusno = "1";
		}

		$update = "UPDATE fosterhome SET fhaccStatus = '$fosterStatusno' WHERE fosterhomeId = '$fosterhomeId '";
		if (!mysqli_query($con, $update)) {
			die('Error: ' . mysqli_error($con));
		}
			$creden ="UPDATE credentials SET crendeStatus = '$fosterStatusno' WHERE credenAnyid = '$fosterhomeId' AND credenLevel = 2";
			mysqli_query($con, $creden);
			// echo "<script>";
			// echo "swal ('The data has been inserted');";
			// echo "</script>";

			echo "<script>";
			echo "alert ('Data has been Changed');";
			echo "</script>";
	}
?>
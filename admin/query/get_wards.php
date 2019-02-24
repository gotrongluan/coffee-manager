<?php
	header("Content-type: text/html; charset=utf-8");
	if (isset($_GET["dict"])) {
		$dict_name = $_GET["dict"];
		$conn = mysqli_connect("localhost", "root", "");
		mysqli_set_charset($conn, 'UTF8');
		$sql = "select Ward_name from coffee.ward where District_name = '" . $dict_name . "';";
		$wards = mysqli_query($conn, $sql);
		$selected = "selected";
		while ($ward = mysqli_fetch_assoc($wards)) {
			$ward_name = $ward["Ward_name"];
			echo "<option value = '" . $ward_name . "' " . $selected . ">" . $ward_name . "</option>";
			$selected = "";
		}
		mysqli_close($conn);
	}
	else {
		header('Location: ../404.html');
	}
?>
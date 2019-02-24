<?php
	header("Content-type: text/html; charset=utf-8");
	if (isset($_GET["dict"]) && isset($_GET["ward"])) {
		$dict_name = $_GET["dict"];
		$ward_name = $_GET["ward"];
		$conn = mysqli_connect("localhost", "root", "");
		mysqli_set_charset($conn, 'UTF8');
		$sql = "select Street_name from coffee.street where District_name = '" . $dict_name . "' and Ward_name = '" . $ward_name . "';";
		$streets = mysqli_query($conn, $sql);
		$selected = "selected";
		while ($street = mysqli_fetch_assoc($streets)) {
			$street_name = $street["Street_name"];
			echo "<option value = '" . $street_name . "' " . $selected . ">" . $street_name . "</option>";
			$selected = "";
		}
		mysqli_close($conn);
	}
	else {
		header('Location: ../404.html');
	}
?>
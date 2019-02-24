<?php
	function checkHour($hour) {
		return true;
	}
	function checkMinute($minute) {
		return true;
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$hour = $_POST["shop-hour-close"];
		$minute = $_POST["shop-minute-close"];
		$idShop = $_POST["id-shop"];
		if (checkHour($hour) && checkMinute($minute)) {
			$conn = mysqli_connect("localhost", "root", "");
			$hour = (strlen($hour) == 1) ? "0$hour" : $hour;
			$minute = (strlen($minute) == 1) ? "0$minute" : $minute;
			$sql = "update coffee.shop set Close = '" . $hour . $minute . "00" . "' where ID = " . $idShop . ";";
			mysqli_query($conn, $sql);
			mysqli_close($conn);
			header('Location: ../shop_info.php?IDSHOP=' . $idShop);
		}
		else {
			$err = "Giờ đóng cửa không hợp lệ";
			header('Location: ../shop_info?IDSHOP=' . $idShop . '&error=' . $err);
		}
	}
	else {
		header('Location: ../404.html');
	}
?>
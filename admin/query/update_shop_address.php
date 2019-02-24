<?php
	header("Content-type: text/html; charset=utf-8");
	function checkNewAddNum($addNum) {
		return true;
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$idShop = $_POST["id-shop"];
		$addNum = $_POST["add-number"];
		$dist = $_POST["shop-district"];
		$ward = $_POST["shop-ward"];
		$street = $_POST["shop-street"];
		if (checkNewAddNum($addNum)) {
			$conn = mysqli_connect("localhost", "root", "");
			mysqli_set_charset($conn, 'UTF8');
			$sql = "update coffee.shop set Add_number = " . $addNum . ", District_name = '" . $dist . "', Ward_name = '" . $ward . "', Street_name = '" . $street . "' where ID = " . $idShop . ";";
			mysqli_query($conn, $sql);
			mysqli_close($conn);
			header('Location: ../shop_info.php?IDSHOP=' . $idShop);
		}
		else {
			$err = "Địa chỉ mới không hợp lệ";
			header('Location: ../shop_info.php?IDSHOP=' . $idShop . '&error=' . $err);
		}		
	}
	else {
		header('Location: ../404.html');
	}
?>
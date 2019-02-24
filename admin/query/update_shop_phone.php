<?php
	header("Content-type: text/html; charset=utf-8");
	function checkNewPhone($phone) {
		return true;
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$new_phone = $_POST["shop-phone"];
		$id_shop = $_POST["id-shop"];
		if (checkNewPhone($new_phone)) {
			$conn = mysqli_connect("localhost", "root", "");
			mysqli_set_charset($conn, 'UTF8');
			$sql = "update coffee.shop set Phone = '" . $new_phone . "' where ID = " . $id_shop . ";";
			mysqli_query($conn, $sql);
			mysqli_close($conn);
			header('Location: ../shop_info.php?IDSHOP=' . $id_shop);
		}
		else {
			$err = "Số điện thoại lỗi";
			header('Location: ../shop_info.php?IDSHOP=' . $id_shop . '&error=' . $err);
		}
	}
	else {
		header('Location: ../404.html');
	}
?>
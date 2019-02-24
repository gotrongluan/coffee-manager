<?php
	header("Content-type: text/html; charset=utf-8");
	function checkNewName($name) {
		return true;
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$new_name = $_POST["shop-name"];
		$id_shop = $_POST["id-shop"];
		if (checkNewName($new_name)) {
			$conn = mysqli_connect("localhost", "root", "");
			mysqli_set_charset($conn, 'UTF8');
			$sql = "update coffee.shop set Shop_name = '" . $new_name . "' where ID = " . $id_shop . ";";
			mysqli_query($conn, $sql);
			mysqli_close($conn);
			header('Location: ../shop_info.php?IDSHOP=' . $id_shop);
		}
		else {
			$err = "Tên quán không hợp lệ";
			header('Location: ../shop_info.php?IDSHOP=' . $idShop . '&error=' . $err);
		}
	}
	else {
		header('Location: ../404.html');
	}
?>
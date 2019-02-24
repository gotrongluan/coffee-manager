<?php
	header("Content-type: text/html; charset=utf-8");
	function checkDesc($desc) {
		return true;
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$id_shop = $_POST["id-shop"];
		$shop_desc = htmlspecialchars($_POST["description"]);
		if (checkDesc($shop_desc)) {
			$conn = mysqli_connect("localhost", "root", "");
			mysqli_set_charset($conn, 'UTF8');
			$sql = "update coffee.shop set Description = '" . $shop_desc . "' where ID = " . $id_shop . ";";
			mysqli_query($conn, $sql);
			mysqli_close($conn);
			header('Location: ../shop_info.php?IDSHOP=' . $id_shop);
		}
		else {
			$err = "Mô tả mới không hợp lệ";
			header('Location: ../shop_info.php?IDSHOP=' . $id_shop . '&error=' . $err);
		}
	}
	else {
		header('Location: ../404.html');
	}
?>
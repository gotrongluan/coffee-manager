<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$type = $_POST["shop-type"];
		$idShop = $_POST["id-shop"];
		$conn = mysqli_connect("localhost", "root", "");
		$sql = "update coffee.shop set Type = '" . $type . "' where ID = " . $idShop . ";";
		mysqli_query($conn, $sql);
		mysqli_close($conn);
		header('Location: ../shop_info.php?IDSHOP=' . $idShop);
	}
	else {
		header('Location: ../404.html');
	}
?>
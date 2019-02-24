<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$idShop = $_POST["id-shop"];
		$img = $_POST["shop-img"];
		$conn = mysqli_connect("localhost", "root", "");
		$sql = "delete from coffee.image_shop where ID_shop = " . $idShop . " and Img_name = '" . $img . "';";
		mysqli_query($conn, $sql);
		$sql = "delete from coffee.image where Image_name = '" . $img . "';";
		mysqli_query($conn, $sql);
		mysqli_close($conn);
		unlink($img);
		header('Location: ../shop_info.php?IDSHOP=' . $idShop);
	}
?>
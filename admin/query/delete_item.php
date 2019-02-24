<?php
	if (isset($_GET["IDITEM"])) {
		$id_item = $_GET["IDITEM"];
		$conn = mysqli_connect("localhost", "root", "");
		$sql = "select avatar from coffee.item where ID_item = " . $id_item . ";";
		$ava = mysqli_fetch_assoc(mysqli_query($conn, $sql))["avatar"];
		unlink($ava);
		$sql = "delete from coffee.image where Image_name = '" . $ava . "';";
		mysqli_query($conn, $sql);
		$sql = "select Id_shop from coffee.item where ID_item = " . $id_item . ";";
		$idShop = mysqli_fetch_assoc(mysqli_query($conn, $sql))["Id_shop"];
		$sql = "delete from coffee.item where ID_item = " . $id_item . ";";
		mysqli_query($conn, $sql);
		mysqli_close($conn);
		header('Location: ../shop_info.php?IDSHOP=' . $idShop);
	}
	else {
		header('Location: ../404.html');
	}
?>
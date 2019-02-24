<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$idShop = $_POST["id-shop"];
		$dir_path = "../assets/shop_images/";
		$isValid = true;
		$file_target = basename($_FILES["new-img"]["name"]);
		$typeFile = strtolower(pathinfo($file_target, PATHINFO_EXTENSION));
		$check = getimagesize($_FILES["new-img"]["tmp_name"]);
		if (!$check)
			$isValid = false;
		if ($typeFile != "jpg" && $typeFile != "png" && $typeFile != "jpeg")
			$isValid = false;
		if ($isValid) {
			$newName = basename($_FILES["new-img"]["name"], "." . $typeFile);
			$newName .= "_" . $idShop . "_" . date("YmdGis", time());
			$newUrl = $dir_path . $newName . "." . $typeFile;
			move_uploaded_file($_FILES["new-img"]["tmp_name"], "../" . $newUrl);
			$conn = mysqli_connect("localhost", "root", "");
			$sql = "insert into coffee.image values ('" . $newUrl . "');";
			mysqli_query($conn, $sql);
			$sql = "insert into coffee.image_shop values (" . $idShop . ", '" . $newUrl . "');";
			mysqli_query($conn, $sql);
			mysqli_close($conn);
			header('Location: ../shop_info.php?IDSHOP=' . $idShop);
		}
		else {
			$err = "Ảnh không hợp lệ";
			header('Location: ../shop_info.php?IDSHOP=' . $idShop . '&error=' . $err);
		}
	}
?>
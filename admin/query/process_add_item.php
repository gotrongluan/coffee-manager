<?php
	header("Content-type: text/html; charset=utf-8");
	function checkItemName($name) {
		return true;
	}
	function checkItemPrice($price) {
		return true;
	}
	function checkItemDesc($desc) {
		return true;
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$idShop = $_POST["shop_id"];
		$itemName = $_POST["item-name"];
		$itemPrice = $_POST["item-price"];
		$itemDesc = $_POST["item-desc"];
		if (checkItemName($itemName)) {
			if (checkItemPrice($itemPrice)) {
				if (checkItemDesc($itemDesc)) {
					$dir_path = "../assets/item_images/";
					$isValid = true;
					$file_target = basename($_FILES["item-img"]["name"]);
					$typeFile = strtolower(pathinfo($file_target, PATHINFO_EXTENSION));
					$check = getimagesize($_FILES["item-img"]["tmp_name"]);
					if (!$check)
						$isValid = false;
					if ($typeFile != "jpg" && $typeFile != "png" && $typeFile != "jpeg")
						$isValid = false;
					if ($isValid) {
						$conn = mysqli_connect("localhost", "root", "");
						mysqli_set_charset($conn, 'UTF8');
						if (!$conn) {
							die("Connection failed: " . mysqli_connect_error());
						}
						$sql = "insert into coffee.item values (NULL, " . $idShop . ", " . $itemPrice . ", '" . $itemName . "', NULL, '" . $itemDesc . "');";
						mysqli_query($conn, $sql);
						$sql = "select distinct last_insert_id() as last_id from coffee.item;";
						$last_id = mysqli_fetch_assoc(mysqli_query($conn, $sql))["last_id"];
						$newName = basename($_FILES["item-img"]["name"], "." . $typeFile);
						$newName .= "_" . $last_id . "_" . date("YmdGis", time());
						$newUrl = $dir_path . $newName . "." . $typeFile;
						move_uploaded_file($_FILES["item-img"]["tmp_name"], "../" . $newUrl);
						$sql = "insert into coffee.image values ('" . $newUrl . "');";
						mysqli_query($conn, $sql);
						$sql = "update coffee.item set avatar = '" . $newUrl . "' where ID_item = " . $last_id . ";";
						mysqli_query($conn, $sql);
						mysqli_close($conn);
						header('Location: ../shop_info.php?IDSHOP=' . $idShop);
					}
					else {
						$err = "Hình ảnh lỗi";
						header('Location: ../add_item.php?id-shop=' . $idShop . '&error=' . $err);
					}
				}
				else {
					$err = "Mo ta loi";
					header('Location: ../add_item.php?id-shop=' . $idShop . '&error=' . $err);
				}
			}
			else {
				$err = "Gia loi";
				header('Location: ../add_item.php?id-shop=' . $idShop . '&error=' . $err);
			}
		}
		else {
			$err = "Name loi";
			header('Location: ../add_item.php?id-shop=' . $idShop . '&error=' . $err);
		}
	}
	else {
		header('Location: ../404/html');
	}
?>
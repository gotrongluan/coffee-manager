<?php
	header("Content-type: text/html; charset=utf-8");
	function checkName($name) {
		return true;
	}

	function checkPrice($price) {
		return true;
	}

	function checkDesc($desc) {
		return true;
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$id_item = $_POST["item-id"];
		$name = $_POST["item-name"];
		$price = $_POST["item-price"];
		$desc = $_POST["item-desc"];
		if (checkName($name)) {
			if (checkPrice($price)) {
				if (checkDesc($desc)) {
					$conn = mysqli_connect("localhost", "root", "");
					mysqli_set_charset($conn, 'UTF8');
					$sql = "update coffee.item set Item_name = '" . $name . "', Price = " . $price . ", Description = '" . $desc . "' where ID_item = " . $id_item . ";";
					mysqli_query($conn, $sql);
					$sql = "select ID_shop from coffee.item where ID_item = " . $id_item . ";";
					$idShop = mysqli_fetch_assoc(mysqli_query($conn, $sql))["ID_shop"];
					mysqli_close($conn);
					header('Location: ../shop_info.php?IDSHOP=' . $idShop);
				}
				else {
					$err = "Mô tả không hợp lệ";
					header('Location: ../edit_item.php?IDITEM=' . $id_item . "&error=" . $err);
				}
			}
			else {
				$err = "Giá cả không hợp lệ";
				header('Location: ../edit_item.php?IDITEM=' . $id_item . "&error=" . $err);
			}
		}
		else {
			$err = "Tên không hợp lệ";
			header('Location: ../edit_item.php?IDITEM=' . $id_item . "&error=" . $err);
		}
	}
	else {
		header('Location: ../404.html');
	}
?>
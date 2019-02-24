<?php
	header("Content-type: text/html; charset=utf-8");
	if (isset($_GET["ID"])) {
		$id_head = $_GET["ID"];
		$conn = mysqli_connect("localhost", "root", "");
		mysqli_set_charset($conn, 'UTF8');
		$sql = "select Head_name from coffee.headquarters where ID = " . $id_head . ";";
		$head_name = mysqli_fetch_assoc(mysqli_query($conn, $sql))["Head_name"];
		$sql = "insert into coffee.shop values (NULL, '" . $head_name . " - Chi nhánh 1', 'Một chi nhánh của $head_name', 268, 'Lý Thường Kiệt', 'Phường 14', 'Quận 10', '0358684926', '060000', '170000', 1, 0, 0, 0);";
		mysqli_query($conn, $sql);
		$sql = "select last_insert_id() as last_id from coffee.shop;";
		$last_id = mysqli_fetch_assoc(mysqli_query($conn, $sql))["last_id"];
		$sql = "insert into coffee.branch values (" . $id_head . ", " . $last_id . ");";
		mysqli_query($conn, $sql);
		mysqli_close();
		header('Location: ../shop_info.php?IDSHOP=' . $last_id);
	}
	else {
		header('Location: ../404.html');
	}
?>
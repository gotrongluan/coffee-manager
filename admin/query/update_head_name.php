<?php
	header("Content-type: text/html; charset=utf-8");
	function checknew_name($name) {
		return true;
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$new_name = $_POST["head-name"];
		$id_head = $_POST["id-head"];
		if (checknew_name($new_name)) {
			$conn = mysqli_connect("localhost", "root", "");
			mysqli_set_charset($conn, 'UTF8');
			$sql = "update coffee.headquarters set Head_name = '" . $new_name . "' where ID = " . $id_head . ";";
			mysqli_query($conn, $sql);
			mysqli_close($conn);
			header('Location: ../detail_headquarter.php?ID=' . $id_head);
		}
		else {
			$err = "Tên trụ sở không hợp lệ";
			header('Location: ../detail_headquarter.php?ID=' . $id_head . '&error=' . $err);
		}
	}
	else {
		header('Location: ../404.html');
	}
?>
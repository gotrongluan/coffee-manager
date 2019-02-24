<?php
	ini_set('session.cache_limiter','public');
	session_cache_limiter(false);
	session_start();
	header("Content-type: text/html; charset=utf-8");
	$id = $_SESSION["id"];
	$type = $_SESSION["type"];
	$conn = mysqli_connect("localhost", "root", "");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$old_pass = $_POST["old-pass"];
		$new_pass = $_POST["new-pass"];
		$new_re_pass = $_POST["new-re-pass"];
		//kiểm tra tại đây
		if (true) {
			$sql = "update coffee." . $type . " set Password = '" . $new_pass . "' where ID = " . $id . "; ";
			mysqli_query($conn, $sql);
			mysqli_close($conn);
			header('Location: ../user_profile.php');
		}
		else {
			$err = "Tạo mật khẩu lỗi";
			header('Location: ../user_profile.php?error=' . $err);
		}
	}
	else {
		die("404");
	}
?>
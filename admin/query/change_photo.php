<?php
	ini_set('session.cache_limiter','public');
	session_cache_limiter(false);
	session_start();
	$type = $_SESSION["type"];
	$username = $_SESSION["username"];
	$sub_dir_path = "us_images/";
	$id = $_SESSION["id"];
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$old_url = $_POST["old-avatar"];
		if ($type == "admin")
			$sub_dir_path = "ad_images/";
		$dir_path = "../assets/" . $sub_dir_path;
		$is_valid = true;
		$is_default = true;
		$file_target = basename($_FILES["new-avatar"]["name"]);
		$type_file = strtolower(pathinfo($file_target, PATHINFO_EXTENSION));
		$check = getimagesize($_FILES["new-avatar"]["tmp_name"]);
		if (!$check)
			$is_valid = false;
		if ($type_file != "jpg" && $type_file != "png" && $type_file != "jpeg")
			$is_valid = false;
		if ($is_valid) {
			if ($old_url != "../assets/default/hcmut.png") {
				$is_default = false;
				unlink("../" . $old_url);
			}
			$new_name = basename($_FILES["new-avatar"]["name"], "." . $type_file);
			$new_name .= "_" . $username . "_" . date("YmdGis", time());
			$new_url = $dir_path . $new_name . "." . $type_file;
			move_uploaded_file($_FILES["new-avatar"]["tmp_name"], "../" . $new_url);
			$conn = mysqli_connect("localhost", "root", "");
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			$sql = "insert into coffee.image values ('" . $new_url . "');";
			mysqli_query($conn, $sql);
			$sql = "update coffee." . $type . " set avatar = '" . $new_url . "' where ID = " . $id . ";";
			mysqli_query($conn, $sql);
			if (!$is_default) {
				$sql = "delete from coffee.image where Image_name = '" . $old_url . "';";
				mysqli_query($conn, $sql);
			}
			mysqli_close($conn);
		}
		header('Location: ../profile.php');
	}
?>
<?php
	ini_set('session.cache_limiter','public');
	session_cache_limiter(false);
	session_start();
	header("Content-type: text/html; charset=utf-8");
	function checkHeadquarterName($name) {
		$len = strlen($name);
		return $len > 4 && $len < 100;
	}
	$id_admin = $_SESSION["id"];
	$is_error = false;
	$notify = "Tạo trụ sở mới thành công";
	$last_id = "";
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$head_name = $_POST["head_name"];
		if (checkHeadquarterName($head_name)) {
			$dir_path = "../assets/in_images/";
			$isValid = true;
			$file_target = basename($_FILES["head_ava"]["name"]);
			$typeFile = strtolower(pathinfo($file_target, PATHINFO_EXTENSION));
			$check = getimagesize($_FILES["head_ava"]["tmp_name"]);
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
				$sql = "insert into coffee.headquarters values (NULL, '" . $head_name . "', NULL, " . $id_admin . ");";
				mysqli_query($conn, $sql);
				$sql = "select distinct last_insert_id() as last_id from coffee.headquarters;";
				$last_id = mysqli_fetch_assoc(mysqli_query($conn, $sql))["last_id"];
				$newName = basename($_FILES["head_ava"]["name"], "." . $typeFile);
				$newName .= "_" . $last_id . "_" . date("YmdGis", time());
				$newUrl = $dir_path . $newName . "." . $typeFile;
				move_uploaded_file($_FILES["head_ava"]["tmp_name"], "../" . $newUrl);
				$sql = "insert into coffee.image values ('" . $newUrl . "');";
				mysqli_query($conn, $sql);
				$sql = "update coffee.headquarters set img_name = '" . $newUrl . "' where ID = " . $last_id . ";";
				mysqli_query($conn, $sql);
				mysqli_close($conn);
			}
			else {
				$is_error = true;
				$notify = "Hình ảnh không hợp lệ";
			}
		}
		else
		{
			$is_error = true;
			$notify = "Tên trụ sở không hợp lệ";
		}
		if ($is_error) {
			header('Location: ../print_notify.php?Notify=' . $notify);
		}
		else {
			header('Location: ../print_notify.php?Notify=' . $notify . '&IDHEAD=' . $last_id);
		};
	}
?>

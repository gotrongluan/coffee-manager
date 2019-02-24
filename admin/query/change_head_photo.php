<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$id_head = $_POST["id-head"];
		$old_url = $_POST["old-avatar"];
		$dir_path = "../assets/in_images/";
		$is_valid = true;
		$file_target = basename($_FILES["new-avatar"]["name"]);
		$type_file = strtolower(pathinfo($file_target, PATHINFO_EXTENSION));
		$check = getimagesize($_FILES["new-avatar"]["tmp_name"]);
		if (!$check)
			$is_valid = false;
		if ($type_file != "jpg" && $type_file != "png" && $type_file != "jpeg")
			$is_valid = false;
		if ($is_valid) {
			unlink("../" . $old_url);
			$new_name = basename($_FILES["new-avatar"]["name"], "." . $type_file);
			$new_name .= "_" . $id_head . "_" . date("YmdGis", time());
			$new_url = $dir_path . $new_name . "." . $type_file;
			move_uploaded_file($_FILES["new-avatar"]["tmp_name"], "../" . $new_url);
			$conn = mysqli_connect("localhost", "root", "");
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			$sql = "insert into coffee.image values ('" . $new_url . "');";
			mysqli_query($conn, $sql);
			$sql = "update coffee.headquarters set img_name = '" . $new_url . "' where ID = " . $id_head . ";";
			mysqli_query($conn, $sql);
			$sql = "delete from coffee.image where Image_name = '" . $old_url . "';";
			mysqli_query($conn, $sql);
			mysqli_close($conn);
		}
		header('Location: ../detail_headquarter.php?ID=' . $id_head);
	}
	else
	{
		header('Location: ../404.html');
	}
?>
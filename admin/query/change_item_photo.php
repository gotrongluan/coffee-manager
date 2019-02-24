<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$id_item = $_POST["id-item"];
		$oldUrl = $_POST["old-avatar"];
		$dir_path = "../assets/item_images/";
		$isValid = true;
		$file_target = basename($_FILES["new-avatar"]["name"]);
		$typeFile = strtolower(pathinfo($file_target, PATHINFO_EXTENSION));
		$check = getimagesize($_FILES["new-avatar"]["tmp_name"]);
		if (!$check)
			$isValid = false;
		if ($typeFile != "jpg" && $typeFile != "png" && $typeFile != "jpeg")
			$isValid = false;
		if ($isValid) {
			unlink("../" . $oldUrl);
			$newName = basename($_FILES["new-avatar"]["name"], "." . $typeFile);
			$newName .= "_" . $id_item . "_" . date("YmdGis", time());
			$newUrl = $dir_path . $newName . "." . $typeFile;
			move_uploaded_file($_FILES["new-avatar"]["tmp_name"], "../" . $newUrl);
			$conn = mysqli_connect("localhost", "root", "");
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			$sql = "insert into coffee.image values ('" . $newUrl . "');";
			mysqli_query($conn, $sql);
			$sql = "update coffee.item set avatar = '" . $newUrl . "' where ID_item = " . $id_item . ";";
			mysqli_query($conn, $sql);
			$sql = "delete from coffee.image where Image_name = '" . $oldUrl . "';";
			mysqli_query($conn, $sql);
			mysqli_close($conn);
		}
		header('Location: ../edit_item.php?IDITEM=' . $id_item);
	}
	else
	{
		header('Location: ../404.html');
	}
?>
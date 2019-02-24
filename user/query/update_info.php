<?php
	ini_set('session.cache_limiter','public');
	session_cache_limiter(false);
	session_start();
	header("Content-type: text/html; charset=utf-8");
	$id = $_SESSION["id"];
	$type = $_SESSION["type"];
	$conn = mysqli_connect("localhost", "root", "");
	mysqli_set_charset($conn, 'UTF8');
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$newUsername = $_POST["username"];
		$newPhone = $_POST["phone"];
		$newAddress = $_POST["address"];
		$newBirthday = $_POST["birthday"];
		$newEmail = $_POST["mail"];
		if (true) {
			$sql = "update coffee." . $type . " set User_name = '" . $newUsername . "', Phone = '" . $newPhone . "', Address = '" . $newAddress . "', Email = '" . $newEmail . "', Birthday = '" . $newBirthday . "' where ID = " . $id . ";";
			mysqli_query($conn, $sql);
			mysqli_close($conn);
			header('Location: ../user_profile.php');
		}
		else {
			$err = "Lỗi";
			header("Location: ../user_profile.php?error=" . $err);
		}
	}
	else {
		die("404");
	}
?>
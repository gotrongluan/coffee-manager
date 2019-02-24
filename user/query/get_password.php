<?php
	session_start();
	$id = $_SESSION["id"];
	$type = $_SESSION["type"];
	$conn = mysqli_connect("localhost", "root", "");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$sql = "select Password from coffee." . $type . " where ID = " . $id . ";";
	$result = mysqli_query($conn, $sql);
	$result = mysqli_fetch_assoc($result);
	echo $result["Password"];
	mysqli_close($conn);
?>

<?php
	ini_set('session.cache_limiter','public');
	session_cache_limiter(false);
	session_start();
	$_SESSION["error_register"] = "";
	if (!isset($_SESSION["id"]) || !isset($_SESSION["username"]) || !isset($_SESSION["type"])) {
		header('Location: ./user/my_home.php');
	}
	else if ($_SESSION["type"] == "admin") {
		header('Location: ./admin/home.php');
	}
	else {
		header('Location: ./user/my_home.php');
	}
?>
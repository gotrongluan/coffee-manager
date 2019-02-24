<?php
	ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
    session_start();
    header("Content-type: text/html; charset=utf-8");
    $id = $_SESSION["id"];
    $conn = mysqli_connect("localhost", "root", "");
    if (!$conn) {
    	die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_set_charset($conn, 'UTF8');
    if (isset($_GET["IDSHOP"])) {
    	$id_shop = $_GET["IDSHOP"];
    	$sql = "insert into coffee.save values (" . $id . ", " . $id_shop . ");";
    	mysqli_query($conn, $sql);
    	$sql = "update coffee.shop set Save = Save + 1 where ID = " . $id_shop . ";";
    	mysqli_query($conn, $sql);
    	mysqli_close($conn);
    }
    else {
    	header('Location: ./404.html');
    }
?>
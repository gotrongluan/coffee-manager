<?php
	ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
    session_start();
    header("Content-type: text/html; charset=utf-8");
    $id = $_SESSION["id"];
    if (isset($_GET["IDSHOP"])) {
    	$id_shop = $_GET["IDSHOP"];
    	$conn = mysqli_connect("localhost", "root", "");
    	mysqli_set_charset($conn, 'UTF8');
    	$sql = "delete from coffee.save where ID_shop = " . $id_shop . " and ID_user = " . $id . ";";
    	mysqli_query($conn, $sql);
    	$sql = "update from coffee.shop set Save = Save - 1 where ID = " . $id_shop . ";";
    	mysqli_query($conn, $sql);
    	mysqli_close($conn);
    	header('Location: ../save_list.php');
    }
    else {
    	header('Location: ../404.html');
    }
?>
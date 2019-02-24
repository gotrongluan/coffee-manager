<?php
	ini_set('session.cache_limiter','public');
	session_cache_limiter(false);
	session_start();
	$_SESSION["error_register"] = "";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
	<title>Trang chủ</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="../assets/logo-wall.jpg">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/my-css/home-style.css" type="text/css">
	<link rel="stylesheet" href="../css/my-css/home-responsive.css" type="text/css">
</head>
<body>
	<div id="container">
		<div id="myCarousel" class="header carousel slide" data-ride="carousel">
			<?php include '../pages/components/slideshow.php'; ?>
		</div>
		<div id="navigation">
			<?php include '../pages/components/menu.php'; ?>
		</div>
		<div id="main-content">
			<?php include '../pages/components/slogan.php'; ?>
		</div>
		<div id="footer">
			<?php include '../pages/components/footer.php'; ?>
		</div>
		<button class="btn btn-primary scroll-top" data-scroll="up" type="button">
			<i class="fa fa-chevron-up"></i>
		</button>
		<script type="text/javascript" src="../js/my-js/home-script.js"></script>
		<script type="text/javascript" src="../js/my-js/common.js"></script>
		<script type="text/javascript" src="../js/my-js/jQuery.js"></script>
	</div>
</body>
</html>
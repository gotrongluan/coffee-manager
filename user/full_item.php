<?php 
    ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
    session_start();
    header("Content-type: text/html; charset=utf-8");
    $id = $_SESSION["id"];
    $user_name = $_SESSION["username"];
    $is_login = true;
    if (isset($_GET["IDSHOP"])) {
    	$id_shop = $_GET["IDSHOP"];
    	$conn = mysqli_connect("localhost", "root", "");
    	mysqli_set_charset($conn, 'UTF8');
    }
    else {
    	header('Location: 404.html');
    }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Xem đầy đủ thức uống</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="../css/my-css/full-item-styles.css">
   <link rel="stylesheet" type="text/css" href="../css/my-css/full-item-responsive.css">
  <link rel="stylesheet" type="text/css" href="../css/my-css/common-style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body id="myPage">
<?php include './components/header.php'; ?>
<!-- Container (The Band Section) -->
<div id="band" class="container">
	<div class="row">
	<div class="col-xs-12">
		<div class="white-box">
			<div id="information">
				<div id="avatars" class="col-md-5 col-xs-12">
					<?php
 						$sql = "select Img_name from coffee.image_shop where ID_shop = " . $id_shop . " limit 1";
 						$photo = mysqli_fetch_assoc(mysqli_query($conn, $sql))["Img_name"];
 						echo '<img src="' . $photo . '" alt="shop-photo" width="100%">';
 					?>
				</div>
				<?php
					$sql = "select * from coffee.shop where ID = " . $id_shop . ";";
					$shop = mysqli_fetch_assoc(mysqli_query($conn, $sql));
					$add_number = $shop["Add_number"];
					$street = $shop["Street_name"];
					$ward = $shop["Ward_name"];
					$district = $shop["District_name"];
					$address = "$add_number $street, $ward, $district"; 
				?>
				<div class="col-md-7 col-xs-12">
				<div id="title-name"><?php echo $shop["Shop_name"]; ?></div>
				<div id="address">
					<i class="fa fa-arrow-circle-o-right"></i>
					<?php echo $address; ?>
				</div>
				<div id="time">
					<i class="fa fa-clock-o"></i>
					Giờ mở cửa: <b><?php echo substr($shop["Open"], 0, 5) . " - " . substr($shop["Close"], 0, 5); ?></b>
				</div>
				<div id="descript">
					<i class="fa fa-slack"></i>
					<?php echo $shop["Description"]; ?>
				</div>
				<?php
					$sql = "select MIN(Price) as min_price, MAX(Price) as max_price from coffee.item where ID_shop = " . $id_shop . ";";
					$result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
					$min_price = $result["min_price"];
					$max_price = $result["max_price"];

				?>
				<div id="price">
					<i class="fa fa-credit-card"></i>
					<b><?php echo $min_price . "đ - " . $max_price . "đ"; ?></b>
				</div>
			</div>
			<div class="clearboth"></div>
			</div>
			<div id="drinks" class="col-xs-12" style="margin-top:40px">
				<div class="header-content">
					<div class="header-content-title">Thức uống</div>
				</div>
				<div class="main-drinks">
					<?php
						$sql = "select * from coffee.item where ID_shop = " . $id_shop . ";";
						$res = mysqli_query($conn, $sql);
						$i = 0;
						while ($item = mysqli_fetch_assoc($res)) {
							echo '<div class="col-md-6 col-xs-12 main-item">';
							echo '<div class="col-md-9" style="padding:0">';
							echo '<div class="media">';
							echo '<div class="media-left">';
  							echo '<img class="media-object" style="width:75px" src="' . $item["avatar"] . '" alt="Item image">';
  							echo '</div>';
  							echo '<div class="media-body">';
    						echo '<p class="media-heading item-name">' . $item["Item_name"] . '</p>';
    						echo '<p class="item-desc">' . $item["Description"] . '</p>';
  							echo '</div>';
							echo '</div>';
							echo '</div>';
							echo '<div class="col-md-3">';
							echo '<span class="price-1">' . $item["Price"] . '</span><span style="font-size:10px;">đ</span>';
							echo '</div>';
							echo '</div>';
							$i += 1;
						}
					?>
					<div class="clearboth"></div>
				</div>
			</div>
			<div class="clearboth"></div>
		</div>
	</div>
</div>
</div>
<?php include './components/footer.php'; ?>
<button class="btn btn-primary scroll-top" data-scroll="up" type="button">
	<i class="fa fa-chevron-up"></i>
</button>
<script type="text/javascript" src="../js/my-js/jQuery.js"></script>
</body>
</html>
<?php mysqli_close($conn); ?>
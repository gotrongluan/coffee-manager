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
  <title>Chi tiết quán cà phê</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="../css/my-css/detail-shop-styles.css">
  <link rel="stylesheet" type="text/css" href="../css/my-css/detail-shop-responsive.css">
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
	<div class="modal fade" id="zoomModal" tabindex="-1" role="dialog" aria-labelledby="zoomModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title" id="zoomabel" style="font-size:20px">Phóng to</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="image-view">
                        <img id="modal-img" width="100%" alt="zoom-img" src="#">      
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
	<div class="row">
	<div class="col-md-9 col-xs-12 baby" style="margin-bottom: 20px;">
		<div class="white-box">
			<div id="information">
				<div id="avatars">
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
    						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    						<li data-target="#myCarousel" data-slide-to="1"></li>
    						<li data-target="#myCarousel" data-slide-to="2"></li>
 						</ol>
 						<div class="carousel-inner">
 							<?php
 								$sql = "select Img_name from coffee.image_shop where ID_shop = " . $id_shop . " limit 3";
 								$photos = mysqli_query($conn, $sql);
 								$active = "active";
 								while ($photo = mysqli_fetch_assoc($photos)) {
 									$src = $photo["Img_name"];
 									echo '<div class="item ' . $active . '">';
 									echo '<img src="' . $src . '" alt="Coffee-image">';
 									echo '</div>';
 									$active = "";
 								}
 							?>
  						</div>
  						<a class="left carousel-control" href="#myCarousel" data-slide="prev">
    						<span class="glyphicon glyphicon-chevron-left"></span>
    						<span class="sr-only">Previous</span>
  						</a>
  						<a class="right carousel-control" href="#myCarousel" data-slide="next">
    						<span class="glyphicon glyphicon-chevron-right"></span>
    						<span class="sr-only">Next</span>
  						</a>
  					</div>
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
			<div id="drinks">
				<div class="header-content">
					<div class="header-content-title">Thức uống</div>
				</div>
				<div class="main-drinks">
					<?php
						$sql = "select * from coffee.item where ID_shop = " . $id_shop . ";";
						$res = mysqli_query($conn, $sql);
						$i = 0;
						$overflow = false;
						while ($item = mysqli_fetch_assoc($res)) {
							echo '<div class="col-md-6 col-xs-12 main-item">';
							echo '<div class="col-md-9" style="padding:0">';
							echo '<div class="media">';
							echo '<div class="media-left">';
  							echo '<img class="media-object" style="width:65px" src="' . $item["avatar"] . '" alt="Item image">';
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
							if ($i == 2) {
								$overflow = true;
								break;
							}
						}
						if ($overflow) {
							echo '<div class="add-item">';
							echo '<input type="button" onclick="fullItem(' . $id_shop . ')" value="Xem thêm thức uống">';
							echo '</div>';
						}
					?>
					<div class="clearboth"></div>
				</div>
			</div>

			<div id="imgs">
				<div class="header-content">
					<div class="header-content-title">Một số hình ảnh</div>
				</div>
				<div id="main-grid">
					<?php
						$i = 0;
						$overflow = false;
						$sql = "select Img_name from coffee.image_shop where ID_shop = " . $id_shop;
						$imgs = mysqli_query($conn, $sql);
						while ($img = mysqli_fetch_assoc($imgs)) {
							echo '<div class="col-img" onclick="zoom(' . $i . ')">';
							echo '<img class="love-img" src="' . $img["Img_name"] . '" alt="shop-img" width="100%">';
							echo '</div>';
							$i += 1;
							if ($i == 6) {
								$overflow = true;
								break;
							}
						}
						
					?>											
					<div class="clearboth"></div>
				</div>
				<?php
					if ($overflow) {
						echo '<div class="add-item">';
						echo '<input type="button" onclick="fullImage(' . $id_shop . ')" value="Xem thêm hình ảnh">';
						echo '</div>';
					}
				?>
			</div>
			<div class="clearboth"></div>
		</div>
	</div>
	<div class="col-md-3 col-xs-12 side-bar-de" style="background-color:#fff;padding-top:20px">
		<div id="like">
			<p class="x-p-p">Thích cửa hàng này?</p>
				<div id="the-like">
					<i id="lk" class="fa fa-heart" onclick="likeThis()"></i>
				</div>
		</div>
				<hr class="hr1">
				<div id="eval">
					<p class="x-p-p">Đánh giá</p>
					<div id="stars">
						<span id="star-0" class="fa fa-star" onclick="checkedStar(0)"></span>
						<span id="star-1" class="fa fa-star" onclick="checkedStar(1)"></span>
						<span id="star-2" class="fa fa-star" onclick="checkedStar(2)"></span>
						<span id="star-3" class="fa fa-star" onclick="checkedStar(3)"></span>
						<span id="star-4" class="fa fa-star" onclick="checkedStar(4)"></span>
					</div>
					<div id="otr"></div>
				</div>
				<hr class="hr1">					
		</div>
	</div>
</div>
<?php include './components/footer.php'; ?>
<button class="btn btn-primary scroll-top" data-scroll="up" type="button">
	<i class="fa fa-chevron-up"></i>
</button>
<script type="text/javascript" src="../js/my-js/detail-script.js"></script>
		<script type="text/javascript" src="../js/my-js/common.js"></script>
		<script type="text/javascript" src="../js/my-js/jQuery.js"></script>
<script type="text/javascript">
	function zoom(index) {
		var src = document.getElementsByClassName("love-img")[index].src;
		document.getElementById("modal-img").src = src;
		$("#zoomModal").modal();
	}
	function fullItem(idShop) {
		window.location.href = "./full_item.php?IDSHOP=" + idShop;
	}
	function fullImage(idShop) {
		window.location.href = "./full_image.php?IDSHOP=" + idShop;
	}
</script>
</body>
</html>
<?php mysqli_close($conn); ?>
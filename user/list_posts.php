<?php 
    ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
    session_start();
    header("Content-type: text/html; charset=utf-8");
    $id = $_SESSION["id"];
    $user_name = $_SESSION["username"];
    $is_login = true;
    $conn = mysqli_connect("localhost", "root", "");
    mysqli_set_charset($conn, 'UTF8');
    $sql = "select * from coffee.shop";
    if (!isset($_GET["filter-district-all"]) && !isset($_GET["filter-type-all"])) {
    	$districts = isset($_GET["filter-district"]) ? $_GET["filter-district"] : array();
    	$types = isset($_GET["filter-type"]) ? $_GET["filter-type"] : array();
    	$sql .= " where ";
    	if (is_array($districts) || is_object($districts)) {
    		foreach ($districts as $district) {
    			$cond = " District_name = '" . $district . "' or";
    			$sql .= $cond;
    		}
    	}
    	if (is_array($types) || is_object($types)) {
    		foreach ($types as $type) {
    			$cond = " Type = " . $type . " or";
    		}
    	}
    	$sql_pre = $sql . " 0 = 1 ";
    	$sql .= " 0 = 1 order by ID desc;";
    }
    else {
    	$sql_pre = "select * from coffee.shop ";
    }
    $shops = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Kết quả tìm kiếm</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="../css/my-css/list-posts-styles.css">
  <link rel="stylesheet" type="text/css" href="../css/my-css/common-style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body id="myPage">
<?php include './components/header.php'; ?>
<!-- Container (The Band Section) -->
<div id="band" class="container">
	<!-- <nav class="title" aria-label="breadcrumb">
		<ol class="breadcrumb">
    		<li class="breadcrumb-item active" aria-current="page">Kết quả tìm kiếm</li>
  		</ol>
	</nav> -->
	<div id="my-alert" class="alert alert-success alert-dismissible fade in" style="display:none">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Thành công!</strong> Hệ thống xác nhận bạn vừa lưu một quán cà phê.
	</div>
	<p id="query" hidden><?php echo $sql_pre; ?></p>
	<div class="dropdown" style="margin-bottom: 20px;">
  		<button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">Sắp xếp theo
  		<span class="caret"></span></button>
  		<ul class="dropdown-menu">
    		<li><a role="button" onclick="newFirst()">Mới nhất trước</a></li>
    		<li><a role="button" onclick="starFirst()">Nhiều sao nhất</a></li>
    		<li><a role="button" onclick="scoreFirst()">Nhiều điểm nhất</a></li>
    		<li><a role="button" onclick="saveFirst()">Nhiều lượt lưu nhất</a></li>
  		</ul>
	</div>
  	<div class="row" id="main-div">
    	<?php
    		while ($shop = mysqli_fetch_assoc($shops)) {
    			$address = $shop["Add_number"] . " " . $shop["Street_name"] . ", " . $shop["Ward_name"] . ", " . $shop["District_name"];
    			$photo = "../assets/x2.jpg";
    			$sql = "select count(*) as num_cmt from coffee.comment_action where ID_shop = " . $shop["ID"];
    			$num_cmt = mysqli_fetch_assoc(mysqli_query($conn, $sql))["num_cmt"];
    			$sql = "select * from coffee.image_shop where ID_shop = " . $shop["ID"];
    			$result = mysqli_query($conn, $sql);
    			if (mysqli_num_rows($result) > 0) {
    				$photo = mysqli_fetch_assoc($result)["Img_name"];
    			}
    			echo '<div class="col-md-3 col-sm-6 col-xs-12" style="padding-right:0">';
    			echo '<div class="main-item">';
    			echo '<div class="avatar">';
    			echo '<a href="detail_shop.php?IDSHOP=' . $shop["ID"] . '"><img src="' . $photo . '" alt="avatar image" width="100%"></a>';
    			echo '</div>';
    			echo '<div class="info-shop">';
				echo '<div class="name-coffee-shop"><b>' . $shop["Shop_name"] . '</b></div>';
				echo '<div class="address-coffee-shop">' . $address . '</div>';
				echo '<hr class="otr">';
				echo '<div class="desc-coffee-shop"><b>Mô tả: </b>' . $shop["Description"] . '</div>';
				echo '<hr class="otr">';
				echo '<div class="count-like">';
				echo '<span><i class="fa fa-comments" style="font-size:13px;color:blue;"></i> ' . $num_cmt . '</span>&nbsp;';
				echo '<span><i class="fa fa-star" style="font-size:13px;color:orange;"></i> ' . $shop["Star"] . '</span>';
				$sql = "select count(*) as count from coffee.save where ID_user = " . $id . " and ID_shop = " . $shop["ID"] . ";";
				$count = mysqli_fetch_assoc(mysqli_query($conn, $sql))["count"];
				if ($count == "0" || $count == 0) {
					echo '<button id="save-' . $shop["ID"] . '" type="button" class="btn btn-info btn-xs" style="float:right" onclick="saveShop(' . $shop["ID"] . ')"><i class="fa fa-bookmark" style="font-size:13px;"></i> Lưu</button>';
				}
				echo '</div>';
				echo '</div>';
    			echo '</div>';
    			echo '</div>';
    		}
    	?>
  	</div>
</div>
<?php include './components/footer.php'; ?>
<script src="../js/my-js/sort.js"></script>
<script type="text/javascript">
	function saveShop(shopId) {
		var xhttp = new XMLHttpRequest();
    	xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
				document.getElementById("my-alert").style.display = "block";
				document.getElementById("save-" + shopId).style.display = "none";
			}
		};
		xhttp.open("GET", "./query/set_save.php?IDSHOP=" + shopId, true);
		xhttp.send();
	}
</script>
</body>
</html>
<?php mysqli_close($conn); ?>
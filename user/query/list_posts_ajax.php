<?php
    ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
    session_start();
    $id = $_SESSION["id"];
	header("Content-type: text/html; charset=utf-8");
	$conn = mysqli_connect("localhost", "root", "");
    mysqli_set_charset($conn, 'UTF8');
    if (isset($_GET["query"]) && isset($_GET["first"])) {
    	$query = $_GET["query"];
    	$first = $_GET["first"];
    	$sql = $query . "order by " . $first . " desc;";
    	$shops = mysqli_query($conn, $sql);
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
    		echo '<div class="col-md-3 col-sm-8 col-xs-12" style="padding-right:0">';
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
    }
    else {
    	header('Location: ../404.html');
    }
?>
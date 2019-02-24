<?php
	header("Content-type: text/html; charset=utf-8");
	if (isset($_GET["IDITEM"])) {
		$id_item = $_GET["IDITEM"];
		$conn = mysqli_connect("localhost", "root", "");
		mysqli_set_charset($conn, 'UTF8');
		$sql = "select * from coffee.item where ID_item = " . $id_item . ";";
		$item = mysqli_fetch_assoc(mysqli_query($conn, $sql));
		$item_name = $item["Item_name"];
		$item_price = $item["Price"];
		$item_img = $item["avatar"];
		$item_desc = $item["Description"];
		echo '<div class="white-box">';
		echo '<form class="form-horizontal form-material">';
		echo '<div class="form-group">';
		echo '<div class="col-md-12">';
		echo "<img src='" . $item_img . "' alt='item-ava' style='width:100%;'>";
		echo '</div>';
		echo '</div>';
		echo '<div class="form-group">';
		echo '<label class="col-md-12">Tên món</label>';
		echo '<div class="col-md-12">';
		echo '<input type="text" value="' . $item_name . '" class="form-control form-control-line" readonly>';
		echo '</div>';
		echo '</div>';
		echo '<div class="form-group">';
		echo '<label class="col-md-12">Giá cả</label>';
		echo '<div class="col-md-12">';
		echo '<input type="text" value="' . $item_price . '" class="form-control form-control-line" readonly>';
		echo '</div>';
		echo '</div>';
		echo '<div class="form-group">';
		echo '<label class="col-md-12">Mô tả</label>';
		echo '<div class="col-md-12">';
		echo '<span class="form-control form-control-line">';
		echo $item_desc;
		echo '</span>';
		echo '</div>';
		echo '</div>';
		echo '</form>';
		echo '</div>';
		mysqli_close($conn);
 	}
	else {
		header('Location: ../404.html');
	}
?>
<?php
	ini_set('session.cache_limiter','public');
	session_cache_limiter(false);
	session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
	<title>Đăng ký tài khoản</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../css/my-css/register-styles.css" type="text/css">
	<link rel="stylesheet" href="../css/my-css/register-responsives.css" type="text/css">
	<link rel="icon" href="../assets/logo-wall.jpg">
</head>
<body>
<?php
	$isError = false;
	$error = "";
	include './check_register.php';
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = $_POST["username"];
		$password = $_POST["password"];
		$re_password = $_POST["re-password"];
		$phone = $_POST["phonenumber"];
		$address = $_POST["address"];
		$birthday = $_POST["birthday"];
		$email = $_POST["email"];
		$avatar_url = "";
		$isDefault = false;
		$isError = checkRegister($username, $password, $re_password, $phone, $address, $birthday, $email, $error);
		if (!$isError) {
			$dir_path = "../assets/us_images/";
			$file_target = basename($_FILES["avatar"]["name"]);
			if ($file_target == "") {
				$isDefault = true;
				$avatar_url = "../assets/default/hcmut.png";
			}
			else {
				$typeFile = strtolower(pathinfo($file_target, PATHINFO_EXTENSION));
				$check = getimagesize($_FILES["avatar"]["tmp_name"]);
				if (!$check) {
					$isError = true;
					$error = "Fake image file";
				}
				else {
					if ($typeFile != "jpg" && $typeFile != "png" && $typeFile != "jpeg") {
						$isError = true;
						$error = "Invalid image type";
					}
					else {
						//$typeFile = "jpg", $file_target
						$nameFile = basename($_FILES["avatar"]["name"], "." . $typeFile);
						$nameFile .= "_" . $username. "_" . date("YmdGis", time());
						$avatar_url = $dir_path . $nameFile . "." . $typeFile;
						move_uploaded_file($_FILES["avatar"]["tmp_name"], $avatar_url);
					}
				}
			}
			if (!$isError) {
				$conn = mysqli_connect("localhost", "root", "");
				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}
				if (!$isDefault) {
					$sql = "insert into coffee.image values ('" . $avatar_url . "');";
					mysqli_query($conn, $sql);
				}
				$sql = "insert into coffee.user values (NULL, '" . $username . "', '" . $password . "', '" . $phone . "', '" . $address . "', '" . $birthday . "', '" . $email . "', '" . $avatar_url . "');";
				mysqli_query($conn, $sql);
				mysqli_close($conn);
				$_SESSION["error_register"] = "";
				header('Location: login.php');
			}
		}
		if ($isError){
			$_SESSION["error_register"] = $error;
			header('Location: register.php');
		}
	}
	if (!isset($_SESSION["error_register"]))
		$error = "";
	else
		$error = $_SESSION["error_register"];
?>
	<div class="display-table">
	<div class="container display-table-cell">
		<div class="head-main"></div>
		<div class="main-register">
			<div class="logo-register">
				<div>
					<img src="..\assets\logo-wall.jpg" alt="logo-image">
				</div>
			</div>
			<div class="register">
				<form id="register-form" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<div id="error-notify"><?php echo $error; ?></div>
					<div class="column column-1">
						<div class="title-register">Tài khoản</div>
						<div class="main-input">
							<span class="i-container"><i class="material-icons">account_circle</i></span>
							<input type="text" placeholder="Tên tài khoản" name="username" required="required">
						</div>
						<div class="main-input">
							<span class="i-container"><i class="material-icons">lock_open</i></span>
							<input type="password" placeholder="Mật khẩu" name="password" required="required">
						</div>
						<div class="main-input">
							<span class="i-container"><i class="material-icons">lock</i></span>
							<input type="password" placeholder="Nhập lại mật khẩu" name="re-password" required="required">
						</div>
						<div class="next"><button type="button" onclick="next(0)" name="next-btn-1">Tiếp &rarr;</button></div>
					</div>
					<div class="column column-2">
						<div class="title-register">Thông tin cá nhân</div>
						<div class="main-input photo_submit-container">
							<!-- <label class="photo_submit js-photo_submit4">
            					<input class="photo_submit-input js-photo_submit-input" type="file" accept="image/*" name="avatar">
            					<span class="photo_submit-plus"></span>
            					<span class="photo_submit-uploadLabel">Ảnh đại diện</span>
            					<span class="photo_submit-delete"></span>
        					</label> -->
        					<input type="file" accept="image/*" name="avatar">
						</div>
						<div class="main-input">
							<span class="i-container"><i class="material-icons">cake</i></span>
							<input type="date" name="birthday" required="required" value="<?php echo date("Y-m-d"); ?>">
						</div>
						<div class="main-input">
							<span class="i-container"><i class="material-icons">home</i></span>
							<input type="text" placeholder="Địa chỉ" name="address" required="required">
						</div>
						<div class="back"><button type="button" onclick="back(1)" name="back-btn-1">&larr; Trở lại</button></div>
						<div class="next"><button type="button" onclick="next(1)" name="next-btn-2">Tiếp &rarr;</button></div>
					</div>
					<div class="column column-3">
						<div class="title-register">Thông tin liên lạc</div>
						<div class="main-input">
							<span class="i-container"><i class="material-icons">email</i></span>
							<input type="email" placeholder="Email" name="email" required="required">
						</div>
						<div class="main-input">
							<span class="i-container"><i class="material-icons">local_phone</i></span>
							<input type="text" placeholder="Số điện thoại" name="phonenumber" required="required">
						</div>
						<div class="back"><button type="button" onclick="back(2)" name="back-btn-2">&larr; Trở lại</button></div>
						<div class="finish"><button type="button" name="res-btn" onclick="checkAndSubmit()">Hoàn tất</button></div>
					</div>
					<div class="clearboth"></div>
				</form>
			</div>
		</div>
		<div class="foot-main">
			<p style="margin:0"><a href="./login.php">Quay lại trang đăng nhập</a></p>
		</div>
		<script type="text/javascript" src="../js/my-js/register-script-1.js"></script>
		<script type="text/javascript" src="../js/my-js/register-script-2.js"></script>
	</div>
</div>
</body>
</html>
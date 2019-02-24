<?php
	ini_set('session.cache_limiter','public');
	session_cache_limiter(false);
	session_start();
	session_destroy();
	session_start();
	$_SESSION["error_register"] = "";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
	<title>Đăng nhập</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../css/my-css/login-styles.css" type="text/css">
	<link rel="stylesheet" href="../css/my-css/login-responsives.css" type="text/css">
	<link rel="icon" href="../assets/logo-wall.jpg">
	<style>
		.foot-main {
  			position: relative;
		}
		p {
  			text-align: center;
  			position: absolute;
  			top: 35%;
  			width: 100%;
		}
	</style>
</head>
<body>
<div class="display-table">
	<div class="container display-table-cell">
		<div class="head-main"></div>
		<div class="main-login">
			<div class="logo-login">
				<div>
					<img src="..\assets\logo-wall.jpg" alt="logo-image">
				</div>
			</div>
			<div class="login">
				<?php
					function checkLogin($conn, $type, $username, $password) {
						$sql = "select User_name, password, ID from coffee." . $type . ";";
						$result = mysqli_query($conn, $sql);
						$failed = true;
						if (mysqli_num_rows($result) > 0) {
							while ($user = mysqli_fetch_assoc($result)) {
								$usn = $user["User_name"];
								$pw = $user["password"];
								if ($username == $usn && $password == $pw) {
									$failed = false;
									break;
								}
							}
						}
						if (!$failed) {
							$_SESSION["type"] = $type;
							$_SESSION["id"] = $user["ID"];
							$_SESSION["username"] = $username;
							mysqli_close($conn);
							header('Location: ../index.php');
						}
					}

					$err = "";
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						$username = $_POST["username"];
						$password = $_POST["password"];
						$conn = mysqli_connect("localhost", "root", "");
						if (!$conn) {
							die("Connection failed: " . mysqli_connect_error());
						}
						checkLogin($conn, "admin", $username, $password);
						checkLogin($conn, "user", $username, $password);
						$err = "<i class='fas fa-car-crash'></i> Tên đăng nhập hoặc mật khẩu sai";
					}
				?>
				
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<div class="notify">
						<?php echo $err; ?>
					</div>
					<div class="main-input username-container">
						<span class="i-container"><i class="fas fa-user"></i></span>
						<input type="text" placeholder="Tên tài khoản" name="username">
					</div>
					<div class="main-input password-container">
						<span class="i-container"><i class="fab fa-modx"></i></span>
						<input type="password" placeholder="Mật khẩu" name="password">
					</div>
					<div class="exception">
						<div class="sub-exp">
							<a id="forgot" href=""><b>Quên mật khẩu?</b></a>
						</div>
					</div>
					<div class="button-container">
						<input type="submit" name="submit" value="Đăng nhập">
					</div>
				</form>
			</div>
			<div class="to-register">
				<div>
					<span>Không có tài khoản? <b><a href="./register.php">Đăng ký</a></b></span>
				</div>
			</div>
		</div>
		<div class="foot-main">
			<p style="margin:0"><a style="color: #fff;font-weight: bold;font-size: 12px;text-decoration: none;" href="../index.php">Quay lại trang chủ</a></p>
		</div>
	</div>
</div>
</body>
</html>
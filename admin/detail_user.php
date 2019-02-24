<?php
	ini_set('session.cache_limiter','public');
	session_cache_limiter(false);
	session_start();
	$id = $_SESSION["id"];
    $admin_name = $_SESSION["username"];
    $conn = mysqli_connect("localhost", "root", "");
    mysqli_set_charset($conn, 'UTF8');
    $sql = "select * from coffee.admin where ID = $id";
    $admin = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    $admin_avatar = $admin["avatar"];
	header("Content-type: text/html; charset=utf-8");
	if (isset($_GET["ID"]) && isset($_GET["type"])) {
		$id_user = $_GET["ID"];
		$type = $_GET["type"];
		$table = ($type == "0") ? "admin" : "user";
		$conn = mysqli_connect("localhost", "root", "");
		mysqli_set_charset($conn, 'UTF8');
		if (!$conn) {
			die('Connection failed: ' . mysqli_connect_error());
		}
		$sql = "select * from coffee.". $table . " where ID = $id_user";
		$user = mysqli_fetch_assoc(mysqli_query($conn, $sql));
		$user_name = $user["User_name"];
        $phone = $user["Phone"];
        $address = $user["Address"];
        $birthday = $user["Birthday"];
        $email = $user["Email"];
        $avatar = $user["avatar"];
	}
	else {
		header('Location: 404.html');
	}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/logo-wall.jpg">
    <title>Chi tiết người dùng</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/default.css" id="theme" rel="stylesheet">
</head>

<body class="fix-header">
    <?php include './pages/components/preload.php'; ?>
    <div id="wrapper">
        <?php include './pages/components/header.php'; ?>
        <?php include './pages/components/left_sidebar.php';?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Chi tiết người dùng</h4> </div>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  					<div class="modal-dialog" role="document">
    					<div class="modal-content">
      						<div class="modal-header">
        						<span class="modal-title" id="exampleModalLabel" style="font-size:20px">Xác nhận xóa</span>
        						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          							<span aria-hidden="true">&times;</span>
        						</button>
     						</div>
      						<div class="modal-body">
        						<h5>Bạn có chắc chắn muốn xóa tài khoản này không?</h5>
      						</div>
      						<div class="modal-footer">
        						<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        						<button type="button" class="btn btn-primary" onclick="accept()">Xóa ngay</button>
      						</div>
    					</div>
  					</div>
				</div>
                <div class="row">
                    <div class="col-md-4 col-xs-12">    
                        <div class="white-box">
                            <div class="user-bg"> <img width="100%" alt="user" src="<?php echo $avatar; ?>">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <a href="javascript:void(0)"><img src="<?php echo $avatar; ?>" class="thumb-lg img-circle" alt="img"></a>
                                        <h4 class="text-white"><?php echo $user_name; ?></h4>
                                        <h5 class="text-white"><?php echo $email; ?></h5> </div>
                                </div>
                            </div>
                            <div class="user-btm-box" style="height:20px;"></div>
                        </div>         
                    </div>
                    
                    <div class="col-md-8 col-xs-12">
                        <div class="white-box">
                            <form id="form-1" class="form-horizontal form-material" action="./query/delete_user.php" method="post">
                            	<input type="hidden" name="user-id" value="<?php echo $id_user; ?>">
                            	<input type="hidden" name="user-type" value="<?php echo $type; ?>">
                                <div class="form-group">
                                    <label class="col-md-12">Tên tài khoản</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control form-control-line" name="username" value="<?php echo $user_name; ?>" readonly> </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-mail" class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" class="form-control form-control-line" name="mail" id="example-email" value="<?php echo $email; ?>" readonly> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Số điện thoại</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control form-control-line" name="phone" value="<?php echo $phone; ?>" readonly> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Địa chỉ</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control form-control-line" name="address" value="<?php echo $address; ?>" readonly> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Ngày sinh</label>
                                    <div class="col-md-12">
                                        <input type="date" id="date-picker-example" class="form-control form-control-line" value="<?php echo $birthday; ?>" name="birthday" readonly></div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-warning btn-primary" data-toggle="modal" data-target="#exampleModal" type="button">Xóa tài khoản</button>
                                        <button class="btn btn-success" type="button" onclick="back()">Quay lại</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2018 &copy; Coffee Lookup brought to you by Trong Luan </footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <script type="text/javascript">
    	function back() {
    		window.location.href = "./manage_user.php";
    	}
    	function accept() {
    		document.getElementById("form-1").submit();
    	}
    </script>
</body>
</html>
<?php mysqli_close($conn); ?>
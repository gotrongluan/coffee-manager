<?php
    ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
    session_start();
    header("Content-type: text/html; charset=utf-8");
    $id = $_SESSION["id"];
    $admin_name = $_SESSION["username"];
    $conn = mysqli_connect("localhost", "root", "");
    mysqli_set_charset($conn, 'UTF8');
    $sql = "select * from coffee.admin where ID = $id";
    $admin = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    $admin_avatar = $admin["avatar"];
    $admin_name = $admin["User_name"];
    mysqli_close($conn);
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
    <title>Xóa tài khoản</title>
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
                        <h4 class="page-title">Xóa tài khoản</h4> </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="white-box">
                            <p class="text-justify">Này <b><?php echo $admin_name; ?></b>, bạn có chắc chắn muốn xóa tài khoản?</p>
                            <button class="btn btn-warning" type="button">Xóa ngay</button>
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
</body>

</html>

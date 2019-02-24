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
    $err = "";
    if (isset($_GET["ID_HEAD"])) {
        $id_head = $_GET["ID_HEAD"];
        header('Location: detail_headquarter.php?ID=' . $id_head);
        exit();
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
    <title>Thêm trụ sở mới</title>
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
                        <h4 class="page-title">Thêm trụ sở mới</h4> </div>
                </div>
                <div class="row">
                    <form class="form-horizontal form-material" action="./query/process_add_headquarter.php" method="post" enctype="multipart/form-data">
                    <div class="col-md-4 col-xs-12">    
                        <div class="white-box">
                            
                            <div class="user-bg"> <img width="100%" alt="user" src="../assets/store 9.jpg">

                            </div>
                            <div class="user-btm-box">
                                <input type="file" accept="images/*" name="head_ava">
                            </div>
                            
                        </div>         
                    </div>
                    
                    <div class="col-md-8 col-xs-12">
                        <div class="white-box">
                                <div class="form-group">
                                    <label class="col-md-12">Tên trụ sở</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control form-control-line" name="head_name" placeholder="Cà phê Phùng"> </div>
                                </div>  
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input id="update-btn" class="btn btn-success" type="submit" value="Tạo mới">
                                        <a role="button" class="btn btn-warning" href="manage_post.php">Quay lại</a>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                    </form>
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

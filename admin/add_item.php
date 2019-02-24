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
    if (isset($_GET["id-shop"])) {
        $id_shop = $_GET["id-shop"];
        if (isset($_GET["error"]))
            $err = $_GET["error"];
    }
    else{
        header('Location: ./404.html');
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
    <title>Thêm món mới</title>
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
                        <h4 class="page-title">Thêm món mới</h4> </div>
                </div>
                <div class="row">
                    <form class="form-horizontal form-material" action="./query/process_add_item.php" method="post" enctype="multipart/form-data">
                    <div class="col-md-4 col-xs-12">    
                        <div class="white-box">
                            
                            <div class="user-bg"> <img width="100%" alt="user" src="../assets/store 7.jpg">

                            </div>
                            <div class="user-btm-box">
                                <input type="file" accept="images/*" name="item-img">
                                
                            </div>
                            
                        </div>         
                    </div>
                    
                    <div class="col-md-8 col-xs-12">
                        <div class="white-box">
                            
                                <input type="hidden" name="shop_id" value="<?php echo $id_shop; ?>"> 
                                <div class="form-group">
                                    <label class="col-md-12">Tên món</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control form-control-line" name="item-name" placeholder="Cà phê đen"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Giá cả</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control form-control-line" name="item-price" placeholder="15000"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Mô tả</label>
                                    <div class="col-md-12">
                                        <textarea rows="5" class="form-control form-control-line" name="item-desc"></textarea>
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input id="update-btn" class="btn btn-success" type="submit" value="Cập nhật">
                                        <a role="button" class="btn btn-warning" href="shop_info.php?IDSHOP=<?php echo $id_shop; ?>">Quay lại</a>
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

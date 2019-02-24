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
    if (isset($_GET["IDITEM"])) {
        $id_item = $_GET["IDITEM"];
        $sql = "select * from coffee.item where ID_item = " . $id_item . ";";
        $item = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        $id_shop = $item["ID_shop"];
        if (isset($_GET["error"]))
            $err = $_GET["error"];
    }
    else {
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
    <title>Chỉnh sửa món</title>
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
                        <h4 class="page-title">Chỉnh sửa món: <?php $item["Item_name"]; ?></h4> </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-xs-12">    
                        <div class="white-box">
                            <form method="post" action="./query/change_item_photo.php" enctype="multipart/form-data">
                            <div class="user-bg"> <img width="100%" alt="user" src="<?php echo $item["avatar"]; ?>">

                            </div>
                            <div class="user-btm-box">
                                <input type="hidden" value="<?php echo $id_item; ?>" name="id-item">
                                <input type="hidden" value="<?php echo $item["avatar"]; ?>" name="old-avatar">
                                <input type="file" accept="images/*" name="new-avatar">
                                <input type="submit" value="Cập nhật" name="update-img-btn" class="btn btn-success">
                            </div>
                            </form>
                        </div>         
                    </div>
                    
                    <div class="col-md-8 col-xs-12">
                        <div class="white-box">
                            <form class="form-horizontal form-material" action="./query/update_item.php" method="post">
                                <input type="hidden" name="item-id" value="<?php echo $id_item; ?>">
                                <div class="form-group">
                                    <label class="col-md-12">Tên món</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control form-control-line" name="item-name" value="<?php echo $item["Item_name"]; ?>"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Giá cả</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control form-control-line" name="item-price" value="<?php echo $item["Price"]; ?>"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Mô tả</label>
                                    <div class="col-md-12">
                                        <textarea rows="5" class="form-control form-control-line" name="item-desc"><?php echo $item["Description"]; ?></textarea>
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input id="update-btn" class="btn btn-success" type="submit" value="Cập nhật">
                                        <a role="button" class="btn btn-warning" href="shop_info.php?IDSHOP=<?php echo $id_shop; ?>">Quay lại</a>
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
</body>

</html>

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
    if (isset($_GET["ID"])) {
        if (isset($_GET["error"]))
            $err = $_GET["error"];
        $id_head = $_GET["ID"];
        $sql = "select * from coffee.headquarters where ID = " . $id_head . ";";
        $headquarter = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        $head_name = $headquarter["Head_name"];
        $avatar = $headquarter["img_name"];
    }
    else {
        header('Location: 404.html');
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
    <title>Chi tiết trụ sở</title>
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
    <style>
        .button-container {
            padding-bottom: 20px;
        }
    </style>
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
                        <h4 class="page-title">Chi tiết: <?php echo $head_name; ?></h4> </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-xs-12">    
                        <div class="white-box">
                            <form id="form-1" method="post" action="./query/change_head_photo.php" enctype="multipart/form-data">
                            <div class="user-bg"> <img width="100%" alt="user" src="<?php echo $avatar; ?>">
                            </div>
                            <div class="user-btm-box">
                                <input type="hidden" value="<?php echo $id_head; ?>" name="id-head">
                                <input type="hidden" value="<?php echo $avatar; ?>" name="old-avatar">
                                <input type="file" accept="images/*" name="new-avatar">
                                <input type="submit" value="Update" name="update-img-btn" class="btn btn-success">
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                            <form id="form-2" class="form-horizontal form-material" action="./query/update_head_name.php" method="post">
                                <div id="error"><?php echo $err; ?></div>
                                <div class="form-group">
                                    <label class="col-md-12">Tên trụ sở</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control form-control-line" name="head-name" value="<?php echo $head_name; ?>" id="head_name_input"> </div>
                                </div>
                                <input type="hidden" value="<?php echo $id_head; ?>" name="id-head">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="btn btn-info btn-sm" type="button" onclick="accepted()" value="Cập nhật" name="submit-btn">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="button-container">
                            <a role="button" href="./query/initial_shop.php?ID=<?php echo $id_head; ?>" class="btn btn-success btn-md"><i class="fa fa-plus"></i>&nbsp;Thêm chi nhánh</a>
                            <a href="manage_post.php" class="btn btn-warning btn-md" role="button">Quay lại</a>
                        </div>   
                    </div>
                    <div class="col-xs-12">    
                        <div class="white-box">
                            <h3 class="box-title">Danh sách các chi nhánh</h3>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tên chi nhánh</th>
                                            <th>Mô tả</th>
                                            <th>Địa chỉ</th>
                                            <th>Điện thoại</th>
                                            <th>Giờ làm</th>
                                            <th>Loại</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = "select Id_shop from coffee.branch where Id_head = " . $id_head . ";";
                                            $shops = mysqli_query($conn, $sql);
                                            while ($shop = mysqli_fetch_assoc($shops)) {
                                                $shop_id = $shop["Id_shop"];
                                                $sql = "select * from coffee.shop where ID = " . $shop_id . ";";
                                                $shop_info = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                                                $shop_name = $shop_info["Shop_name"];
                                                $shop_desc = $shop_info["Description"];
                                                $add_num = $shop_info["Add_number"];
                                                $street = $shop_info["Street_name"];
                                                $ward = $shop_info["Ward_name"];
                                                $district = $shop_info["District_name"];
                                                $address = $add_num . " " . $street . ", " . $ward . ", " . $district;
                                                $phone = $shop_info["Phone"];
                                                $time_open = substr($shop_info["Open"], 0, 5);
                                                $time_close = substr($shop_info["Close"], 0, 5);
                                                $type_id = $shop_info["Type"];
                                                $sql = "select Type_name from coffee.type_shop where ID = " . $type_id . ";";
                                                $type_name = mysqli_fetch_assoc(mysqli_query($conn, $sql))["Type_name"];
                                                echo "<tr><td>$shop_name</td><td>$shop_desc</td><td>$address</td><td>$phone</td><td>$time_open - $time_close</td><td>$type_name</td><td><a href='shop_info.php?IDSHOP=$shop_id'>Chi tiết</a></td></tr>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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
        function checkName(name) {
            return true;
        }
        function accepted() {
            var newName = document.getElementById("head_name_input").value;
            if (checkName(newName)) {
                document.getElementById("form-2").submit();
            }
            else {
                document.getElementById("error").innerHTML = "Tên trụ sở không hợp lệ";
            }
        }
    </script>
</body>
</html>
<?php mysqli_close($conn); ?>

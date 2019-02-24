<?php
    ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
    session_start();
    header("Content-type: text/html; charset=utf-8");
    $id = $_SESSION["id"];
    $admin_name = $_SESSION["username"];
    $conn = mysqli_connect("localhost", "root", "");
    mysqli_set_charset($conn, 'UTF8');
    $sql = "select avatar from coffee.admin where ID = $id";
    $admin_avatar = mysqli_fetch_assoc(mysqli_query($conn, $sql))["avatar"];
    $sql = "select count(*) as number_users from coffee.user;";
    $number_users = mysqli_fetch_assoc(mysqli_query($conn, $sql))["number_users"];
    $sql = "select count(*) as number_shops from coffee.shop;";
    $number_shops = mysqli_fetch_assoc(mysqli_query($conn, $sql))["number_shops"];
    $sql = "select count(*) as number_images from coffee.image;";
    $number_images = mysqli_fetch_assoc(mysqli_query($conn, $sql))["number_images"];
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
    <title>Trang chủ</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <link href="../plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <link href="../plugins/bower_components/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/colors/default.css" id="theme" rel="stylesheet">
</head>

<body class="fix-header">
    <?php
        function construct_table($conn, $type) {
            $sql = "select * from coffee.shop order by $type DESC limit 5;";
            $shops = mysqli_query($conn, $sql);
            $i = 0;
            while ($shop = mysqli_fetch_assoc($shops)) {
                //STT, Ten, dia chi, Sao
                $i += 1;
                $shop_name = $shop["Shop_name"];
                $add_num = $shop["Add_number"];
                $street = $shop["Street_name"];
                $ward = $shop["Ward_name"];
                $district = $shop["District_name"];
                $address = "$add_num $street, $ward, $district";
                $value = $shop[$type];
                echo "<tr>";
                echo "<td>$i</td>";
                echo "<td class='txt-oflo'>$shop_name</td>";
                echo "<td class='txt-oflo'>$address</td>";
                echo "<td><span class='text-success'>$value</span></td>";
                echo "</tr>";
            }
        }
    ?>
    <?php include './pages/components/preload.php'; ?>
    <div id="wrapper">
        <?php include './pages/components/header.php'; ?>
        <?php include './pages/components/left_sidebar.php';?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Bảng điều khiển</h4> </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Số khách hàng</h3>
                            <ul class="list-inline two-part">
                                <li>
                                    <div id="sparklinedash"></div>
                                </li>
                                <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success"><?php echo $number_users; ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Số bài đăng</h3>
                            <ul class="list-inline two-part">
                                <li>
                                    <div id="sparklinedash2"></div>
                                </li>
                                <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple"><?php echo $number_shops; ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Số hình ảnh</h3>
                            <ul class="list-inline two-part">
                                <li>
                                    <div id="sparklinedash3"></div>
                                </li>
                                <li class="text-right"><i class="ti-arrow-up text-info"></i> <span class="counter text-info"><?php echo $number_images; ?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Quán cà phê được nhiều điểm nhất</h3>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>TÊN</th>
                                            <th>ĐỊA CHỈ</th>
                                            <th>ĐIỂM</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            construct_table($conn, "Score");
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Quán cà phê được lưu nhiều nhất</h3>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>TÊN</th>
                                            <th>ĐỊA CHỈ</th>
                                            <th>LƯU</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php construct_table($conn, "Save"); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- chat-listing & recent comments -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Quán cà phê được nhiều sao nhất</h3>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>TÊN</th>
                                            <th>ĐỊA CHỈ</th>
                                            <th>SAO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php construct_table($conn, "Star"); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2018 &copy; Coffee Lookup brought to you by Trong Luan </footer>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <?php mysqli_close($conn); ?>
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Counter js -->
    <script src="../plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="../plugins/bower_components/counterup/jquery.counterup.min.js"></script>
    
    <script src="../plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
    <script src="../plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>

    <script src="../plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <script src="js/dashboard1.js"></script>
    <script src="../plugins/bower_components/toast-master/js/jquery.toast.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
</body>

</html>

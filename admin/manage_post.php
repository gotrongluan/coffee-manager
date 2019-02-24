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
    <title>Quản lí bài đăng</title>
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
                        <h4 class="page-title">Quản lí bài đăng</h4> </div>
                </div>
                <div class="row">
                    <div class="col-xs-3 button-container">
                        <a role="button" class="btn btn-success btn-lg" href="new_headquarter.php"><i class="fa fa-plus"></i>&nbsp;Thêm trụ sở</a>
                    </div>
                    <div class="col-xs-12">    
                        <div class="white-box">
                            <h3 class="box-title">Danh sách các trụ sở</h3>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên trụ sở</th>
                                            <th>Người tạo</th>
                                            <th>Số lượng chi nhánh</th>
                                            
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = "select * from coffee.headquarters";
                                            $headquarters = mysqli_query($conn, $sql);
                                            $i = 0;
                                            while ($headquarter = mysqli_fetch_assoc($headquarters)) {
                                                $i += 1;
                                                $id_creator = $headquarter["creator"];
                                                $id_headquarter = $headquarter["ID"];
                                                $sql = "select User_name from coffee.admin where ID = " . $id_creator . ";";
                                                $creator = mysqli_fetch_assoc(mysqli_query($conn, $sql))["User_name"];
                                                $sql = "select Id_shop from coffee.branch where Id_head = " . $id_headquarter . ";";
                                                $shops = mysqli_query($conn, $sql);
                                                $count_shops = mysqli_num_rows($shops);
                                                $name_headquarter = $headquarter["Head_name"];
                                                echo "<tr><td>$i</td><td class='txt-oflo'>$name_headquarter</td><td class='txt-oflo'>$creator</td><td>$count_shops</td><td><a href='./detail_headquarter.php?ID=$id_headquarter'>Chi tiết</a></td></tr>";
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
</body>
</html>
<?php mysqli_close($conn); ?>

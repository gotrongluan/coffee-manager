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
    function list_all($conn, $is_admin = false) {
        $table = $is_admin ? "admin" : "user";
        $type = $is_admin ? 0 : 1;
        $sql = "select * from coffee." . $table;
        $users = mysqli_query($conn, $sql);
        while ($user = mysqli_fetch_assoc($users)) {
            $user_name = $user["User_name"];
            $phone = $user["Phone"];
            $address = $user["Address"];
            $birthday = $user["Birthday"];
            $email = $user["Email"];
            $avatar = $user["avatar"];
            $id = $user["ID"];
            echo "<tr><td class='txt-oflo'>" . $user_name . "</td><td>" . $phone . "</td><td class='txt-oflo'>" . $address . "</td><td>" . $birthday . "</td><td>" . $email . "</td><td><a href='detail_user.php?ID=$id&type=$type'>Chi tiết</a></td></tr>";
        }
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
    <title>Quản lí người dùng</title>
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
                        <h4 class="page-title">Quản lí người dùng</h4> </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">    
                        <div class="white-box">
                            <h3 class="box-title">Danh sách quản trị viên</h3>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tên tài khoản</th>
                                            <th>Số điện thoại</th>
                                            <th>Địa chỉ</th>
                                            <th>Ngày sinh</th>
                                            <th>Email</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            list_all($conn, true);
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>         
                    </div>
                    
                    <div class="col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Danh sách người dùng</h3>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tên tài khoản</th>
                                            <th>Số điện thoại</th>
                                            <th>Địa chỉ</th>
                                            <th>Ngày sinh</th>
                                            <th>Email</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            list_all($conn);
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

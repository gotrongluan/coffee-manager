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
    $admin_birthday = $admin["Birthday"];
    $admin_address = $admin["Address"];
    $admin_email = $admin["Email"];
    $admin_phone = $admin["Phone"];
    $err = "";
    if (isset($_GET["error"]))
        $err = $_GET["error"];
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
    <title>Thông tin cá nhân</title>
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
                        <h4 class="page-title">Thông tin cá nhân</h4> </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-xs-12">    
                        <div class="white-box">
                            <form method="post" action="./query/change_photo.php" enctype="multipart/form-data">
                            <div class="user-bg"> <img width="100%" alt="user" src="<?php echo $admin_avatar; ?>">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <a href="javascript:void(0)"><img src="<?php echo $admin_avatar; ?>" class="thumb-lg img-circle" alt="img"></a>
                                        <h4 class="text-white"><?php echo $admin_name; ?></h4>
                                        <h5 class="text-white"><?php echo $admin_email; ?></h5> </div>
                                </div>
                            </div>
                            <div class="user-btm-box">
                                <input type="hidden" value="<?php echo $admin_avatar; ?>" name="old-avatar">
                                <input type="file" accept="images/*" name="new-avatar">
                                <input type="submit" value="Update" name="update-img-btn" class="btn btn-success">
                            </div>
                            </form>
                        </div>         
                    </div>
                    
                    <div class="col-md-8 col-xs-12">
                        <div class="white-box">
                            <form class="form-horizontal form-material" action="./query/update_info.php" method="post">
                                <div class="form-group">
                                    <label class="col-md-12">Tên tài khoản</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control form-control-line" name="username" value="<?php echo $admin_name; ?>"> </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-mail" class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" class="form-control form-control-line" name="mail" id="example-email" value="<?php echo $admin_email; ?>"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Số điện thoại</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control form-control-line" name="phone" value="<?php echo $admin_phone; ?>"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Địa chỉ</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control form-control-line" name="address" value="<?php echo $admin_address; ?>"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Ngày sinh</label>
                                    <div class="col-md-12">
                                        <input type="date" id="date-picker-example" class="form-control form-control-line" value="<?php echo $admin_birthday; ?>" name="birthday"></div>
                                </div>
                                <div class="form-group">
                                    <div id="error" class="col-sm-12"><?php echo $err; ?></div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input id="update-btn" class="btn btn-success" type="submit" value="Cập nhật">
                                        <button class="btn btn-success" onclick="changePassword()" type="button">Đổi mật khẩu</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12"></div>
                    <div class="col-md-8 col-xs-12" id="change-pass-div">    
                        <div class="white-box">
                            <form id="form-1" action="./query/change_password.php" method="post" class="form-horizontal form-material">
                                <div class="form-group">
                                    <label class="col-md-12">Mật khẩu cũ</label>
                                    <div class="col-md-12">
                                        <input type="password" class="form-control form-control-line kms" name="old-pass"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Mật khẩu mới</label>
                                    <div class="col-md-12">
                                        <input type="password" class="form-control form-control-line kms" name="new-pass"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Nhập lại</label>
                                    <div class="col-md-12">
                                        <input type="password" class="form-control form-control-line kms"name="new-re-pass"> </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success" onclick="accept()" type="button">Thay đổi</button>
                                        <button class="btn btn-warning" onclick="reject()" type="button">Hủy</button>
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
        document.getElementById("change-pass-div").style.display = "none";
        var boxes = document.getElementsByClassName("kms");
        function changePassword() {
            document.getElementById("change-pass-div").style.display = "block";
            document.getElementById("update-btn").disabled = true;
        }
        function accept() {
            var newPassword = boxes[1].value;
            var newRetypePassword = boxes[2].value;
            if (newPassword != newRetypePassword) {
                document.getElementById("error").innerHTML = "Lỗi mật khẩu không khớp!";
            }
            else {
                var xhttp = new XMLHttpRequest();
                xhttp.open("GET", "./query/get_password.php", false);
                xhttp.send();
                var oldPass = xhttp.responseText;
                var userTypedPass = boxes[0].value;
                if (oldPass == userTypedPass) {
                    document.getElementById("form-1").submit();
                }
                else {
                    document.getElementById("error").innerHTML = "Nhập mật khẩu sai!";
                }
            }
        }
        function reject() {
            document.getElementById("change-pass-div").style.display = "none";
            var i;
            for (i = 0; i < boxes.length; ++i) {
                boxes[i].value = "";
            }
            document.getElementById("update-btn").disabled = false;
            document.getElementById("error").innerHTML = "";
        }
    </script>
</body>

</html>

<?php 
    ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
    session_start();
    header("Content-type: text/html; charset=utf-8");
    $id = $_SESSION["id"];
    $user_name = $_SESSION["username"];
    $is_login = true;
    $conn = mysqli_connect("localhost", "root", "");
    mysqli_set_charset($conn, 'UTF8');
    $sql = "select * from coffee.user where ID = $id";
    $user = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    $user_avatar = $user["avatar"];
    $user_name = $user["User_name"];
    $user_birthday = $user["Birthday"];
    $user_address = $user["Address"];
    $user_phone = $user["Phone"];
    $user_email = $user["Email"];
    $err = "";
    if (isset($_GET["error"]))
        $err = $_GET["error"];
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Thông tin tài khoản</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="../css/my-css/user-profile-style.css">
  <link rel="stylesheet" type="text/css" href="../css/my-css/common-style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body id="myPage">
<?php include './components/header.php'; ?>
<!-- Container (The Band Section) -->
<div id="band" class="container">
  
  <div class="row">
    <div class="col-sm-3 col-xs-12 list-group">
        <?php include './components/list_options.php'; ?>
    </div>
    <div class="col-sm-3 col-xs-12">
        <form method="post" action="./query/change_user_photo.php" enctype="multipart/form-data">
            <div class="avatar-container">
                <div class="img-container">
                    <img src="<?php echo $user_avatar; ?>" alt="avatar" class="photo-image">
                    <div class="overlay">User: <?php echo $user_name; ?></div>
                </div>
                <div class="button-container text-center">
                    <input type="hidden" value="<?php echo $user_avatar; ?>" name="old-avatar">
                    <input type="file" accept="images/*" name="new-avatar">
                    <input type="submit" value="Cập nhật" name="update-img-btn" class="btn btn-success btn-xs">
                </div>
            </div>
        </form>
    </div>
    <div class="col-sm-6 col-xs-12">
        <form class="form-horizontal form-material info-form" action="./query/update_info.php" method="post">
           <div class="form-group">
                <label class="col-md-12">Tên tài khoản</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control form-control-line" name="username" value="<?php echo $user_name; ?>"> </div>
                    </div>
                                <div class="form-group">
                                    <label for="example-mail" class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" class="form-control form-control-line" name="mail" id="example-email" value="<?php echo $user_email; ?>"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Số điện thoại</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control form-control-line" name="phone" value="<?php echo $user_phone; ?>"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Địa chỉ</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control form-control-line" name="address" value="<?php echo $user_address; ?>"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Ngày sinh</label>
                                    <div class="col-md-12">
                                        <input type="date" id="date-picker-example" class="form-control form-control-line" value="<?php echo $user_birthday; ?>" name="birthday"></div>
                                </div>
                                <div class="form-group">
                                    <div id="error" class="col-sm-12"><?php echo $err; ?></div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input id="update-btn" class="btn btn-success" type="submit" value="Cập nhật">
                                        <button class="btn btn-warning" type="button" onclick="changePassword()">Đổi mật khẩu</button>
                                    </div>
                                </div>
                            </form>
    </div>
    <div class="col-md-6 col-xs-12"></div>
    <div class="col-md-6 col-xs-12" id="change-pass-div">
        <form id="form-1" action="./query/change_password.php" method="post" class="form-horizontal form-material info-form" style="margin-top: 20px;">
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
  <button class="btn btn-primary scroll-top" data-scroll="up" type="button">
      <i class="fa fa-chevron-up"></i>
  </button>
<?php include './components/footer.php'; ?>
<script type="text/javascript">
    var options = document.getElementsByClassName("list-group-item-action");
    options[0].classList.add("active");
</script>
<script type="text/javascript">
  $(document).ready(function () {
  $(window).scroll(function () {
    if ($(this).scrollTop() > 150) {
      $('.scroll-top').fadeIn();
    }
    else
    {
      $('.scroll-top').fadeOut();
    }
  });

  $('.scroll-top').click(function () {
    $("html, body").animate({scrollTop: 0}, 200);
  return false;
  });
});
</script>
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

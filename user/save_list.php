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
  <link rel="stylesheet" type="text/css" href="../css/my-css/save-list-style.css">
  <link rel="stylesheet" type="text/css" href="../css/my-css/common-styles.css">
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
    <div class="col-sm-9 col-xs-12">
        <div class="table-responsive white-box">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>TÊN QUÁN</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "select * from coffee.save where ID_user = " . $id . ";";
                        $lst = mysqli_query($conn, $sql);
                        $i = 0;
                        while ($save = mysqli_fetch_assoc($lst)) {
                            $i += 1;
                            $id_shop = $save["ID_shop"];
                            $sql = "select Shop_name from coffee.shop where ID = " . $id_shop;
                            $shop_name = mysqli_fetch_assoc(mysqli_query($conn, $sql))["Shop_name"];
                            echo "<tr><td>" . $i . "</td><td>" . $shop_name . "</td><td><a href='detail_shop.php?IDSHOP=" . $id_shop . "'>Chi tiết</a></td><td><a href='./query/delete_save.php?IDSHOP=" . $id_shop . "'>Xóa</a></td></tr>"; 
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>
  <button class="btn btn-primary scroll-top" data-scroll="up" type="button">
      <i class="fa fa-chevron-up"></i>
  </button>
<?php include './components/footer.php'; ?>
<script type="text/javascript">
    var options = document.getElementsByClassName("list-group-item-action");
    options[2].classList.add("active");
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
</body>
</html>
<?php mysqli_close($conn); ?>

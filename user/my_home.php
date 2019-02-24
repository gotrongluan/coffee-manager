<?php 
    ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
    session_start();
    header("Content-type: text/html; charset=utf-8");
    $is_login = true;
    if (!isset($_SESSION["id"]))
    {
      $is_login = false;
    }
    else {
      $id = $_SESSION["id"];
      $user_name = $_SESSION["username"];
      $conn = mysqli_connect("localhost", "root", "");
      mysqli_set_charset($conn, 'UTF8');
      //$sql = "select avatar from coffee.user where ID = $id";
      //$user_avatar = mysqli_fetch_assoc(mysqli_query($conn, $sql))["avatar"];
    }
    
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Trang chủ</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="../css/my-css/my-home-styles.css">
  <link rel="stylesheet" type="text/css" href="../css/my-css/common-style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body id="myPage">
<?php include './components/header.php'; ?>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="../assets/cafe 1.jpg" alt="New York" width="1200" height="700">
        <div class="carousel-caption">
          <h3>Coffee house</h3>
          <p>Niềm tự hào của quán cà phê Việt</p>
        </div>      
      </div>

      <div class="item">
        <img src="../assets/cafe 2.jpg" alt="Chicago" width="1200" height="700">
        <div class="carousel-caption">
          <h3>Staburg</h3>
          <p>Thương hiệu số một thế giới</p>
        </div>      
      </div>
    
      <div class="item">
        <img src="../assets/cafe 3.jpg" alt="Los Angeles" width="1200" height="700">
        <div class="carousel-caption">
          <h3>BK Solar</h3>
          <p>Quán cà phê sử dụng năng lượng mặt trời</p>
        </div>      
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>

<!-- Container (The Band Section) -->
<div id="band" class="container text-center">
  <h3>Coffee Lookup</h3>
  <p><em>Hãy để chúng tôi giúp bạn tìm kiếm!</em></p>
  <p>. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
  <br>
  <div class="row">
    <div class="col-xs-4">
      
      <p class="text-center title-slogan"><strong>Học tập</strong></p>
      <a href="#demo" data-toggle="collapse">
        <img src="../assets/cafe c.jpg" class="img-rounded person" alt="Random Name" width="255" height="255">
      </a>
      <div id="demo" class="collapse slogan">
        <p>Lựa chọn một vị trí yên tĩnh</p>
        <p>Order một cốc cà phê thơm ngon</p>
        <p>Lật sách ra và học thôi</p>
    </div>
  </div>
    <div class="col-xs-4">
      <p class="text-center title-slogan"><strong>Trò chuyện</strong></p>
      <a href="#demo2" data-toggle="collapse">
        <img src="../assets/cafe d.jpg" class="img-rounded person" alt="Random Name" width="255" height="255">
      </a>


      <div id="demo2" class="collapse slogan">
        <p>Rủ bạn bè cùng đến quán</p>
        <p>Cùng nhau order thức uống</p>
        <p>Vừa thưởng thức vừa trò chuyện</p>
      </div>

    </div>
    <div class="col-xs-4">

      <p class="text-center title-slogan"><strong>Xem bóng đá</strong></p>
      <a href="#demo3" data-toggle="collapse">
        <img src="../assets/cafe a.jpg" class="img-rounded person" alt="Random Name" width="255" height="255">
      </a>


      <div id="demo3" class="collapse slogan" >
        <p>Đến quán từ sớm để có một chỗ ngồi đẹp</p>
        <p>Order một ly cà phê đen tỉnh táo</p>
        <p>Vừa xem vừa nhâm nhi, thật tuyệt!</p>
      </div>

    </div>
  </div>
</div>
  <button class="btn btn-primary scroll-top" data-scroll="up" type="button">
      <i class="fa fa-chevron-up"></i>
  </button>
<?php include './components/footer.php'; ?>
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

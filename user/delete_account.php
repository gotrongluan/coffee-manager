<?php 
    ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
    session_start();
    header("Content-type: text/html; charset=utf-8");
    $id = $_SESSION["id"];
    $user_name = $_SESSION["username"];
    $is_login = true;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Xóa tài khoản</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="../css/my-css/delete-account-styles.css">
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
        <div class="main-div">
            <p class="text-justify">Này <b><?php echo $user_name; ?></b>, bạn có chắc chắn muốn xóa tài khoản?</p>
            <button class="btn btn-danger" type="button">Xóa ngay</button>
        </div>
    </div>
  </div>
</div>
<?php include './components/footer.php'; ?>
<script type="text/javascript">
    var options = document.getElementsByClassName("list-group-item-action");
    options[1].classList.add("active");
</script>
</body>
</html>

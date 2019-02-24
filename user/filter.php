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
  <title>Lọc quán</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="../css/my-css/filter-style-1.css">
  <link rel="stylesheet" type="text/css" href="../css/my-css/common-style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body id="myPage">
<?php include './components/header.php'; ?>
<!-- Container (The Band Section) -->
<div class="display-table">
  <div class="display-table-cell">
<div id="band" class="container">
  <div class="row">
    <form method="get" action="list_posts.php">
    <div class="col-md-8 col-xs-12">
      <div class="col-md-12 main-filter">
        <div class="col-md-4 col-xs-6">
            <label class="check-c">
                Tất cả quận
                <input id="all_dist" type="checkbox" name="filter-district-all" value="0" onchange="allCheckedDistrict()">
                <span class="checkmark"></span>
            </label>
        </div>
        <?php
            $sql = "select * from coffee.district;";
            $dists = mysqli_query($conn, $sql);
            while ($dist = mysqli_fetch_assoc($dists)) {
                $dist_name = $dist["District_Name"];
                echo '<div class="col-md-4 col-xs-6">';
                echo '<label class="check-c">';
                echo $dist_name;
                echo '<input type="checkbox" name="filter-district[]" value="' . $dist_name . '">';
                echo '<span class="checkmark"></span>';
                echo "</div>";
            }
        ?>
        <div class="clearboth"></div>
      </div>

    </div>
    <div class="col-md-4 col-xs-12">
        <div class="col-md-12 main-filter">
          <div class="col-md-12">
            <label class="check-c">
                Tất cả loại
                <input id="all_type" type="checkbox" name="filter-type-all" value="0" onchange="allCheckedType()">
                <span class="checkmark"></span>
            </label>
          </div>
          <?php
              $sql = "select * from coffee.type_shop;";
              $types = mysqli_query($conn, $sql);
              while ($type = mysqli_fetch_assoc($types)) {
                  $type_id = $type["ID"];
                  $type_name = $type["Type_name"];
                  echo '<div class="col-md-12">';
                  echo '<label class="check-c">';
                  echo $type_name;
                  echo '<input type="checkbox" name="filter-type[]" value="' . $type_id . '">';
                  echo '<span class="checkmark"></span>';
                  echo '</div>';
              }
          ?>
        </div>
    </div>
    <div class="button-container col-xs-12 text-align">
        <button type="submit" class="btn-outline-dark">Tìm ngay</button>
    </div>
  </form>
  </div>
</div>
</div>
</div>
<?php include './components/footer.php'; ?>
<script type="text/javascript">
    function allCheckedDistrict() {
        var status = document.getElementById("all_dist").checked;
        var checkboxes = document.getElementsByName("filter-district[]");
        var i;
        if (status) {
            for (i = 0; i < checkboxes.length; ++i) {
                checkboxes[i].checked = true;
            }
        }
        else {
            for (i = 0; i < checkboxes.length; ++i) {
                checkboxes[i].checked = false;
            }
        }
    }
    function allCheckedType() {
        var status = document.getElementById("all_type").checked;
        var checkboxes = document.getElementsByName("filter-type[]");
        var i;
        if (status) {
            for (i = 0; i < checkboxes.length; ++i) {
                checkboxes[i].checked = true;
            }
        }
        else {
            for (i = 0; i < checkboxes.length; ++i) {
                checkboxes[i].checked = false;
            }
        }
    }
</script>
</body>
</html>
<?php mysqli_close($conn); ?>
<?php ?>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a id="logo-link" class="navbar-brand" href="#myPage"><span id="logo-link"><img src="../assets/logo-wall.jpg" class="img-thumbnail" alt="logo" id="logo-img"></span></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="my_home.php"><i class="fa fa-home"></i>&nbsp;Trang chủ</a></li>
        <li><a href="filter.php"><i class="fa fa-filter"></i>&nbsp;Lọc</a></li>
        <li><a href="#contact"><i class="fa fa-cogs"></i>&nbsp;Liên hệ</a></li>
        <?php
        	if (!$is_login) {
        		echo "<li><a href='../pages/login.php'><i class='fa fa-sign-in'></i>&nbsp;Đăng nhập</a></li>";
        	}
        	else {
        		echo "<li><a href='user_profile.php'><i class='fa fa-user'></i>&nbsp;" . $user_name . "</a></li>";
        	}
        ?>

        <!-- <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
          	<b><?php //echo $user_name; ?></b>
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Merchandise</a></li>
            <li><a href="#">Extras</a></li>
            <li><a href="#">Media</a></li> 
          </ul>
        </li> -->
        <li><a href="#"><span class="glyphicon glyphicon-search"></span></a></li>
      </ul>
    </div>
  </div>
</nav>
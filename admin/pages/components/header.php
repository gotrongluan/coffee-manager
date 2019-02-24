<?php ?>
<nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <b>
                            <img src="../assets/logo-t.jpg" alt="home" class="dark-logo" />
                            <img src="../assets/logo-t.jpg" alt="home" class="light-logo"/>
                        </b>
                        <span class="hidden-xs">
                            <img src="../assets/icon.png" alt="home" class="dark-logo" />
                            <img src="../assets/icon.png" alt="home" class="light-logo" />
                        </span>
                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                            <input type="text" placeholder="Tìm kiếm..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
                    </li>
                    <li>
                        <a class="profile-pic" href="#"> <img src="<?php echo $admin_avatar; ?>" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?php echo $admin_name; ?></b></a>
                    </li>
                </ul>
            </div>
        </nav>
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
    $id_shop = $_GET["IDSHOP"];
    $sql = "select * from coffee.shop where ID = " . $id_shop . ";";
    $shop = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    $err = "";
    if (isset($_GET["error"]))
        $err = $_GET["error"];
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
    <title>Chi tiết quán</title>
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
        .my-right {
            text-align: right;
        }
        .button-container {
            padding-bottom: 20px;
        }
        .my-btn {
            border: none;
            color: lightgray;
            padding: 0;
            font-size: 16px;
            cursor: pointer;
            background-color: transparent;
        }
        .my-btn:hover {
            color: blue;
        }
        .love {
            display: none;
            margin-bottom: 10px;
        }
        .inline-form {
            position: relative;
        }
        .my-img {
            width: 100%;
        }

        .misthy {
            position: absolute;
            top: 0;
            right: 0;
        }
        .my-white-box {
            background-color: #fff;
            padding: 10px;
        }
        .my-h2 {
            text-align: center;
            cursor: pointer;
        }
        .my-h2:hover {
            color: #008080;
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
                        <h4 class="page-title">Chi tiết quán: <?php echo $shop["Shop_name"]; ?></h4> </div>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title" id="exampleModalLabel" style="font-size:20px">Lỗi</span>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h5 id="error_notify"></h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="deleteImgModal" tabindex="-1" role="dialog" aria-labelledby="deleteImgModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title" id="deleteImgLabel" style="font-size:20px">Xác nhận xóa</span>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h5>Bạn có chắc chắn muốn xóa hình không?</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <button type="button" class="btn btn-primary" onclick="accepted()">Xóa ngay</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="deleteItemModal" tabindex="-1" role="dialog" aria-labelledby="deleteItemModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title" id="deleteItemLabel" style="font-size:20px">Xác nhận xóa</span>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h5>Bạn có chắc chắn muốn xóa món không?</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <button type="button" class="btn btn-primary" onclick="itemAccepted()">Xóa ngay</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="detailItemModal" tabindex="-1" role="dialog" aria-labelledby="detailItemModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title" id="detailItemLabel" style="font-size:20px">Chi tiết đồ uống</span>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="item-view">
                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <a class="btn btn-primary btn-info" href="#" id="mylove">Sửa</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class='white-box'>
                            <span class="box-title">Danh sách hình ảnh</span>
                        </div>   
                    </div>
                    <?php
                        $sql = "select Img_name from coffee.image_shop where ID_shop = " . $id_shop . ";";
                        $imgs = mysqli_query($conn, $sql);
                        $count = 0;
                        while ($img = mysqli_fetch_assoc($imgs)) {
                            $img_name = $img["Img_name"];
                            echo "<div class='col-md-3 col-sm-8 col-xs-12'>";
                            echo "<div class='white-box'>";
                            echo "<form id='img-shop-$count' method='post' action='./query/delete_img_shop.php' enctype='multipart/form-data' class='inline-form'>";
                            echo "<input type='hidden' name='id-shop' value='$id_shop'>";
                            echo "<input type='hidden' name='shop-img' value='$img_name'>";
                            echo "<img src='$img_name' alt='image-shop' class='img-rounded my-img'>";
                            echo "<button onclick='first($count)' type='button' class='btn btn-danger btn-xs misthy'><i class='fa fa-times'></i></button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";
                            $count++;
                        }
                    ?>
                    <div class="col-xs-12"></div>
                    <div class="col-xs-3 button-container">
                        <form method="post" action="./query/add_img_shop.php" enctype="multipart/form-data">
                            <input type="file" accept="images/*" name="new-img">
                            <input type="hidden" name="id-shop" value="<?php echo $id_shop; ?>">
                            <button type="submit" class="btn btn-success btn-md"><i class="fa fa-plus"></i>&nbsp;Thêm ảnh</button>
                        </form>  
                    </div>
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class='white-box'>
                            <span class="box-title">Danh sách đồ uống</span>
                        </div>   
                    </div>
                    <?php
                        $sql = "select * from coffee.item where ID_shop = " . $id_shop . ";";
                        $items = mysqli_query($conn, $sql);
                        while ($item = mysqli_fetch_assoc($items)) {
                            $item_id = $item["ID_item"];
                            $item_name = $item["Item_name"];
                            $img = $item["avatar"];
                            echo "<div class='col-md-3 col-sm-4 col-xs-12'>";
                            echo "<div class='white-box'>";
                            echo '<div class="user-bg inline-form">';
                            echo '<img width="100%" alt="item" src="' . $img . '">';
                            echo "<button onclick='third($item_id)' type='button' class='btn btn-danger btn-xs misthy'><i class='fa fa-times'></i></button>";
                            echo '</div>';
                            echo '<div class="user-btm-box" style="padding:0">';
                            echo "<h2 class='my-h2' onclick='second($item_id)' role='button'>" . $item_name . "</h2>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    ?>
                    <div class="col-xs-12"></div>
                    <div class="col-xs-3 button-container">
                        <form method="get" action="./add_item.php">
                            <input type="hidden" name="id-shop" value="<?php echo $id_shop; ?>">
                            <button type="submit" class="btn btn-success btn-md"><i class="fa fa-plus"></i>&nbsp;Thêm món</button>
                        </form>  
                    </div>
                    <div class="col-xs-12"></div>
                    <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                            <form id="name-form" class="form-horizontal form-material" action="./query/update_shop_name.php" method="post">
                                <input type="hidden" name="id-shop" value="<?php echo $id_shop; ?>">
                                <div class="form-group">
                                    <label class="col-md-7">Tên quán</label>
                                    <div class="col-md-5 my-right">
                                        <button type="button" id="edit_name_btn" class="my-btn" onclick="editShopName()"><i class="fa fa-edit"></i></button>
                                        <button id="accept_name_btn" class="btn btn-success btn-xs change-btn" onclick="acceptChangeName()" type="button">Thay đổi</button>
                                        <button id="reject_name_btn" class="btn btn-warning btn-xs change-btn" onclick="rejectChangeName()" type="button">Hủy</button>
                                    </div>
                                    <div class="col-md-12">
                                        <input id="shop_name_hidden" type="hidden" value="<?php echo $shop["Shop_name"]; ?>">
                                        <input id="shop_name" type="text" class="form-control form-control-line" name="shop-name" value="<?php echo $shop["Shop_name"]; ?>" readonly> </div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                            <form id="phone-form" class="form-horizontal form-material" action="./query/update_shop_phone.php" method="post">
                                <input type="hidden" name="id-shop" value="<?php echo $id_shop; ?>">
                                <div class="form-group">
                                    <label class="col-md-7">Điện thoại</label>
                                    <div class="col-md-5 my-right">
                                        <button type="button" id="edit_phone_btn" class="my-btn" onclick="editShopPhone()"><i class="fa fa-edit"></i></button>
                                        <button id="accept_phone_btn" class="btn btn-success btn-xs change-btn" onclick="acceptChangePhone()" type="button">Thay đổi</button>
                                        <button id="reject_phone_btn" class="btn btn-warning btn-xs change-btn" onclick="rejectChangePhone()" type="button">Hủy</button>
                                    </div>
                                    <div class="col-md-12">
                                        <input id="shop_phone_hidden" type="hidden" value="<?php echo $shop["Phone"]; ?>">
                                        <input id="shop_phone" type="text" class="form-control form-control-line" name="shop-phone" value="<?php echo $shop["Phone"]; ?>" readonly> </div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <?php
                            $type_id = $shop["Type"];
                            $sql = "select Type_name from coffee.type_shop where ID = " . $type_id . ";";
                            $type_name = mysqli_fetch_assoc(mysqli_query($conn, $sql))["Type_name"];
                        ?>
                        <div class="white-box">
                            <form id="type-form" class="form-horizontal form-material" action="./query/update_shop_type.php" method="post">
                                <input type="hidden" name="id-shop" value="<?php echo $id_shop; ?>">
                                <div class="form-group">
                                    <label class="col-md-7">Loại quán</label>
                                    <div class="col-md-5 my-right">
                                        <button type="button" id="edit_type_btn" class="my-btn" onclick="editShopType()"><i class="fa fa-edit"></i></button>
                                        <button id="accept_type_btn" class="btn btn-success btn-xs change-btn" onclick="acceptChangeType()" type="button">Thay đổi</button>
                                        <button id="reject_type_btn" class="btn btn-warning btn-xs change-btn" onclick="rejectChangeType()" type="button">Hủy</button>
                                    </div>
                                    <div class="col-md-12">
                                        <input id="type_hidden" type="text" class="form-control form-control-line" value="<?php echo $type_name; ?>" readonly>
                                        <select id="type_select" class="form-control form-control-line" style="display:none" name="shop-type">
                                            <?php
                                                $sql = "select * from coffee.type_shop;";
                                                $types = mysqli_query($conn, $sql);
                                                $selected = "selected";
                                                while ($type = mysqli_fetch_assoc($types)) {
                                                    $id_type = $type["ID"];
                                                    $name_type = $type["Type_name"];
                                                    echo "<option value='" . $id_type . "' $selected>" . $name_type . "</option>";
                                                    $selected = "";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="white-box">
                            <form id="desc-form" class="form-horizontal form-material" action="./query/update_shop_desc.php" method="post">
                                <input type="hidden" name="id-shop" value="<?php echo $id_shop; ?>">
                                <div class="form-group">
                                    <label class="col-md-7">Mô tả</label>
                                    <div class="col-md-5 my-right">
                                        <button type="button" id="edit_desc_btn" class="my-btn" onclick="editShopDesc()"><i class="fa fa-edit"></i></button>
                                        <button id="accept_desc_btn" class="btn btn-success btn-xs change-btn" onclick="acceptChangeDesc()" type="button">Thay đổi</button>
                                        <button id="reject_desc_btn" class="btn btn-warning btn-xs change-btn" onclick="rejectChangeDesc()" type="button">Hủy</button>
                                    </div>
                                    <div class="col-md-12">
                                        <input id="desc_hidden" type="text" class="form-control form-control-line" value="<?php echo trim($shop["Description"]); ?>" readonly>
                                        <textarea id="desc_text_area" rows="5" class="form-control form-control-line" name="description" style="display:none">
                                            <?php echo trim($shop["Description"]); ?>
                                        </textarea> </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <?php
                            $add_num = $shop["Add_number"];
                            $street = $shop["Street_name"];
                            $ward = $shop["Ward_name"];
                            $district = $shop["District_name"];
                            $address = "$add_num $street, $ward, $district";
                        ?>
                        <div class="white-box">
                            <form id="address-form" class="form-horizontal form-material" action="./query/update_shop_address.php" method="post">
                                <input type="hidden" name="id-shop" value="<?php echo $id_shop; ?>">
                                <div class="form-group">
                                    <label class="col-md-7">Địa chỉ</label>
                                    <div class="col-md-5 my-right">
                                        <button type="button" id="edit_address_btn" class="my-btn" onclick="editShopAddress()"><i class="fa fa-edit"></i></button>
                                        <button id="accept_address_btn" class="btn btn-success btn-xs change-btn" onclick="acceptChangeAddress()" type="button">Thay đổi</button>
                                        <button id="reject_address_btn" class="btn btn-warning btn-xs change-btn" onclick="rejectChangeAddress()" type="button">Hủy</button>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control form-control-line" value="<?php echo $address; ?>" id="address_hidden" readonly>
                                        <input id="add_number" type="text" class="form-control form-control-line love" name="add-number" placeholder="Số nhà">
                                        <select id="shop_district" class="form-control form-control-line love" name="shop-district" onchange="selectDistrict()">
                                            <?php
                                                $sql = "select District_Name from coffee.district";
                                                $dists = mysqli_query($conn, $sql);
                                                $selected = "selected";
                                                while ($dist = mysqli_fetch_assoc($dists)) {
                                                    $dist_name = $dist["District_Name"];
                                                    echo "<option value='" . $dist_name . "' " . $selected . ">" . $dist_name . "</option>";
                                                    $selected = "";
                                                }
                                            ?>
                                        </select>
                                        <select id="shop_ward" class="form-control form-control-line love" name="shop-ward" onchange="selectWard()"></select>
                                        <select id="shop_street" class="form-control form-control-line love" name="shop-street"></select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                            <form id="open-form" class="form-horizontal form-material" action="./query/update_shop_open.php" method="post">
                                <input type="hidden" name="id-shop" value="<?php echo $id_shop; ?>">
                                <div class="form-group">
                                    <label class="col-md-7">Giờ mở cửa</label>
                                    <div class="col-md-5 my-right">
                                        <button type="button" id="edit_open_btn" class="my-btn" onclick="editShopOpen()"><i class="fa fa-edit"></i></button>
                                        <button id="accept_open_btn" class="btn btn-success btn-xs change-btn" onclick="acceptChangeOpen()" type="button">Thay đổi</button>
                                        <button id="reject_open_btn" class="btn btn-warning btn-xs change-btn" onclick="rejectChangeOpen()" type="button">Hủy</button>
                                    </div>
                                    <div class="col-md-12">
                                        <input id="open_hidden" type="text" class="form-control form-control-line" value="<?php echo substr($shop["Open"], 0, 5); ?>" readonly>
                                        <input id="hour_open" name="shop-hour-open" type="text" class="form-control form-control-line love" placeholder="Giờ">
                                        <input id="minute_open" name="shop-minute-open" type="text" class="form-control form-control-line love" placeholder="Phút">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                            <form id="close-form" class="form-horizontal form-material" action="./query/update_shop_close.php" method="post">
                                <input type="hidden" name="id-shop" value="<?php echo $id_shop; ?>">
                                <div class="form-group">
                                    <label class="col-md-7">Giờ đóng cửa</label>
                                    <div class="col-md-5 my-right">
                                        <button type="button" id="edit_close_btn" class="my-btn" onclick="editShopClose()"><i class="fa fa-edit"></i></button>
                                        <button id="accept_close_btn" class="btn btn-success btn-xs change-btn" onclick="acceptChangeClose()" type="button">Thay đổi</button>
                                        <button id="reject_close_btn" class="btn btn-warning btn-xs change-btn" onclick="rejectChangeClose()" type="button">Hủy</button>
                                    </div>
                                    <div class="col-md-12">
                                        <input id="close_hidden" type="text" class="form-control form-control-line" value="<?php echo substr($shop["Close"], 0, 5); ?>" readonly>
                                        <input id="hour_close" name="shop-hour-close" type="text" class="form-control form-control-line love" placeholder="Giờ">
                                        <input id="minute_close" name="shop-minute-close" type="text" class="form-control form-control-line love" placeholder="Phút">
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
    <script src="../js/my-js/shop_info_script.js"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vendor/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="image/shortcut.png">
    <title>dkdshop.vn</title>
</head>
<style>
    .select_product{
        padding: 1% 38%;
    }
</style>
<body>
    <!--Header-->
    <div class="nav-bar">
        <a href="laucher.php" class="brand">
            <span>dkdshop.vn</span>
        </a>
        <span class="ms-5 ">
            <input type="text" class="ms-5 search-tool" placeholder="Bạn đang tìm gì?">
            <i class="fas fa-search  search-icon"></i>
        </span>
        <ul class="menu">
            <li> <a href="laucher.php">Home</a> </li>

            <li><a href="laucher.php?cmd=product">Sản phẩm</a></li>

            <li> <a href="laucher.php?cmd=shoppingcart"><span class="icon"><i class="fa fa-shopping-cart"></i></span> </i>Giỏ
                    Hàng</a></li>

            <li><a href="laucher.php?cmd=user"> <i class="fa fa-user"></i> <?php if(isset($_SESSION['loginstatus']) && $_SESSION['loginstatus']==true) echo $_SESSION['loginname'];else echo 'Đăng nhập';?></a></li>
        </ul>
    </div>
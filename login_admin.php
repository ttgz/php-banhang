<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <style>
        form{
            width: 60%;
            margin: 2% auto;
            border: 1px solid grey;
            padding: 5%;
        }
    </style>
<body>
    <form action="login_admin.php" method="POST">
        <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
              <input type="text" name="username_admin" class="form-control-plaintext" placeholder=" " value="">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input type="password" name="password_admin"class="form-control" id="inputPassword" value="">
            </div>
          </div> 
          <div class="text-center">
                <button type="submit" name="sbm_admin"class="btn btn-success">Đăng nhập</button>
          </div>
          <a href="index.php" style="color:grey; text-decoration:none;">Đăng nhập bằng tài khoản client</a>
    </form> 
</body>
</html>

<?php 
    require('function_admin.php');
   
    $username = '';
    $password = '';
    $_SESSION['loginstatus_admin']=false;
    if(isset($_POST['sbm_admin']))
    {
      $username = $_POST['username_admin'];
      $password = $_POST['password_admin'];
    }


    if($f_admin->login($username,$password))
       header('location:index_admin.php');
    
      
?>

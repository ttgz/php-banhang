<?php
 
    require('function.php');
    //nếu loginstatus = true, đăng nhập thành công
    
    if($_SESSION['loginstatus'])
    {
        isset($_GET['cmd'])?$cmd=$_GET['cmd']:$cmd = 'main';
        if(isset($_GET['sbm_change']))
            $cmd=$_GET['sbm_change'];
        $f->logout('cmd','logout');
        include('nav.php');
        include($cmd.'.php');
        include('footer.php');    
    }
    else//nếu loginstatus = false, chưa đăng nhập
    {     
        $_SESSION['loginstatus'] = false;
        isset($_GET['cmd'])?$cmd=$_GET['cmd']:$cmd = 'main';
        include('nav.php');
        //khi click vào user thì chuyển qua user_login
        //khi click tạo tài khoản trong user_login thì chuyển qua taotaikhoan
          
        include($cmd.'.php');
        include('footer.php');    
    }   
   
?>
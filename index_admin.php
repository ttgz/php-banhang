<?php
    require('function_admin.php');

  
    if($_SESSION['loginstatus_admin'])
    {
        isset($_GET['cmd'])? $cmd=$_GET['cmd']:$cmd ='content';
        isset($_GET['action'])?$action=$_GET['action']:$action='';
        if($cmd == 'taikhoan' or $cmd =='content')
        {
            if($cmd =='content')
                $action = 'admin';
            $cmd = $cmd.'_'.$action;
        }
        $f_admin->logout('cmd','logout');
        include('nav_admin.php');
        include('menu_admin.php');
        include($cmd.'.php');
        include('footer_admin.php');
    }
    else
        header('location: login_admin.php');
    
?>
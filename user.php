<style>
    .table{
        border: solid 1px black;
        width: 90%;
        margin: 0 auto;
        font-size: 20px;
        
    }
    .logout{
        text-align: center;
    }
    
   
}
</style>
        <?php
            $action = '';
            if(isset($_GET['action']))
                $action = $_GET['action'];
            if($_SESSION['loginstatus'])
            {     
                login_success();
            }    
            else
            {
                switch($action)
                {
                    case 'create_account':
                        create_account(); break;
                    default:
                        login_access();
                    break;
                }
               
            }
                
            function login_success()
            {
                global $f;
                echo ' 
                <main>
                    <div class="product_container" >
                        
                    <table class="table">
                    <tr>
                        <td>User:</td>
                        <td>'.$_SESSION["loginname"].'</td>
                    </tr> 
                    <tr>
                        <td>email:</td>
                        <td>'.$_SESSION["loginemail"].'</td>
                    </tr>
                    <tr>
                        <td>Giới tính:</td>
                        <td>'.$_SESSION["logingioitinh"].'</td>
                    </tr>
                    <tr>
                        <td>So dien thoai: </td>
                        <td>'.$_SESSION["loginphone"].'</td>
                    </tr>
                    <tr  class="logout">
                        <td> <a href="laucher.php?cmd=thaydoithongtin">Thay đổi thông tin</a></td>
                        <td><a href="laucher.php?cmd=logout">Đăng xuất</a></td>        
                    </tr>
                </table>     </div>
                </main>
                ';
            }
            function login_access()
            {
                global $f;
                $_SESSION['loginstatus'] =false;
                $loginstatus=' ';
                if(isset($_POST['sbm']))
                {     
                $email = $_POST['email'];
                $password = $_POST['password'];
                if( $f->login($email,$password)==true)
                    header('location:laucher.php');
                else
                    $loginstatus = "Tên đăng nhập hoặc mật khẩu bị sai!";   
                }
            
                 echo '<form action="laucher.php?cmd=user" method="POST">
                <p class="text-center fs-2">Login</p>
                <p>
                <span class="bg-light  icon_input"><i class="far fa-user"></i>
                    <input type="text" name="email" value="" class="input_id p-2 ms-3 bg-light" placeholder="email id" fdprocessedid="bcaw7g">
                </span>
                </p>
                 <p>
                <span class="bg-light  icon_input"><i class="fas fa-lock"></i>
                    <input type="password" name="password" value="" class="input_id p-2 ms-3 bg-light" placeholder="password" fdprocessedid="6wkkos">
                </span>
                </p>
                <p>
                <button name="sbm" class="btn btn-success px-4 py-2" fdprocessedid="l749xl">Login</button>
                </p>
                <p class="">
                
                <span class="text-end"> 
                    <a href="" class="" style="color:grey"> Quên mật khẩu?</a>
                </span>
                </p>
                <p>
                ';
                  echo $loginstatus;
                  echo'
                </p>
                <p>
                <a href="laucher.php?cmd=user&action=create_account" style="color:grey">Tạo tài khoản</a>
                <p>
                    <a href="laucher.php?cmd=index_admin" style="color:grey">Đăng nhập với quyền admin</a>
                </p>
            </p>
            </form>';
            }
            function create_account(){
                global $f;
                $result_taotaikhoan = '';
                if(isset($_POST['sbm_taotaikhoan']))
                {
                    $email = $_POST['email_create'];  
                    $user = $_POST['name_create'];
                    $password = $_POST['password_create'];
                    $phone = $_POST['phone_create'];
                    //Kiểm tra các trường bị bỏ trống data thì thông báo không đc bỏ trống các trường đấy
                    if($email==''or $user=='' or $password==''or $phone=='')
                    {
                        $rows=2;
                    } else{
                        $sql_kiemtra = "select email from account where email = '{$email}'"; 
                        $result_kiemtra = mysqli_query($f->connect,$sql_kiemtra); //thực hiện truy vấn
                        $rows = mysqli_num_rows($result_kiemtra);       
                    }
                    
                    if($rows==1)
                    {
                        $result_taotaikhoan = 'email đã tồn tại!'; //nếu kết quả truy vấn là 1 (tức là email đã có trên csdl)
                    }elseif($rows==2)
                        $result_taotaikhoan = 'Không được bỏ trống các trường!';
                    else{         
                        $gioitinh = $_POST['gioitinh_create'];
                        $sql_taotaikhoan = "insert into account(email,name,password,gioi_tinh,phone) values ('{$email}','{$user}','{$password}','{$gioitinh}','{$phone}')";
                        $result_sql_taotaikhoan = mysqli_query($f->connect,$sql_taotaikhoan);
                        if($result_sql_taotaikhoan)
                            $result_taotaikhoan = 'Tạo tài khoản thành công!';
                    }
                }
                echo '
                <main>
                    <form action="" method="POST">
                    <table >
                        <h2>Tạo tài khoản</h2>
                            <tr>
                                <td>User:</td>
                                <td><input type="text" name="name_create" value=""/></td>
                            </tr> 
                            <tr>
                                <td>email:</td>
                                <td><input type="email" name="email_create" value=""/></td>
                            </tr>
                            <tr>
                                <td>Giới tính:</td>
                                <td>
                                    <input type="radio" name="gioitinh_create" value="Nam">Nam
                                    <input type="radio" name="gioitinh_create" value="Nữ">Nữ
                                </td>
                            </tr>
                            <tr>
                                <td>Mật khẩu: </td>
                                <td><input type="text" name="password_create" value=""></td>
                            </tr>
                            <tr>
                                <td>Số điện thoại: </td>
                                <td><input type="text" name="phone_create" value=""></td>
                            </tr>
                            <tr>
                                <td> <button type="submit" name="sbm_taotaikhoan" >Tạo tài khoản</button></td>
                                <td> '.$result_taotaikhoan .'</td>
                            </tr>
                        
                        </table>
                    </form>
                </main>
                ';
                if($result_taotaikhoan=='Tạo tài khoản thành công!')
                    echo "<script>
                    alert('{$result_taotaikhoan}')</script>";
            }

            
        ?>
        

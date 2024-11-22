<style>

table{
    width: 80%;
    margin: 0 auto;
     
}
table tr{
    border: 1px solid black;
}
</style>
<main>
    <?php
    $login = true;
    
        if(isset($_POST['sbm'])) 
        {
            $userName=$_POST['username'];
            $passWord=$_POST['password'];

            $sql = "select username, password from admin where username = '{$userName}'";
            $result=mysqli_query($f->connect,$sql);
            $total = mysqli_num_rows($result);
            if($total==1) 
                $login = true;  
        }
        $action = '';
        if(isset($_GET['action']))
            $action = $_GET['action'];
        switch($login)
        {
            case true:
                {
                    echo '<div class="btn-group">
                    <a class="btn btn-secondary"href="laucher.php?cmd=admin&action=manager"> Quản lý</a>
                    <a class="btn btn-success"href="laucher.php?cmd=admin&action=add"> Thêm</a>
                    </div>';
                    switch($action)
                    {
                        
                        case 'add':
                            add();break;
                        default:
                            admin();break;
                    }
                }
                break;
            case false:
                form();break;
        }
       
    ?>
    <?php
    function form(){
        echo ' 
        <form action="" method="POST">
        <input type="text" name="username">
        <input type="text" name="password">
        <button type="submit" name="sbm">Đăng nhập</button>
    </form>';
    }
    function admin()
    {
        global $f;
        $sql = "select * from account";
        $result = mysqli_query($f->connect,$sql);
        echo '
        
        <table border="1">
        <thead>
            <th>STT</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Giới tính </th>
            <th>Phone</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </thead>
        <tbody>';
        $i = 0;
        while($row=mysqli_fetch_assoc($result))
        {   $i++;
             echo '  <tr>
                        <td> '.$i.'</td>
                        <td> '.$row['name'].'</td>
                        <td> '.$row['email'].'</td>
                        <td> '.$row['password'].'</td>
                        <td> '.$row['gioi_tinh'].'</td>
                        <td> '.$row['phone'].'</td>
                        <td> <button class="btn btn-primary"> Sửa</button></td>
                        <td> <button class="btn btn-dangerous"> Xóa</button></td>
            </tr>';
        }
        echo ' </tbody> </table>';
    }
    function add()
    {
        
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
                    $sql_taotaikhoan = "insert into account values ('{$email}','{$user}','{$password}','{$gioitinh}','{$phone}')";
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
</main>


      
   
    

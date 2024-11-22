<style>

table{
   
     margin: 0 auto;
}
table tr{
    border: 1px solid black;
}
</style>
<div id="layoutSidenav_content">
    <main>
    <?php 
        if(isset($_POST['sbm'])) 
        {
            $userName=$_POST['username'];
            $passWord=$_POST['password'];

            $sql = "select username, password from admin where username = '{$userName}'";
            $result=mysqli_query($f_admin->connection,$sql);
            $total = mysqli_num_rows($result);
            if($total==1) 
                $login = true;  
        }
        $action = '';
        if(isset($_GET['action_admin']))
            $action = $_GET['action_admin'];
             if(isset($_SESSION['loginadmin_name']))
                if($_SESSION['loginadmin_name']=='admin')
                {
                   echo '                 
                    <div class="btn-group">
                    <a class="btn btn-secondary"href="index_admin.php?cmd=taikhoan&action=client"> Quản lý</a>
                    <a class="btn btn-success"href="index_admin.php?cmd=taikhoan&action=client&action_admin=add"> Thêm</a>
                    </div>';
                    switch($action)
                    {                      
                        case 'add':
                            add();break;
                        case 'del':
                            del(); break;
                        case 'edit':
                            edit(); break;
                        default:
                            admin();break;
                    }
                }else
                    echo 'Bạn không có quyền truy cập vào tài khoản người dùng!';     
    ?>
    <?php
    function admin()
    {
        global $f_admin;
        $sql = "select * from account";
        $result = mysqli_query($f_admin->connection,$sql);
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
                        <td> <a href="index_admin.php?cmd=taikhoan&action=client&action_admin=edit&id='.$row['id'].'"class="btn btn-primary" type="submit" name="action_admin" value="edit"> Sửa</a></td>
                        <td> <a href="index_admin.php?cmd=taikhoan&action=client&action_admin=del&id='.$row['id'].'"class="btn btn-dangerous" type="submit" name="action" value="del"> Xóa</a></td>
            </tr>';
        }
        echo ' </tbody> </table>';
    }
    function add()
    {
        
            global $f_admin;
            $status_create = false;
            $result_taotaikhoan = '';
            if(isset($_POST['sbm_taotaikhoan']))
            {
                $email = $_POST['email_create'];  
                $user = $_POST['name_create'];
                $password = $_POST['password_create'];
                $phone = $_POST['phone_create'];
                if($password=='')
                    $password = '123';
                //Kiểm tra các trường bị bỏ trống data thì thông báo không đc bỏ trống các trường đấy
                if($email==''or $user=='' or $phone=='')
                {
                    $rows=2;
                } else{
                    $sql_kiemtra = "select email from account where email = '{$email}'"; 
                    $result_kiemtra = mysqli_query($f_admin->connection,$sql_kiemtra); //thực hiện truy vấn
                    $rows = mysqli_num_rows($result_kiemtra);       
                }
                
                if($rows==1)
                {
                    $result_taotaikhoan = 'email đã tồn tại!'; //nếu kết quả truy vấn là 1 (tức là email đã có trên csdl)
                }elseif($rows==2)
                    $result_taotaikhoan = 'Không được bỏ trống các trường!';
                else{
                    $sql_id = "select  id from account group by id desc LIMIT 1";
                    $result = mysqli_query($f_admin->connection,$sql_id);
                    $id = mysqli_fetch_assoc($result);              
                    $id = $id['id'];         
                    $id++;     
                    $gioitinh = $_POST['gioitinh_create'];
                    $sql_taotaikhoan = "insert into account values ($id,'{$email}','{$user}','{$password}','{$gioitinh}','{$phone}')";
                    $result_sql_taotaikhoan = mysqli_query($f_admin->connection,$sql_taotaikhoan);
                    if($result_sql_taotaikhoan)
                    {
                        $status_create = true;
                        $result_taotaikhoan = 'Tạo tài khoản thành công!';
                    }                   
                }
            }
            if($status_create==false)
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
            {
                echo "<script>
                alert('{$result_taotaikhoan}')</script>";
                admin();
               
            }
    }
    function del()
    {
        global $f_admin;
        $id = $_GET['id'];
        $status_del =false;
        
        if(isset($_POST['status']))
        {
            if($_POST['status']=='yes')
            {
                $sql_del = "delete from account where id=$id";
                $result_del = mysqli_query($f_admin->connection,$sql_del);
                echo '<script> alert("Xóa tài khoản thành công")</script>';
                $status_del =true;
                admin();
            }
            else
            {
                $status_del =true;
                admin();
                 
            }
                
        }
        if($status_del==false)
            echo ' <main class="text-center"><form action="" method="post"> <p> Bạn chắc chắn muốn xóa?</p> <button class="btn btn-primary me-2"type="submit" name="status" value="yes"> yes</button><button class="btn btn-success" type="submit" name="status" value="no"> No</button></form> </main>';          
    }
    function edit()
    {
        global $f_admin;
        $id = $_GET['id'];
        
        
        if(isset($_POST['sbm_change_admin']))
        {
            $name= $_POST['name'];
            $email= $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $gioitinh =$_POST['gioitinh'] ;
            $sql_change = "update account set name='{$name}', email='{$email}',password='{$password}',phone='{$phone}',gioi_tinh='{$gioitinh}' where id = $id";
            $result = mysqli_query($f_admin->connection,$sql_change);
            echo 'update thành công';
        }  
        $sql = "select * from account where id = {$id}";
        $result = mysqli_query($f_admin->connection,$sql);
        $rows = mysqli_fetch_assoc($result);
        if($rows['gioi_tinh']=='Nam')
        {
            $checkMale = 'checked';
            $checkFemale ='';
        }         
        if($rows['gioi_tinh']=='Nữ')
        {
            $checkFemale ='checked';
            $checkMale = '';
        }
        echo '
        <main>
        <form action="" method="POST">
        <table>
            <tr>
                <td><span>Name</span></td> <td><input type="text" name="name" value="'.$rows['name'].'"> </td>
            </tr>
            <tr>
                <td><span>email</span></td> <td><input type="text" name="email" value="'.$rows['email'].'"> </td>
            </tr>
            <tr>
                <td><span>password</span></td> <td><input type="text" name="password" value="'.$rows['password'].'"></td>
            </tr>
            <tr>
                <td><span>phone</span></td><td><input type="text" name="phone"value="'.$rows['phone'].'"></td>
            </tr>
            <tr>
                <td><span>Giới tính</span></td><td> <input type="radio" name="gioitinh" value="Nam" '.$checkMale.'> <label for="gioitinh">Nam</label>
                                                    <input type="radio" name="gioitinh" value="Nữ" '.$checkFemale.'> <label for="gioitinh">Nữ</label></td>
            </tr>
            <tr> <td> <button type="submit" name="sbm_change_admin">Thay đổi</button></td></tr>
        </table> </form> </main>
        ';
    }
    ?>     
   </form>
 </main>
</div>
<?php
    //khi nhấn vào submit
    if(isset($_GET['sbm_change']))
    {
        $user = $_GET['name_change'];
        $email = $_GET['email_change'];
        $passwordold = $_GET['password'];
        $passwordnew = $_GET['password_change'];
        $phone =  $_GET['phone_change'];
        $gioitinh =  $_GET['gioitinh_change'];
        if($passwordold=='')
            $textPass = 'Phải nhập mật khẩu!';
        else 
            $textPass = '';
        if($passwordnew=='') //nếu trường new pass bỏ trống thì gán newpass là pass cũ
            $passwordnew =  $passwordold;
        if($passwordold==$_SESSION['loginpassword']) //nếu password trong trường nhập trùng với pass trong csdl thì thực thi cập nhật data
        {
            //tạo câu lệnh truy vấn
            $sql = "update account set password = '{$passwordnew}', name = '{$user}', gioi_tinh= '{$gioitinh}', phone ='{$phone}' where email = '{$email}'";
            $result = mysqli_query($f->connect,$sql); //thực hiện truy vấn cập nhật data
        }
        else
            $result = false;
        //truy vấn dữ liệu đã thay đổi để xuất dữ liệu ra các field input
        $sql = "select email,password,name,phone,gioi_tinh from account where email = '{$email}'";
        $result_query = mysqli_query($f->connect,$sql);
        $row = mysqli_fetch_assoc($result_query);
        $_SESSION['loginname'] = $row['name'];       
        $_SESSION['loginemail'] = $row['email'];       
        $_SESSION['loginphone'] = $row['phone'];       
        $_SESSION['loginpassword'] = $row['password'];
        $_SESSION['logingioitinh'] = $row['gioi_tinh'];
    }   
   

?>

<main>
    <form action="laucher.php" method="GET">
        <table >
            <tr>
                <td>User:</td>
                <td><input type="text" name="name_change" value="<?php echo $_SESSION["loginname"] ?>"></td>
            </tr> 
            <tr>
                <td>email:</td>
                <td><input type="email" name="email_change" value="<?php echo $_SESSION["loginemail"] ?>"></td>
            </tr>
            <tr>
                <td>Giới tính:</td>
                <td><input type="radio" name="gioitinh_change" value="Nam" <?php if($_SESSION['logingioitinh']=='Nam') echo 'checked';?>>Nam
                <input type="radio" name="gioitinh_change" value="Nữ" <?php if($_SESSION['logingioitinh']=='Nữ') echo 'checked';?>>Nữ </td>
            </tr>
            <tr>
                <td>Mật khẩu: </td>
                <td><input type="text" name="password" value=""></td>
            </tr>
            <tr>
                <td>Mật khẩu mới: </td>
                <td><input type="text" name="password_change" value=""></td>
            </tr>
            <tr>
                <td>so dien thoai: </td>
                <td><input type="text" name="phone_change" value="<?php echo $_SESSION["loginphone"] ?>"></td>
            </tr>
            <tr>
                <td> <button type="submit" name="sbm_change" value="thaydoithongtin">Thay đổi</button></td>
                <td><?php  if(isset($result)) 
                            {
                                if($result==1)
                                    echo 'Thay đổi thành công!'; 
                                    
                                else 
                                    echo 'Thay đổi không thành công!'.$textPass;
                            }
                            ?></td>
            </tr>
           
        </table>
    </form>  
</main>
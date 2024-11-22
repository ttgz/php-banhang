<style>
    main{
        width: 90%;
        margin: 0 auto;
    }
    table{
        margin-top:1%;
        min-width: 100%;
        border: 1px solid black;
    }
    table, th, td{
        border: 1px solid black;
        text-align: center;
    }
    .table_add{
        width: 50%;
    }
    .table_add input{
        width: 100%;
    }
</style>
<div id="layoutSidenav_content">
<main>
    <?php 

        echo '<h2> Trang quản lý sản phẩm</h2>';
        echo ' <div class="manager">
                    <a href="index_admin.php?cmd=sanpham_admin&act=quanly" class="btn btn-primary">Quản lý</a>
                    <a href="index_admin.php?cmd=sanpham_admin&act=add" class="btn btn-success">Thêm sản phẩm</a>
                </div>';
        if(isset($_GET['act']))
        {
            $act = $_GET['act'];
            switch($act)
            {
                case 'manager':
                    quanly();
                    break;
                case 'add':
                    them();
                    break;
                case 'edit':
                    sua();
                    break;
                case 'del':
                    xoa();
                    break;
                default:
                    quanly();
                    break;
            }
        }else
            quanly();
        function quanly()
        {
            global $f_admin;
            $sql = "select * from laptop";
            $result = mysqli_query($f_admin->connection,$sql);
            echo ' <table>
            <thead>
            <tr>
            <th>STT</th>
            <th>Mã sản phẩm </th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Màn hình</th>
            <th>CPU</th>
            <th>Ram</th>
            <th>Ổ cứng</th>
            <th>Card màn hình</th>
            <th>PORT</th>
            <th>Hệ điều hành</th>
            <th>Hãng</th>
            <th>Ảnh sản phẩm</th>
            <th colspan="2">Edit</th>
            </tr>
            </thead>
            <tbody>
        ';
            $i = 0;
            while($rows = mysqli_fetch_assoc($result))
            {
                $i++;
                echo ' <tr>
                <td>'.$i.'</td>
                <td>'.$rows['masp'].'</td>
                <td>'.$rows['tensp'].'</td>
                <td>'.$rows['gia'].'</td>
                <td>'.$rows['manhinh'].'</td>
                <td>'.$rows['cpu'].'</td>
                <td>'.$rows['ram'].'</td>
                <td>'.$rows['ocung'].'</td>
                <td>'.$rows['cardmanhinh'].'</td>
                <td>'.$rows['post'].'</td>
                <td>'.$rows['hedieuhanh'].'</td>
                <td>'.$rows['hang'].'</td>
                <td><img style="max-width:50%;"src="upload/'.$rows['anhsp'].'" alt="anhsp"></td>
                <td><a href="index_admin.php?cmd=sanpham_admin&act=edit&masp='.$rows["masp"].'" class="btn btn-danger">Sửa</a></td>
                <td><a href="index_admin.php?cmd=sanpham_admin&act=del&masp='.$rows["masp"].'" class="btn btn-warning">Xóa</a></td>
            </tr>';
            }
            echo ' </tbody>
    
    
            </table> ';
        }
        function them(){
            global $f_admin;
            if(isset($_POST['sbm_them']))
            {
                $masp = $_POST['masp'];
                $tensp = $_POST['tensp'];
                $gia = $_POST['gia'];
                $manhinh = $_POST['manhinh'];
                $cpu = $_POST['cpu'];
                $ram = $_POST['ram'];
                $ocung = $_POST['ocung'];
                $cardmanhinh = $_POST['cardmanhinh'];
                $port = $_POST['port'];
                $hedieuhanh = $_POST['hedieuhanh'];
                $hang = $_POST['hang'];
                $anhsp = $f_admin->upload('anhsp');
               

                if($masp == '')
                     echo '<span style="color:red;">Thêm sản phẩm không thành công! </span>';
                else{
                    $sql_check_masp = "select masp from laptop where masp = $masp";
                    $sql_query_check_masp = mysqli_query($f_admin->connection,$sql_check_masp);
                    $sql_query_check_masp = mysqli_num_rows( $sql_query_check_masp);
                    
                    if( $sql_query_check_masp!=0)
                        echo 'Mã sản phẩm đã tồn tại!';
                    else{
                    $sql_add = "insert into laptop values($masp,'{$tensp}','{$gia}','{$manhinh}','{$cpu}','{$ram}','{$ocung}','{$cardmanhinh}','{$port}','{$hedieuhanh}','{$hang}','{$anhsp}')";
                    $result_add = mysqli_query($f_admin->connection,$sql_add);
                }
            }           
               
            }
            $sql_query_masp = "select masp from laptop order by masp desc limit 1";
            $result_query_masp = mysqli_query($f_admin->connection,$sql_query_masp);
            $result_query_masp = mysqli_fetch_assoc( $result_query_masp);
            $result_query_masp =  $result_query_masp['masp'];
            echo ' <span> Mã sản phẩm gần nhất : '.$result_query_masp.' </span>
            <form class="table_add" action="" method="post" enctype="multipart/form-data">
            <table >
                <tr>
                    <td>Mã sản phẩm</td>
                    <td><input name="masp" type="number"></td>
                </tr>
                <tr>
                    <td>Tên sản phẩm</td>
                    <td><input name="tensp" type="text"></td>
                </tr>
                <tr>
                    <td>Giá</td>
                    <td><input name="gia"type="text"></td>
                </tr>
                <tr>
                    <td>Màn hình </td>
                    <td><input name="manhinh" type="text"></td>
                </tr>
                <tr>
                    <td>CPU</td>
                    <td><input name="cpu"type="text"></td>
                </tr>
                <tr>
                    <td>Ram</td>
                    <td><input name="ram"type="text"></td>
                </tr>
                <tr>
                    <td>Ổ cứng</td>
                    <td><input name="ocung"type="text"></td>
                </tr>
                <tr>
                    <td>Card màn hình</td>
                    <td><input name="cardmanhinh"type="text"></td>
                </tr>
                <tr>
                    <td>PORT</td>
                    <td><input name="port"type="text"></td>
                </tr>
                <tr>
                    <td>Hệ điều hành</td>
                    <td><input name="hedieuhanh"type="text"></td>
                </tr>
                 <tr>
                    <td>Hãng sản xuất</td>
                    <td><input name="hang"type="text"></td>
                </tr>
                <tr>
                    <td>Ảnh sản phẩm</td>
                    <td><input name="anhsp"type="file"></td>
                </tr>
                <tr>
                    
                    <td colspan="2"><button class="btn btn-success"type="submit" name="sbm_them"> Thêm</button></td>
                </tr>
            </table>
        </form>
        ';
        }
        function sua(){
            global $f_admin;
            $masp = $_GET['masp'];
          

            if(isset($_POST['sbm_sua']))
            {     
                $tensp = $_POST['tensp'];
                $gia = $_POST['gia'];
                $manhinh = $_POST['manhinh'];
                $cpu = $_POST['cpu'];
                $ram = $_POST['ram'];
                $ocung = $_POST['ocung'];
                $cardmanhinh = $_POST['cardmanhinh'];
                $port = $_POST['port'];
                $hedieuhanh = $_POST['hedieuhanh'];
                $hang = $_POST['hang'];
                $anhsp =  $f_admin->upload('anhsp');
                
                $sql_update_item = "update laptop set tensp = '$tensp', gia = '$gia', manhinh='$manhinh', cpu = '$cpu',ram='$ram',ocung='$ocung',cardmanhinh='$cardmanhinh',post='$port',hedieuhanh='$hedieuhanh',hang='$hang',anhsp='$anhsp' where masp = $masp";
                $sql_query = mysqli_query($f_admin->connection,$sql_update_item);
                if( $sql_query)
                    echo '<span style="color:green";>Sửa sản phẩm thành công! </span>';
                else
                    echo 'Sửa không thành công!';
            }
            $sql_query_all = "select * from laptop where masp = $masp";
            $sql_result_all = mysqli_query($f_admin->connection,$sql_query_all);
            $rows = mysqli_fetch_assoc($sql_result_all);
            echo '
            <form class="table_add" action="" method="post" enctype="multipart/form-data">
            <table >
                <tr>
                    <td>Mã sản phẩm</td>
                    <td><input name="masp" type="reset" value="'.$rows['masp'].'"></td>
                </tr>
                <tr>
                    <td>Tên sản phẩm</td>
                    <td><input name="tensp" type="text" value="'.$rows['tensp'].'"></td>
                </tr>
                <tr>
                    <td>Giá</td>
                    <td><input name="gia"type="text" value="'.$rows['gia'].'"></td>
                </tr>
                <tr>
                    <td>Màn hình </td>
                    <td><input name="manhinh" type="text" value="'.$rows['manhinh'].'"></td>
                </tr>
                <tr>
                    <td>CPU</td>
                    <td><input name="cpu"type="text" value="'.$rows['cpu'].'"></td>
                </tr>
                <tr>
                    <td>Ram</td>
                    <td><input name="ram"type="text" value="'.$rows['ram'].'"></td>
                </tr>
                <tr>
                    <td>Ổ cứng</td>
                    <td><input name="ocung"type="text" value="'.$rows['ocung'].'"></td>
                </tr>
                <tr>
                    <td>Card màn hình</td>
                    <td><input name="cardmanhinh"type="text" value="'.$rows['cardmanhinh'].'"></td>
                </tr>
                <tr>
                    <td>PORT</td>
                    <td><input name="port"type="text" value="'.$rows['post'].'"></td>
                </tr>
                <tr>
                    <td>Hệ điều hành</td>
                    <td><input name="hedieuhanh"type="text" value="'.$rows['hedieuhanh'].'"></td>
                </tr>
                <tr>
                    <td>Hãng sản xuất</td>
                    <td><input name="hang"type="text" value="'.$rows['hang'].'"></td>
                </tr>
                <tr>
                    <td>Ảnh sản phẩm</td>
                    <td><input name="anhsp"type="file" value="'.$rows['anhsp'].'"></td>
                </tr>
                <tr>
                    
                    <td colspan="2"><button class="btn btn-success"type="submit" name="sbm_sua"> Sửa</button></td>
                </tr>
            </table>
        </form>
            ';
        } 
        function xoa(){
            global $f_admin;
            $masp = $_GET['masp'];
            $status_del =false;
            
            if(isset($_POST['status']))
            {
                if($_POST['status']=='yes')
                {
                    $sql_del = "delete from laptop where masp=$masp";
                    $result_del = mysqli_query($f_admin->connection,$sql_del);
                    echo '<script> alert("Xóa sản phẩm thành công")</script>';
                    $status_del =true;
                    quanly();
                }
                else
                {
                    $status_del =true;
                    quanly();
                     
                }           
            }
            if($status_del==false)
                echo ' <main class="text-center"><form action="" method="post"> <p> Bạn chắc chắn muốn xóa?</p> <button class="btn btn-primary me-2"type="submit" name="status" value="yes"> yes</button><button class="btn btn-success" type="submit" name="status" value="no"> No</button></form> </main>';
        }
    ?>
</main>
</div>
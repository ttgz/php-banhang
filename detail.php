<main>
         <div class="product_detail">
         <?php 
                $masp = $_GET['masp'];
                $sql = "select * from laptop where masp = $masp";
                $result = mysqli_query($f->connect,$sql);
                $rows = mysqli_fetch_assoc($result);
            ?>
            <div class="item_pic">
                <div class="pic_top">
                    <img src="upload/<?php echo $rows['anhsp']?>" alt="anhsp">
                </div>
                <div class="pic_bot">
                    <div class="pic_bot_des">
                    <img src="upload/<?php echo $rows['anhsp']?>" alt="anhsp">
                    </div>
                    <div class="pic_bot_des">
                    <img src="upload/<?php echo $rows['anhsp']?>" alt="anhsp">
                    </div>
                    <div class="pic_bot_des">
                    <img src="upload/<?php echo $rows['anhsp']?>" alt="anhsp">
                    </div>
                    <div class="pic_bot_des">
                    <img src="upload/<?php echo $rows['anhsp']?>" alt="anhsp">
                    </div>
                </div>
            </div>
           
            <div class="item_info">
                <p class="name_item_detail"><?php echo $rows['tensp'];?></p>
                <p class="prict_item"> <span> <?php echo $rows['gia'];?>đ </span><span class="px-3 text-decoration-line-through"> </span> </p>
                <p class="des_item">
            
                    </p><table cellpadding="5">
                        <tbody><tr>
                            <td colspan="2" style="font-weight:bolder">Thông số kỹ thuật</td>
                        </tr>
                        <tr>
                            <td>Màn hình: </td>
                            <td><?php echo $rows['manhinh'];?></td>
                        </tr>
                        <tr>
                            <td>CPU: </td>
                            <td><?php echo $rows['cpu'];?></td>
                        </tr>
                        <tr>
                            <td>RAM: </td>
                            <td><?php echo $rows['ram'];?></td>
                        </tr>
                        <tr>
                            <td>Ổ cứng: </td>
                            <td><?php echo $rows['ocung'];?></td>
                        </tr>
                        <tr>
                            <td>Card màn hình: </td>
                            <td><?php echo $rows['cardmanhinh'];?></td>
                        </tr>
                        <tr>
                            <td>Cổng kết nối: </td>
                            <td><?php echo $rows['post'];?></td>
                        </tr>
                        <tr>
                            <td>Hệ điều hành:</td>
                            <td><?php echo $rows['hedieuhanh'];?></td>
                        </tr>
                    </tbody></table>
                    <p class="local_button">
                        <button class="button_detail_l">Thêm vào giỏ hàng</button>
                        <button class="button_detail_r">MUA NGAY</button>
                    </p>
                <p></p>
            </div>
         </div>
         <div class="product">
            <h2> <span class="name_product">Sản phẩm tương tự</span> </h2>
            <?php 
                $sql = "select * from laptop ";
                $sql_query = mysqli_query($f->connect,$sql);
                while($rows_same = mysqli_fetch_assoc($sql_query))
                {
                    if($rows['masp']==$rows_same['masp'])
                    {
                        continue;
                    }else
                    echo '
                    <div class="item">
                        <a href="?cmd=detail&masp='.$rows_same['masp'].'">  <img class="mw-100" src=" upload/'.$rows_same['anhsp'].'" alt=""></a>
                        <p class="name_item"> <a href="?cmd=detail&masp='.$rows_same['masp'].'"> '.$rows_same['tensp'].'</a></p>
                        <p class="prict_item"> <a href=" ?cmd=detail&masp='.$rows_same['masp'].'"> '.$rows_same['gia'].'</a></p>
                        <button class="button">Thêm vào giỏ</button>
                    </div>
                ';
                }
               
            ?>  
         </div>
    </main>
<main>
    <div class="product_container">
    <div class="row mt-4">
                <div class="col">
                    <a href="laucher.php?cmd=product">
                        <p class="select_product fs-3 text-success">
                            Laptop
                        </p>
                    </a>
                </div>
                <div class="col">
                    <a href="laucher.php?cmd=product_dt">
                        <p class="select_product fs-3">
                            Điện thoại
                        </p>
                    </a>
                </div>
                <div class="row">
                <div class="product">
                                <div class="content">
                                <h2> <span class="name_product">LAPTOP</span> </h2>
                    <?php 
                        $sql = "select * from laptop";
                        $result = mysqli_query($f->connect,$sql);
                        while($rows=mysqli_fetch_assoc($result))
                        {
                            echo'
          
                                    <div class="item">
                                        <a href="laucher.php?cmd=detail&masp='.$rows['masp'].'"> <img class="mw-100" src="upload/'.$rows['anhsp'].'"
                                                alt=""></a>
                                        <p class="name_item"> <a href="laucher.php?cmd=detail&masp='.$rows['masp'].'"> '.$rows['tensp'].'</a></p>
                                        <p class="prict_item"> <a href="laucher.php?cmd=detail&masp='.$rows['masp'].'">'.$rows['gia'].'</a></p>
                                        <button class="button">Thêm vào giỏ</button>
                                    </div>
                                    
                               ';
                        } 
                    ?>
                     </div>
                            </div>
                </div>

            </div>

    </div>
</main>
<main>
        <div class="product_container">
            <!--SlideShow banner-->
            <div class="banner">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./image/banner_1.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="./image/banner_2.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="./image/banner_3.jpg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>

        <!--Product content-->
        <div class="product">
            <div class="content">
                <h2> <span class="name_product">LAPTOP</span> </h2>
                <?php 
                    $sql_request = "select * from laptop";
                    $sql_query = mysqli_query($f->connect,$sql_request);
                    while($rows = mysqli_fetch_assoc($sql_query))
                    {
                        echo ' <div class="item">
                        <a href="laucher.php?cmd=detail&masp='.$rows['masp'].'"> <img class="mw-100" src="upload/'.$rows['anhsp'].'" alt=""></a>
                        <p class="name_item"><a href="laucher.php?cmd=detail&masp='.$rows['masp'].'">  '.$rows['tensp'].'</a></p>
                        <p class="prict_item"> <a href="laucher.php?cmd=detail&masp='.$rows['masp'].'">'.$rows['gia'].' </a><span>  </span>
                         </a></p>
                        <button class="button">Thêm vào giỏ</button>
                        
                    </div>';
                    }
                ?>
                 
                 
                <p class="foot_product"> <span class="more"> <a href="product.index.html">Xem tất cả</a> </span></p>
            </div>
            <h2> <span class="name_product">ĐIỆN THOẠI</span> </h2>
            <div class="item">
                <a href=""> <img class="mw-100" src="./image/smartphone_1.png" alt=""></a>
                <p class="name_item"> <a href=" ">Iphone 14 pro max </a></p>
                <p class="prict_item"><a href=" "> 26.480.000₫</a></p>
                <button class="button">Thêm vào giỏ</button>
            </div>
            
            <p class="foot_product"> <span class="more"> <a href="product_dt.index.html">Xem tất cả</a> </span></p>
        </div>
        </div>
    </main>
    <!--footer-->
<?php
include 'config/header.php';
include 'config/functions.php'; 
?>

    <div class="slider-area">
        	<!-- Slider -->
			<div class="block-slider block-slider4">
				<ul class="" id="bxslider-home4">
					<li>
						<img src="/thecart/assets/img/peter.jpg" alt="Slide">
						<div class="caption-group">
							<a class="caption button-radius" href="shop"><span class="icon"></span>แสดงรายการอาหาร</a>
						</div>
					</li>
					<li>
						<img src="/thecart/assets/img/peter01.jpg" alt="Slide">
						<div class="caption-group">
							<a class="caption button-radius" href="shop"><span class="icon"></span>แสดงรายการอาหาร</a>
						</div>
					</li>
				</ul>
			</div>
			<!-- ./Slider -->
    </div> <!-- End slider area -->
    
    <div class="promo-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo1">
                        <i class="fa fa-refresh"></i>
                        <p>เสริฟถีงโต้ะ</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo2">
                        <i class="fa fa-truck"></i>
                        <p>ราคาประหยัด</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo3">
                        <i class="fa fa-lock"></i>
                        <p>ปลอดภัย</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo4">
                        <i class="fa fa-gift"></i>
                        <p>เมนูเข้าสดใหม่ทุกวัน</p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End promo area -->
    
    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">เมนูสุดฮิต</h2>
                        <div class="product-carousel">
                            <?php
                            $products = new DB_con();
                            $sql = $products->fetchdataproduct_index();
                            $rowcount=mysqli_num_rows($sql);
                                if($rowcount<=0){
                                echo "<div class=\"alert alert-warning\">ไม่พบเมนู</div>";
                                }
                                else{
                            while($row = mysqli_fetch_array($sql)) 
                            {
                                
                            ?>
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="/thecart/dbadmin/assets/img/product/<?php echo $row['product_img_name']; ?>"  alt="">
                                    <?php if($row['qty']>=1) : ?>
                                    <div class="product-hover">
										<p class="card-text add-to-cart-link"><span class="badge badge-secondary" style="background-color:#000000">คงเหลือจำนวน <?php echo $row['qty']; ?></span></p>
                                        <a href="config/updatecart.php?catId=<?php echo $catId; ?>&itemId=<?php echo $row['id']; ?>" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i>หยิบใส่ตระกร้า</a>
                                    </div>
                                    <?php endif; ?> 
                                    <?php if($row['qty']<=0) : ?>
                                        <div class="product-hover">
											<p class="card-text add-to-cart-link"><span class="badge badge-secondary" style="background-color:red">เมนูหมด</span></p>
                                        </div>
                                    <?php endif; ?> 
                                </div>
                                
                                <h2><a href="single-product?id=<?php echo $row['id']; ?>"><?php echo $row['product_name']; ?></a></h2>
                                
                                <div class="product-carousel-price">
                                    <ins><?php echo number_format($row['product_price'],2); ?> บาท</ins>
                                </div> 
                            </div>
                            <?php } }?>	
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->
    
    <?php include 'config/footer.php' ?>
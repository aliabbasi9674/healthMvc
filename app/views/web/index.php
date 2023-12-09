<?php require APPROOT.'/views/includes/web/header.php' ?>

<?php require APPROOT.'/views/includes/web/navbar.php' ?>

<div class="container">


    <main role="main">
        <div class="mt-5">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="<?php echo URLROOT ?>/image/slider-1.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="<?php echo URLROOT ?>/image/slider-2.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="<?php echo URLROOT ?>/image/slider-3.jpg" alt="Third slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="<?php echo URLROOT ?>/image/slider-4.jpg" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>


        <section class="section-products">
            <div class="container">
                <div class="row justify-content-center text-center bg-title-product">
                    <div class="col-md-8 col-lg-6">
                        <div class="header">
                            <h3>محصولات</h3>
                            <h2>لیست کالا ها</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group text-right">
                            <label for="" class="text-primary">مرتب سازی محصولات</label>
                            <select onchange="sort()" id="selectSort" class="form-control">
                                <option value="new">جدیدترین</option>
                                <option value="old">قدیمی ترین</option>
                                <option value="min">ارزان ترین</option>
                                <option value="max">گران ترین</option>
                                <option value="name">نام محصول</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row my-5" id="products-container">
                    <!-- Single Product -->
                    <?php foreach ($data['products'] as $product) : ?>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="<?php echo URLROOT ?>/cart/show/<?php echo $product->id ?>">
                        <div class="single-product">
                            <div class="part-1" style="border: 1px solid #ddd;background: url(<?php echo URLROOT; ?>/upload/image/<?php echo $product->image ?>) no-repeat center; background-size: cover;">
                               <?php echo $product->discount==1  ? '<span class="discount">'.DISCOUNT.'% تخفیف</span>' :  "" ;  ?>
                            </div>
                            <div class="part-2">
                                <h3 class="product-title"><?php echo $product->name?></h3>
                                <?php echo $product->discount==1  ? ' <h4 class="product-old-price">'.$product->price.'</h4>' :  "" ;  ?>
                                <h4 class="product-price">  <?php echo price($product)?> تومان </h4>
                            </div>
                        </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>
</div>
<?php require APPROOT.'/views/includes/web/footer.php' ?>

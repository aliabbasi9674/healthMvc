<?php

class Products extends Controller
{
    public function __construct()
    {
        $this->productModel = $this->model('Product');
    }

    public function index()
    {

        $products = $this->productModel->getProduct();
        $data = [
            'products' => $products
        ];
        $this->view('product', $data);
    }

    public function edit($id)
    {

    }

    public function sort()
    {
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'new';
        $products = $this->productModel = $this->model('Product')->sort($sort);
        foreach ($products as $product) {
            ?>
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
            <?php
        }
    }

}

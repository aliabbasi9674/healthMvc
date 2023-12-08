<?php

class Web extends Controller
{
    public function __construct()
    {
//        echo "Pages Load";
        $this->productModel = $this->model('Product');
    }

    public function index()
    {
        $products = $this->productModel->getProduct();
        $data = [
            'title' => 'healthMvc',
            'products' => $products
        ];
        $this->view('web/index', $data);
    }

    public function about()
    {
        $this->view('web/about');
    }
}

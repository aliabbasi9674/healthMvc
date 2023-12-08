<?php


class Cart extends Controller {

    public function __construct()
    {
    }

    public function index(){
        $data=[
            'phone_err' =>'',
            'code_err' =>'',
        ];
        $this->view('/web/cart',$data);
    }
    public function show($id){
        $product = $this->model('Product')->show($id);

        $data = [
            'product' => $product,
            'phone_err' =>'',
            'code_err' =>'',
        ];

        $this->view('web/cart', $data);
    }
}

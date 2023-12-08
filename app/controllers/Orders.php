<?php


class Orders extends Controller
{
    private $redis;


    public function index(){

    }
    public function store()
    {
        $product = $this->model('Product')->getProductById($_POST['product_id']);
        $productUser = $this->model('Product')->getUserProductById($_POST['product_id'], trim($_POST['phone']));

        $data = [
            'product' => $product,
            'phone' => trim($_POST['phone']),
            'price' => price($product),
            'code' => trim($_POST['code']),
            'phone_error' => '',
            'code_error' => '',
        ];
        // Validate Data
        if (empty($data['phone'])) {
            $data['phone_error'] = 'فیلد نام شماره همراه الزامی است';
        }
        if (empty($data['code'])) {
            $data['code_error'] = 'فیلد کد محصول الزامی است';
        } else {
            if ($product->code != $data['code']) {
                $data['code_error'] = 'فیلد کد محصول با کد وارد شده اشتباه است';
            }
        }

        // Make sure no errors
        if (empty($data['phone_error']) && empty($data['code_error'])) {

            //check discount
            if (empty($productUser)) {
                //check amount
                if ($product->amount>0){
                    if ($this->model('Order')->add($data)) {

                        //decrease one amount product
                        $this->model('Product')->counter($product->id);

                        flash('order_message', 'خرید شما باموفقیت انجام شد.');
                        redirect('orders/buy');
                    } else {
                        die('add product error');
                    }
                }else{
                    flash('order_message', 'محصول مورد نظر ناموجود است', 'alert alert-danger');
                    $this->view('web/cart', $data);
                }

            } else {
                flash('order_message', 'کاربر گرامی شما فقط تنها یک بار می تواند از کالای تخفیف دار استفاده کنید', 'alert alert-danger');
                $this->view('web/cart', $data);
            }


        } else {
            // Load view with error
            $this->view('web/cart', $data);
        }
    }

    public function buy()
    {
        $this->view('/web/buy');
    }
}

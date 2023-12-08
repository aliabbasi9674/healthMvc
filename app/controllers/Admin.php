<?php

class Admin extends Controller
{

    public function __construct()
    {

        $this->adminModel = $this->model('User');
    }

    public function register()
    {
        //check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Process Form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //init data
            $data = [
                'name' => trim($_POST['name']),
                'phone' => trim($_POST['phone']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'name_error' => '',
                'phone_error' => '',
                'email_error' => '',
                'pass_error' => '',
            ];

            //validate name
            if (empty($data['name'])) {
                $data['name_error'] = "لطفا نام خود را وارد کنید.";
            }

            if (empty($data['phone'])) {
                $data['phone_error'] = "لطفا شماره همراه خود را وارد کنید.";
            }
            //validate email
            if (empty($data['email'])) {
                $data['email_error'] = "لطفا ایمیل خود را وارد کنید.";
            }
            //validate password
            if (empty($data['password'])) {
                $data['pass_error'] = "لطفا پسورد خود را وارد کنید.";
            } elseif (strlen($data['password']) < 6) {
                $data['pass_error'] = "پسورد باید بیشتر از 6 کاراکتر باشد.";
            }

            //make sure errors empty
            if (empty($data['name_error']) && empty($data['email_error']) && empty($data['pass_error'])) {

                if ($this->adminModel->findUserByEmail($data['email'])) {
                    $data['email_error'] = "ایمیل قبلا انتخاب شده";
                } else {
                    //validated

                    //Hash Password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    //Register User
                    if ($this->adminModel->register($data)) {
                        flash('register_success', 'شما عضو سایت شده اید و میتوانید وارد پنل شوید.');
                        redirect('');
                    } else {
                        die('error user register');
                    }
                }
            } else {
                //load view register with errors
                $this->view('admin/auth/register', $data);
            }

        } else {
            //init data
            $data = [
                'name' => '',
                'phone' => '',
                'email' => '',
                'password' => '',
                'name_error' => '',
                'phone_error' => '',
                'email_error' => '',
                'pass_error' => '',
            ];
            $this->view('admin/auth/register', $data);
        }
    }

    public function login()
    {
        //check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Process Form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init Data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_error' => '',
                'pass_error' => ''
            ];
            // Validate Email
            if (empty($data['email'])) {
                $data['email_error'] = 'لطفا ایمیل خود را وارد کنید';
            } elseif ($this->adminModel->findUserByEmail($data['email'])) {
                // Check for user/email
                // User Found
            } else {
                // User Not Found
                $data['email_error'] = 'چنین کاربری پیدا نشد';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['pass_error'] = 'لطفا پسورد خود را وارد کنید';
            }

            // Make Sure errors empty
            if (empty($data['email_error']) && empty($data['pass_error'])) {
                // Validated
                $loggedInUser = $this->adminModel->login($data);
                if ($loggedInUser) {

                    // Create session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['pass_error'] = 'پسورد را اشتباه وارد کرده اید';
                    $this->view('admin/auth/login', $data);
                }
            } else {
                // Load VIew Register with errors
                $this->view('admin/auth/login', $data);
            }
        } else {
            //init data
            $data = [
                'email' => '',
                'password' => '',
                'email_error' => '',
                'pass_error' => '',
            ];

            //check login
            if (isLoggedIn()) {
                redirect('');
            }

            $this->view('admin/auth/login', $data);
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;

        redirect('admin/products');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('admin/login');
    }


    public function products()
    {
        if (!isLoggedIn()) {
            redirect('');
        }

        $products = $this->model('Product')->getProduct();
        $data = [
            'products' => $products
        ];
        $this->view('admin/products/index', $data);
    }


    public function productAdd(){

        if (!isLoggedIn()) {
            redirect('');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $discount=isset($_POST['discount']) ? 1 : 0;
            $name_image=$_FILES['image']['name'];
            $tmp_name=$_FILES['image']['tmp_name'];
            $path="upload/image/".basename($_FILES["image"]["name"]);
            //upload image
            move_uploaded_file($tmp_name,$path);

            $data = [
                'name' => trim($_POST['name']),
                'price' => $_POST['price'],
                'image' => $name_image,
                'discount' => $discount,
                'amount' => $_POST['amount'],
                'code' => rand(10000,99999),
                'name_err' => '',
                'price_err' => '',
                'image_err' => '',
                'amount_err' => '',
            ];

            // Validate Data
            if (empty($data['name'])) {
                $data['name_err'] = 'فیلد نام محصول الزامی است';
            }
            if (empty($data['price'])) {
                $data['price_err'] = 'فیلد قیمت محصول الزامی است';
            }

            if (empty($data['image'])) {
                $data['image_err'] = ' تصویر محصول الزامی است';
            }

            // Make sure no errors
            if (empty($data['name_err']) && empty($data['price_err']) && empty($data['image_err'])) {

                if ( $this->model('Product')->add($data)) {
                    flash('product_message', 'محصول مورد نظر اضافه شد');
                    redirect('admin/products');
                } else {
                    die('add product error');
                }

            } else {

                // Load view with error
                $this->view('admin/products/add', $data);
            }
        } else {
            $data = [
                'name' => '',
                'price' => '',
                'image' => '',
                'discount' => '',
                'amount' => '',
                'name_err' => '',
                'price_err' => '',
                'image_err' => '',
                'amount_err' => '',
            ];

            $this->view('admin/products/add', $data);
        }
    }

    public function productShow($id)
    {
        if (!isLoggedIn()) {
            redirect('');
        }
        $product = $this->model('Product')->show($id);

        $data = [
            'product' => $product,
        ];

        $this->view('admin/products/show', $data);
    }

    public function productEdit($id){
        if (!isLoggedIn()) {
            redirect('');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $product = $this->model('Product')->getProductById($id);

            $discount=isset($_POST['discount']) ? 1 : 0;

            if ($_FILES['image']['name']){
                $tmp_name=$_FILES['image']['tmp_name'];
                $path="upload/image/".basename($_FILES["image"]["name"]);
                //upload image
                move_uploaded_file($tmp_name,$path);
            }

            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'price' => $_POST['price'],
                'amount' => $_POST['amount'],
                'image' => $_FILES['image']['name'] ? : $product->image,
                'discount' => $discount,
                'code' => rand(10000,99999),
                'name_err' => '',
                'price_err' => '',
                'image_err' => '',
                'amount_err' => '',
            ];

            // Validate Data
            if (empty($data['name'])) {
                $data['name_err'] = 'فیلد نام محصول الزامی است';
            }
            if (empty($data['price'])) {
                $data['price_err'] = 'فیلد قیمت محصول الزامی است';
            }

            if (empty($data['image'])) {
                $data['image_err'] = ' تصویر محصول الزامی است';
            }
            // Make sure no errors
            if (empty($data['name_err']) && empty($data['price_err']) && empty($data['image_err'])) {

                if ( $this->model('Product')->update($data)) {
                    flash('product_message', 'محصول مورد نظر ویرایش شد');
                    redirect('admin/products');
                } else {
                    die('add product error');
                }

            } else {
                // Load view with error
                $this->view('admin/products/edit', $data);
            }
        } else {

            // Get product
            $product = $this->model('Product')->getProductById($id);

            $data = [
                'id' => $id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'amount' => $product->amount,
                'discount' => $product->discount,
                'name_err' => '',
                'price_err' => '',
                'image_err' => '',
                'amount_err' => '',
            ];

            $this->view('admin/products/edit', $data);
        }
    }


    public function productDelete($id)
    {
        if (!isLoggedIn()) {
            redirect('');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Get product
            $product = $this->model('Product')->getProductById($id);

            if ($this->model('Product')->delete($id)) {
                flash('product_message', 'محصول حذف شد');
                redirect('admin/products/index');
            } else {
                die('Delete Article Error');
            }
        } else {
            redirect('admin/products/index');
        }
    }

    public function orders(){
        if (!isLoggedIn()) {
            redirect('');
        }

        $orders = $this->model('Order')->getOrder();
        $data = [
            'orders' => $orders
        ];
        $this->view('admin/orders/index', $data);
    }

}

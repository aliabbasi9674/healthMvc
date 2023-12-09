<?php


function price($product){
    $price=$product->discount==1 ? $product->price-($product->price*DISCOUNT)/100 : $product->price;
    return $price;
}


function csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

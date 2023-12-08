<?php
function price($product){
    $price=$product->discount==1 ? $product->price-($product->price*DISCOUNT)/100 : $product->price;
    return $price;
}

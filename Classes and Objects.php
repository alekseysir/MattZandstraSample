<?php
class ShopProduct
{
    public $title = "default product";
    public $produserMainName = "main name";
    public $produserFirstName = "first name";
    public $price = 0;
}
$product1 = new ShopProduct();
print $product1->title;
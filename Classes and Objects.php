<?php
class ShopProduct
{
    public $title = "default product";
    public $produserMainName = "main name";
    public $produserFirstName = "first name";
    public $price = 0;

    public function getProduser()
    {
        return $this->produserFirstName." ".$this->produserMainName;
    }
}
$product1 = new ShopProduct();
$product1->title = "My Antonia";
$product1->produserMainName = "Cather";
$product1->produserFirstName= "Willa";
$product1->price = 5.99;
print "Author: {$product1->getProduser()}";
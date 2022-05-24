<?php


class ShopProduct
{
    public  $title;
    public  $producerMainName;
    public  $producerFirstName;
    public  $price;
    public $discount = 0;

    public function __construct(
        $title,
        $producerMainName,
        $producerFirstName,
        $price
    ){
        $this->title = $title;
        $this->producerMainName = $producerMainName;
        $this->producerFirstName = $producerFirstName;
        $this->price = $price;
    }

    public function getProducer() : string
    {
        return $this->producerFirstName." ".$this->producerMainName;
    }
    public function getSummaryLine() : string
    {
        return "$this->title ( $this->producerMainName, $this->producerFirstName )";
    }

    /**
     * @param int $discount
     */
    public function setDiscount(int $discount): void
    {
        $this->discount = $discount;
    }

    /**
     * @return mixed
     */
    public function getPrice(): int|float
    {
        return $this->price-$this->discount;
    }
}
class BookProduct extends ShopProduct
{
    public $numPages;

    public function __construct(
        string $title,
        string $firstName,
        string $mainName,
        float $price,
        int $numPages
    )
    {
        parent:: __construct(
            $title,
            $firstName,
            $mainName,
            $price
        );
        $this->numPages = $numPages;
    }

    public function getNumberOfPages(): int
    {
        return $this->numPages;
    }
    public function getSummaryLine(): string
    {
        return parent::getSummaryLine().": Page count - $this->numPages";
    }
}
class CDProduct extends ShopProduct
{
    public $playLength;
    public function __construct($title, $producerMainName, $producerFirstName, $price, $playLength)
    {
        parent::__construct($title, $producerMainName, $producerFirstName, $price);
        $this->playLength = $playLength;
    }

    public function getPlayLength(): int
    {
        return $this->playLength;
    }
    public function getSummaryLine(): string
    {
        return parent::getSummaryLine().": Play length - $this->playLength";
    }
}

class ShopProductWriter
{
    private $products = [];

    public function addProduct(ShopProduct $shopProduct): void
    {
        $this->products[] = $shopProduct;
    }
    public function write(): void
    {
        $str = "";
        foreach ($this->products as $shopProduct) {
            $str .= "{$shopProduct->title}: ";
            $str .= $shopProduct->getProducer();
            $str .= " ({$shopProduct->getPrice()})<br> ";
        }
        print $str;

    }
}
$book1 = new BookProduct(1111, "My Antonia", "Willa", 5.99, 500);
$CD = new CDProduct("2222", "plagiator", "plagiatorovich", 8.0, 990);
$CD2 = new CDProduct("3333", "pla", "plagiato", 8.0, 990);
$write = new ShopProductWriter;
$write->addProduct($book1);;
$write->addProduct($CD);
$write->addProduct($CD2);
$write->write();




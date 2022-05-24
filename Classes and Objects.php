<?php


class ShopProduct
{
    public int|float $discount = 0;

    public function __construct(
        private string $title,
        private string $producerFirstName,
        private string $producerMainName,
        protected int|float $price
    ){
    }

    /**
     * @return string
     */
    public function getProducerFirstName(): string
    {
        return $this->producerFirstName;
    }

    /**
     * @return string
     */
    public function getProducerMainName(): string
    {
        return $this->producerMainName;
    }
    public function setDiscount(int|float $num): void
    {
        $this->discount = $num;
    }

    /**
     * @return float|int
     */
    public function getDiscount(): float|int
    {
        return $this->discount;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPrice(): int|float
    {
        return $this->price-$this->discount;
    }
    public function getProducer() : string
    {
        return $this->producerFirstName." ".$this->producerMainName;
    }
    public function getSummaryLine() : string
    {
        $base = "{$this->title} ( {$this->producerMainName}, ";
        $base .= "{$this->producerFirstName} )";
        return $base;
    }


}
class BookProduct extends ShopProduct
{

    public function __construct(
        string $title,
        string $firstName,
        string $mainName,
        int|float $price,
        private int $numPages
    )
    {
        parent:: __construct(
            $title,
            $firstName,
            $mainName,
            $price
        );
    }

    public function getNumberOfPages(): int
    {
        return $this->numPages;
    }
    public function getSummaryLine(): string
    {
        return parent::getSummaryLine().": Page count - $this->numPages";
    }
    public function getPrice():int|float{
        return $this->price;
    }
}
class CDProduct extends ShopProduct
{
    public function __construct(
        string $title,
        string $firstName,
        string $mainName,
        int|float $price,
        private int $playLength
        )
    {
        parent::__construct($title,
            $firstName,
            $mainName,
            $price
        );
    }

    public function getPlayLength(): int
    {
        return $this->playLength;
    }
    public function getSummaryLine(): string
    {
        return parent::getSummaryLine().": Playing time - {$this->playLength}";
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
            $str .= "{$shopProduct->getTitle()}: ";
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




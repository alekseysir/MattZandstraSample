<?php


class ShopProduct
{

    public  $title;
    public  $producerMainName;
    public  $producerFirstName;
    public  $price;

    public function __construct(
        $title,
        $producerMainName,
        $producerFirstName,
        $price
    )    {
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
//        $base = "$this->title ( $this->producerMainName, $this->producerFirstName )";
        return "$this->title ( $this->producerMainName, $this->producerFirstName )";
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
    public function Write(ShopProduct $shopProduct){
        $str = $shopProduct->title.": "
            .$shopProduct->getProducer()
            ."( ".$shopProduct->price.")\n";
        print $str;
    }
}
//$product1 = new ShopProduct("My Antonia", "Willa", "Cather", 5.99);
//$writer = new ShopProductWriter();
//$writer->Write($product1);
$book1 = new BookProduct(1000, "My Antonia", "Willa", 5.99, 500);
print $book1->getSummaryLine()."<br/>";
$CD = new CDProduct("CDmusic", "plagiator", "plagiatorovich", 8.0, 990);
print $CD->getSummaryLine();

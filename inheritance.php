<?php 

function br(){
    echo "<br>";
}

class ShopProduct{
    public $title = '';
    public $producerMainName;
    public $producerFirstName;
    public $cdDuration;
    public $bookLength;
    public $price = 0;

    public function __construct($title,$producerFirstName,$producerMainName,$bookLength,$cdDuration,$price){
        $this->title = $title;
        $this->producerMainName = $producerMainName;
        $this->producerFirstName = $producerFirstName;
        $this->price = $price;
        $this->bookLength = $bookLength;
        $this->cdDuration = $cdDuration;
    }
    public function getProducer(){
        return "{$this->producerFirstName} {$this->producerMainName}";
    }
}



// Lets use Inheritance


class ShopProductCD extends ShopProduct{
    
    public function __construct($title,$producerFirstName,$producerMainName,$cdDuration,$price){
        parent::__construct($title,$producerFirstName,$producerMainName,null,$cdDuration,$price);
    }
    public function getDuration(){
        return "Duration of CD '{$this->title}' : {$this->cdDuration} mins";
    }
}

$productCd = new ShopProductCD('Master of Puppets','Metallica','',360,20);
echo $productCd->getProducer();
br();
echo $productCd->getDuration();



class ShopProductBook extends ShopProduct{
    public function __construct($title,$producerFirstName,$producerMainName,$bookLength,$price){
        parent::__construct($title,$producerFirstName,$producerMainName,$bookLength,null,$price);
    }
    public function getLength(){
        return "Length of book '{$this->title}' : {$this->bookLength}";
    }
}
br();
$productBook = new ShopProductBook('The Subtle Art of Not Giving a F*ck','Mark','Manson',224,15);
echo $productBook->getProducer();
br();
echo $productBook->getLength();


?>
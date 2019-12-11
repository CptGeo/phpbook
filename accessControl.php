<?php 
/**
 * Public, Private and Protected: Managing Access to Your Classes
 * 
 * 
 * Rule Of Thumb : Make properties private or protected at first and then relax the restriction only as needed.
 * 
 * Properties and Methods below have the best access setting for their purpose (public, private or protected).
 */
function br($times = 1){
    for($i = 0; $i < $times; $i++)
        echo "<br>";
}
class ShopProduct{
    protected $title = '';
    protected $producerMainName;
    protected $producerFirstName;
    protected $price = 0;
    protected $discountPerc = 15; //%

    public function __construct($title,$producerFirstName,$producerMainName,$price){
        $this->title = $title;
        $this->producerMainName = $producerMainName;
        $this->producerFirstName = $producerFirstName;
        $this->price = $price;
    }
    public function getProducer(){
        return "{$this->producerFirstName} {$this->producerMainName}";
    }

    /**
     * getPrice() works as an Accessor Method.
     * It gives back a filtered property value (after discount has been applied).
     * The plain price cannot be obtained without this filtering ($price is protected)
     */
    public function getPrice(){
        return ($this->price - (15/100) * $this->price);
    }
}
class ShopProductCD extends ShopProduct{
    private $cdDuration;

    public function __construct($title,$producerFirstName,$producerMainName,$cdDuration,$price){
        parent::__construct($title,$producerFirstName,$producerMainName,$price);
        $this->cdDuration = $cdDuration;
    }
    public function getDuration(){
        return "Duration of CD '{$this->title}' : {$this->cdDuration} mins";
    }
    public function getProducer(){
        $prod = parent::getProducer();
        $prod .= ' '.$this->cdDuration.' mins';
        return $prod; 
    }
}
class ShopProductBook extends ShopProduct{
    private $bookLength;
    public function __construct($title,$producerFirstName,$producerMainName,$bookLength,$price){
        parent::__construct($title,$producerFirstName,$producerMainName,$price);
        $this->bookLength = $bookLength;
    }
    public function getLength(){
        return "Length of book '{$this->title}' : {$this->bookLength}";
    }

    public function getProducer(){
        $prod = parent::getProducer();
        $prod .= ' '.$this->bookLength.' pages';
        return $prod; 
    }
}

$book = new ShopProductBook('The Subtle Art of Not Giving a F*ck','Mark','Manson',224,15);
echo $book->getPrice();

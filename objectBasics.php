<?php 

/**
 * @section Classes and Objects p.15
 * @section Setting Properties in a Class p.17
 * @section Working with Methods p.19
 * @section Arguments and Types p.22
 */

class ShopProduct{
    public $title;
    public $producerMainName;
    public $producerFirstName;
    public $price = 0;

    function __construct($title, $producerMainName,$producerFirstName,$price) {
        $this->title = $title;
        $this->producerMainName = $producerMainName;
        $this->producerFirstName = $producerFirstName;
        $this->price = $price;               
    }

    function getProducer(){
        return "{$this->producerFirstName}"." {$this->producerMainName}";
    }

    function printnums(int $a, int $b){
        echo $a+$b;
    }
}

//Argument has to be of type ShopProduct to work
class ShopProductWriter{
    public function write(ShopProduct $shopProduct){
        $str = "{$shopProduct->title}: ".$shopProduct->getProducer()." ({$shopProduct->price})\n";
        print $str;
    }

    //Εδώ αν το argument πρέπει να είναι τύπου ObjectWriter ή αλλιώς null
    public function setWriter(ObjectWriter $objwriter = null){
        $this->writer = $objwriter;
    }
}

class Wrong{}

$product = new ShopProduct('Tomato', 'Papadakis', 'Ioannis', 0.95);

// $wrongProduct = new Wrong();

$writer = new ShopProductWriter();
$writer->write($product);
// $writer->write($wrongProduct);
$writer->setWriter();


?>

<?php 
/**
 * Inheritance
 * - The Inheritance Problem
 * - Working with Inheritance
 * - Constructors and Inheritance
 * - Invoking an Overridden Method
 */
function br($times = 1){
    for($i = 0; $i < $times; $i++)
        echo "<br>";
}
class ShopProduct{
    public $title = '';
    public $producerMainName;
    public $producerFirstName;
    public $price = 0;

    public function __construct($title,$producerFirstName,$producerMainName,$price){
        $this->title = $title;
        $this->producerMainName = $producerMainName;
        $this->producerFirstName = $producerFirstName;
        $this->price = $price;
    }
    public function getProducer(){
        return "{$this->producerFirstName} {$this->producerMainName}";
    }
}

// Lets use Inheritance
class ShopProductCD extends ShopProduct{
    public $cdDuration;

    public function __construct($title,$producerFirstName,$producerMainName,$cdDuration,$price){
        parent::__construct($title,$producerFirstName,$producerMainName,$price);
        $this->cdDuration = $cdDuration;
    }
    public function getDuration(){
        return "Duration of CD '{$this->title}' : {$this->cdDuration} mins";
    }


    /**
     * The method below extends the functionality of the parent 'getProducer'
     * function, without completely rewriting any code
     */
    public function getProducer(){
        $prod = parent::getProducer();
        $prod .= ' '.$this->cdDuration.' mins';
        return $prod; 
    }
}

$productCd = new ShopProductCD('Master of Puppets','Metallica','',360,20);
echo $productCd->getProducer();
br();
echo $productCd->getDuration();

class ShopProductBook extends ShopProduct{
    public $bookLength;
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
br();
$productBook = new ShopProductBook('The Subtle Art of Not Giving a F*ck','Mark','Manson',224,15);
echo $productBook->getProducer();
br();
echo $productBook->getLength();





/**
 * class that accepts only instances of a specific class
 */

 class Animal {
     public $name;
     public $type;
     public $race;

     public function __construct($name, $type, $race){
        $this->name = $name;
        $this->type = $type;
        $this->race = $race;
     }

     /**
      * @param $animal Object an object of type Animal or Dog (checking is inside)
      */
     public function printAnimal($animal){
         if(! ($animal instanceof self) && !($animal instanceof Dog)){
             die("Argument received in function 'printAnimal' is not of type Animal or Dog");
         }
         else{
             echo $animal->name.' is a '.$animal->type.' of race '.$animal->race;

         }
     }
 }

 class Dog extends Animal{}
 class Cat extends Animal{}

 $dog = new Dog('Riko', 'dog', 'pitbull');
 br(2);
 $dog->printAnimal($dog);

//  $cat = new Cat('Mirka','cat','persian');
//  br(2);
//  $cat->printAnimal($cat);
?>
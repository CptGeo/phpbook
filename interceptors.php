
<?php 

/**
 * Interceptors are methods that are invoked when the right conditions are met
 * 
 * __get() 
 * __set($property, $value)
 * __isset($property)
 * __unset($property)
 * __call($method, $arg_array)
 */

class Pet{
    private $name;
    private $color;

    public function __construct($name, $color){
        $this->name = $name;
        $this->color = $color;
    }

    public function introduce(){
        echo "{$this->name}, {$this->color}";
    }

    public function __call($method, $arg_array){
        echo "Method {$method} does not exist in ". static::class;
    }
}

$dog = new Pet('Rex', 'Black');

$dog->introduce();
$dog->intro();

$cat = new Pet('Mika','Grey');
echo "<br>";

?>

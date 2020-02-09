<?php 

/**
 * Just a simple product
 */
class Product{
    public $name;
    public $price;

    public function __construct( $name, $price ){
        $this->name = $name;
        $this->price = $price;
    }
}


/**
 * Receives callbacks and stores to array when registerCallback is invoked
 * Calls every callback in the array when method sale() is 
 * invoked with a @param Product 
 * 
 */
class ProcessSale{
    private $callbacks;

    public function registerCallback( $callback ){
        if( !is_callable($callback) ){
            throw new Exception ("Callback is not callable");
        }
        $this->callbacks[] = $callback;
    }

    public function sale(Product $product){
        print "{$product->name}: processing \n";
        foreach( $this->callbacks as $callback ){
            call_user_func( $callback, $product ); //1st param function, 2nd scope object
        }
    }
}

$logger = create_function( '$product',
                            'print " logging ({$product->name})\n";' );
$processor = new ProcessSale();

$processor->registerCallback($logger);

$processor->sale(new Product("shoes", 6));

print "<br>";
$processor->sale(new Product("coffee", 6));
print "<br>";


// BETTER IMPLEMENTATION OF CALLBACK

$logger2 = function ($product) {
    print "  logging ({$product->name})";
};

$processor2 = new ProcessSale();
$processor2-> registerCallback( $logger2 );

$processor2->sale( new Product("shoes", 8) );

echo "<br>";

$processor2->sale( new Product("coffee", 8) );

//===================================//





//The below shows a Non Anonymous callback function (it calls by name)
class Mailer {
    function doMail( $product ){
        print "    mailing({$product->name})";
    }
}

$processor3 = new ProcessSale();

//registerCallback takes in an array and
//is_callable (is smart enough) checks the array for callability
$processor3->registerCallback( array(new Mailer(), "doMail") );
echo "<br>";
$processor3->sale( new Product( "potatoes", 12 ));




//The below shows a method returning an anonymous function

class Totalizer {
    static function warnAmount() {
        return function ($product){
            if( $product->price > 5 ){
                print "    reached high price: {$product->price}";
            }
        }; //don't forget the semicolon
    }
}

$processor3 = new ProcessSale();
$processor3->registerCallback( Totalizer::warnAmount() );
echo "<br>";
$processor3->sale( new Product ("eggs", 7) );




//Closure example below

class Totalizer2 {
    static function warnAmount( $amt ){
        $count = 0; //This value is keeped

        /**
         * I can make my anonymous function keep track of variables 
         * from its wider scope with a 'use' clause
         */
        return function ( $product ) use ( $amt, &$count ) {
            $count += $product->price;
            print "   count:$count <br>";
            if( $count > $amt ) {
                print "   high price reached : {$count}";
            }
        };
    }
}

$processor4 = new ProcessSale();
$processor4->registerCallback(Totalizer2::warnAmount(8));

echo "<br>";
$processor4->sale( new Product("shoes" , 6 ) );
echo "<br>";
$processor4->sale( new Product("coffee", 6 ) );



?>


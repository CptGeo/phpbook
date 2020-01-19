<?php 

/**
 * Preferences implements the singleton Design Pattern
 */

class Preferences{

    private $props = array();
    
    private static $instance;
    
    /**
     * Constructor private for Singleton D.P. implementation
     */
    private function __construct(){}

    /**
     * Sets on property in the config file
     * @param key -> Expects key of the configuration
     * @param val -> Value of the configuration
     *
     */
    public function setOneProperty($key, $val){
        $this->props[$key] = $val;
    }



    /** 
     * Edits the configuration
     * 
     * @param properties -> Expects array of 
     * configurations to be included in the configuration array
     */
    public function setProperties($properties){

        foreach($properties as $name => $value){
            $this->setOneProperty($name,$value);
        }
    }


    /**
     * Returns property value
     * 
     * @param keys -> The key of the config we want to receive value from
     */
    public function getProperty($keys){
        if(is_array($keys)){
            foreach($keys as $key){
                $ar[$key] = $this->props[$key];
            }
            return $ar;
        }
        return $this->props[$keys];
    }


    /**
     * Retrieves the preferences instance. 
     * Implemented according to Singleton pattern
     */
    public static function getInstance(){
        if(empty(self::$instance)){
            self::$instance = new Preferences();
        }
        return self::$instance;
    }
}


$inst = Preferences::getInstance();


$setup = array(
    'languages' => array(
        'en' => 'english',
        'el' => 'greek',
        'de' => 'german'
    ),
    'host' => 'localhost',
    'phpversion' => '7.3.1',

);

$inst->setProperties($setup);

$prop = array(
        'color' => 'dark',
        'typography' => 'Roboto Slab'
);
$inst->setOneProperty('theme', $prop );

echo "<pre>";
print_r($inst->getProperty(['languages','host','phpversion','theme']));
echo "</pre>";


$inst2 = Preferences::getInstance();
echo "<pre>";
print_r($inst2->getProperty(['languages','host']));
echo "</pre>";

?>
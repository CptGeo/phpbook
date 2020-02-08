<?php


/**
 * Late static bindings : The static keyword
 * 
 * 
 */
abstract class DomainObject1 {
    public static function create(){
        return new self(); // Επιστρέφει ένα instance του DomainObject 
    }
}


class User1 extends DomainObject1{}
class Document1 extends DomainObject1{}


/**
 * Το παρακάτω θα προκαλέσει Fatal Error, διότι προσπαθεί να
 * κάνει instance από μια abstact class. 
 * Το self() πάντα αναφέρετε στην κλάση μέσα στην οποία δηλώνεται. 
 * 
 */
// Document::create();


abstract class DomainObject{
    private $group;

    public function __construct(){
        $this->group = static::getGroup();
    }

    public static function create(){
        return new static(); // Επιστρέφει ένα instance από την κλάση που το καλεί
    }
    
    public static function getGroup(){
        return "default";
    }
}

class Document extends DomainObject{
    
    /**
     * Κάνω override την getGroup()
     */
    public static function getGroup(){
        return "document";
    }
}

class User extends DomainObject{}
class SpreadSheet extends Document{}


print_r(User::create());
print_r(SpreadSheet::create());

?>
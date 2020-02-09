<?php 



/**
 * Extending the Exception class
 */



/**
 * Exception class μόνο για σφάλματα σχετικά με xml
 */
class XmlException extends Exception{

    /**
     * @param $error -> LibXmlError από libxml_get_last_error()
     */

    public function __construct( LibXmlError $error ){
        $shortfile = basename( $error->file );
        $msg = "[{$shortfile}, line{$error->line}, col {$error->column}] {$error->message}";
        $this->error = $error;

        parent::__construct ( $msg, $error->code );//Φτιάχνω το exception με χρήση του construct της κλάσσης Exception
    }

    public function getLibXmlError(){
        return $this->error;
    }
}

class FileException extends Exception { }

class ConfException extends Exception { }

class Conf
{
    private $file; //type : String
    private $xml; //type : SimpleXMLElement
    private $lastMatch; //type : String

    public function __construct($file)
    {
        $this->file = $file;
        if(! file_exists( $file )){
            throw new Exception( "File $file does not exist" );
        }
        $this->xml = simplexml_load_file($file); // φορτώνει το xml αρχείο

    }

    public function write()
    {
        file_put_contents($this->file, $this->xml->asXML());
    }

    public function get($str)
    {
        $matches = $this->xml->xpath("/conf/item[@name=\"$str\"]");
        if (count($matches)) {
            $this->lastMatch = $matches[0];
            return (string)$matches[0];
        }
        return null;
    }

    public function set($key, $value)
    {
        if (! is_null($this->get($key))) {
            $this->lastMatch[0] = $value;
            return;
        }
        $conf = $this->xml->conf;
        $this->xml->addChild('item', $value)->addAttribute('name', $key);
    }
}

$obj = new Conf("./simple.xml");

?>
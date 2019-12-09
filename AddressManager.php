<?php 

    class AddressManager{
        private $addresses = array(
            "64.233.160.0",
            "66.249.95.255",
            "72.14.192.0",
            "85.74.87.31"
        );

        //Μέθοδος με λάθος (παίρνει string το "false" και στην πραγματικότητα είναι true)
        // function outputAddresses($resolve){
        //     foreach($this->addresses as $address){
        //         print $address;
        //         print $resolve;
        //         if($resolve){
        //             print " (".gethostbyaddr($address).")";
        //         }
        //         print "<br>";
        //     }
        // }


        //Αυστηρή μέθοδος με έλεγχο και σφάλμα αν όχι boolean
        // function outputAddresses($resolve){
        //     foreach($this->addresses as $address){
        //         print $address;
        //         if(!is_bool($resolve)){
        //            die("<br>outputAddress() requires a Boolean argument<br>");
        //         }
        //         if($resolve){
        //             print " (".gethostbyaddr($address).")";
        //         }
        //         print "<br>";
        //     }
        // }



        //Μέθοδος με έλεγχο του ακόμα και σε string argument
        /**
         * Outputs the list of addresses
         * If $resolve is true then each address will be resolved
         * @param $resolve Boolean Resolve the address?
         */
        function outputAddresses($resolve){
            foreach($this->addresses as $address){
                print $address;
                if(is_string($resolve)){
                    $resolve = (preg_match("/false|no|off/i", $resolve))? false:true;
                }

                if($resolve){
                    print " (".gethostbyaddr($address).")";
                }
                print "<br>";
            }
        }

    }

    $settings = simplexml_load_file("settings.xml");
    $manager = new AddressManager();
    $manager->outputAddresses((string)$settings->resolvedomains);
?>
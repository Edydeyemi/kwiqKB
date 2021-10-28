<?php


namespace kwiqKB\Controllers;

use kwiqKB\Homepage;

/**
 * Class HomepageController
 * @package kwiqKB\Controllers
 */

class HomepageController extends MainController
{

    public function __construct()
    {
        $hompage = new HomePage();
    }

    public function homepage(){

        $this->renderView('homepage');
        
        echo "This is the Homepage y'all";
    }
}

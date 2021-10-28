<?php

if (session_status() !== PHP_SESSION_ACTIVE)
    session_start(); 

ob_start();

define('BASEURL', dirname(dirname(__FILE__)));

require_once BASEURL . '/src/vendor/autoload.php';
require_once BASEURL . '/src/config/config.php';
require_once BASEURL . '/src/loadenv.php';


// Call Route File
include_once BASEURL . '/src/routes/web.php';


 

// EOF

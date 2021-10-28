<?php

namespace kwiqKB;

use DB;

class Database
{

    private $db;
    private $dbhost;
    private $dbuser;
    private $dbname;
    private $dbpass;

    public function __construct()
    {
        $this->dbhost = getenv('DB_HOST');
        $this->dbuser = getenv('DB_USER');
        $this->dbname = getenv('DB_NAME');
        $this->dbpass = getenv('DB_PASS');

        DB::$host       =  $this->dbhost;
        DB::$user       =  $this->dbuser;
        DB::$password   =  $this->dbpass;
        DB::$dbName     =  $this->dbname;

        DB::$encoding   = 'utf8';
    }
}

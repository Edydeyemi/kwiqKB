<?php

namespace kwiqKB;

class Homepage{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
        var_dump($this->db);
    }

}
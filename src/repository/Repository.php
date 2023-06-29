<?php

namespace src\repository;

use Database;
use src\utils\Files;

class Repository
{
    protected Database $database;
    protected Files $files;

    public function __construct()
    {
        $this->database = Database::getInstance();
        $this->files = Files::getInstance();
    }
}
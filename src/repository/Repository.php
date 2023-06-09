<?php
    require_once 'Database.php';
    require_once __DIR__.'/../utils/Files.php';

    class Repository {
        protected $database;
        protected $files;

        public function __construct() {
            $this->database = Database::getInstance();
            $this->files = Files::getInstance();
        }
    }
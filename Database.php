<?php
    require_once 'config.php';

    class Database {
        public $connection;
        
        private $database = DATABASE;
        private $host = HOST;
        private $username = USERNAME;
        private $password = PASSWORD;

        private static $instance; //store the single instance of the database
        
        private function __construct() {
            //This will load only once regardless of how many times the class is called
            try {
                $this->connection = new PDO(
                    "pgsql:host=$this->host;port=5432;dbname=$this->database",
                    $this->username,
                    $this->password,
                    ["sslmode"  => "prefer"]
                );
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            }
            catch (PDOException $e) {
                die("Connection failed: ".$e->getMessage());
            }
        }
        
        //this function makes sure there's only 1 instance of the Database class
        public static function getInstance() {
            if (!self::$instance){
                self::$instance = new Database();
            }

            return self::$instance;     
        }
        
        public function connect() { 
            //db connection
        }
    }
        
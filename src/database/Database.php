<?php
    class Database {
        private $databaseName = 'only-buy';
        private $host = 'localhost';
        private $user = 'user';
        private $password = 'ADoORmri1997@'; 
        private static $instance; //store the single instance of the database
        
        private function __construct() {
            //This will load only once regardless of how many times the class is called
            $connection = pg_connect("host=".$this->host." dbname=".$this->databaseName." user=".$this->user." password=".$this->password) or die (pg_error());
            $db = pg_select_db($this->databaseName, $connection) or die(pg_error());
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

        public function query($query) {
            //queries   
            $sql = mysql_query($query) or die(mysql_error()); 
            return $sql;
        }
        
        public function numrows($query) {
            //count number of rows  
            $sql = $this->query($query);
            return mysql_num_rows($sql);
        }
    }
        
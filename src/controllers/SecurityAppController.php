<?php
    require_once 'AppController.php';

    class SecurityAppController extends AppController {
        public function __construct() {
            session_start();
            parent::__construct();
        }
    }
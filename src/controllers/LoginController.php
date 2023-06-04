<?php
    require_once 'AppController.php';

    class LoginController extends AppController {
        public function index() {
            $this->render('login');
        }

        public function login() {
            echo 'ss';
        }
    }
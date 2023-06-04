<?php
    require_once 'AppController.php';

    class RegisterController extends AppController {
        public function index() {
            $this->render('register');
        }

        public function register() {
            echo 'ss';
        }
    }
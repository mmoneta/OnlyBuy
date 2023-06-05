<?php
    require_once 'AppController.php';

    class RegisterController extends AppController {
        public function index() {
            $this->render('register');
        }

        public function register() {
            if ($this->isGet()) {
                return $this->render('register');
            }

            echo('ss');
        }
    }
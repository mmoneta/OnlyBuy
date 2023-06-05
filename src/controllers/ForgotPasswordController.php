<?php
    require_once 'AppController.php';

    class ForgotPasswordController extends AppController {
        public function index() {
            $this->render('forgot-password');
        }
    }
<?php
    require_once 'AppController.php';

    class DashboardController extends AppController {
        public function index() {
            session_start();

            if ($_SESSION['user']) {
                return $this->render('dashboard');
            }
            
            header("Location: {$this->baseUrl()}/login");
        }
    }
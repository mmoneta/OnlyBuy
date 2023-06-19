<?php
    require_once 'SecurityAppController.php';

    class DashboardController extends SecurityAppController{
        public function index() {
            if ($_SESSION['user']) {
                return $this->render('dashboard');
            }
            
            header("Location: {$this->baseUrl()}/login");
        }
    }
<?php
    require_once 'AppController.php';
    require_once __DIR__.'/../repository/UserRepository.php';

    class DashboardController extends AppController {
        public function index() {
            session_start();

            if ($_SESSION['user']) {
                return $this->render('dashboard');
            }
            
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/login");
        }
    }
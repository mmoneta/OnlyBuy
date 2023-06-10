<?php
    require_once 'AppController.php';
    require_once __DIR__.'/../repository/ProductRepository.php';

    class ProductEditorController extends AppController {
        public function index() {
            session_start();

            if (isset($_SESSION['user']) && $_SESSION['user']->getRole() == 'admin') {
                return $this->render('product-creator');
            }
            
            header("Location: {$this->baseUrl()}");
        }
    }
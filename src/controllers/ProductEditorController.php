<?php
    require_once 'SecurityAppController.php';
    require_once __DIR__.'/../repository/ProductRepository.php';

    class ProductEditorController extends SecurityAppController {
        public function index() {
            if (isset($_SESSION['user']) && $_SESSION['user']->getRole() == 'admin') {
                return $this->render('product-creator');
            }
            
            header("Location: {$this->baseUrl()}");
        }
    }
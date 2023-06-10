<?php
    require_once 'AppController.php';
    require_once __DIR__.'/../repository/ProductRepository.php';

    class ProductCreatorController extends AppController {
        public function index() {
            session_start();

            if (isset($_SESSION['user']) && $_SESSION['user']->getRole() == 'admin') {
                return $this->render('product-creator');
            }
            
            header("Location: {$this->baseUrl()}");
        }

        public function productCreator() {
            if ($this->isGet()) {
                self::index();
                return;
            }

            $productRepository = new ProductRepository();

            $isProductCreated = $productRepository->createProduct(
                $_POST['name'],
                $_POST['description'],
                $_FILES['images'],
                $_POST['isActive'] === 'true' ? true : false,
                $_POST['isPromo'] === 'true' ? true : false
            );
            
            echo json_encode($isProductCreated);
        }
    }
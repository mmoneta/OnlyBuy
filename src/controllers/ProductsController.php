<?php
    require_once 'AppController.php';
    require_once __DIR__.'/../repository/ProductRepository.php';

    class ProductsController extends AppController {
        private $productRepository;

        public function __construct() {
            parent::__construct();
            $this->productRepository = new ProductRepository();
        }

        public function products() {
            $products = $this->productRepository->getProducts(
                $_GET['search'],
                $_GET['active'],
                $_GET['promo']
            );
            
            http_response_code(200);
            echo json_encode($products);
        }
    }
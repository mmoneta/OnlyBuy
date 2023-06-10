<?php
    require_once 'AppController.php';
    require_once __DIR__.'/../repository/ProductRepository.php';

    class ProductsController extends AppController {
        public function products() {
            $productRepository = new ProductRepository();
            $products = $productRepository->getProducts();

            header('Content-type: application/json');
            
            echo json_encode($products);
        }
    }
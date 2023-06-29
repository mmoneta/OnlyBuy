<?php

namespace src\controllers;

use src\repository\ProductRepository;

class ProductsController extends SecurityAppController
{
    private ProductRepository $productRepository;

    public function __construct()
    {
        parent::__construct();
        $this->productRepository = new ProductRepository();
    }

    public function products(int $id, string $change): void
    {
        if ($change === 'rate') {
            return;
        }

        $products = $this->productRepository->getProducts(
            $_GET['search'],
            $_GET['active'],
            $_GET['promo']
        );

        http_response_code(200);
        echo json_encode($products);
    }
}
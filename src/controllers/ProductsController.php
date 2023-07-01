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

    public function products(): void
    {
        $args = func_get_args();

        if ($args && $args[1] === 'rate') {
            print_r($args);
            return;
        }

        $products = $this->productRepository->getProducts(
            $_SESSION['user']->getUserId(),
            $_GET['search'],
            $_GET['active'] === 'true' ? true : false,
            $_GET['promo'] === 'true' ? true : false
        );

        http_response_code(200);
        echo json_encode($products);
    }
}
<?php

namespace src\controllers;

use src\repository\ProductRepository;

class ProductCreatorController extends SecurityAppController
{
    private ProductRepository $productRepository;

    public function __construct()
    {
        parent::__construct();
        $this->productRepository = new ProductRepository();
    }

    public function index()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']->getRole() == 'admin') {
            $this->render('product-creator');
            return;
        }

        header("Location: {$this->baseUrl()}");
    }

    public function productCreator()
    {
        if ($this->isGet()) {
            self::index();
            return;
        }

        try {
            $isProductCreated = $this->productRepository->createProduct(
                $_POST['name'],
                $_POST['description'],
                $_FILES['images'],
                $_POST['isActive'] === 'true' ? true : false,
                $_POST['isPromo'] === 'true' ? true : false
            );
        } catch (Throwable $e) {
            var_dump($e);
        }  

        http_response_code(200);
        echo json_encode($isProductCreated);
    }
}
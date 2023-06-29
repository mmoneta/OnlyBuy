<?php

namespace src\controllers;

use src\repository\ProductRepository;

class ProductEditorController extends SecurityAppController
{
    public function index(): void
    {
        if (isset($_SESSION['user']) && $_SESSION['user']->getRole() == 'admin') {
            return $this->render('product-creator');
        }

        header("Location: {$this->baseUrl()}");
    }
}
<?php

namespace src\controllers;

class ProductEditorController extends SecurityAppController
{
    public function index(): void
    {
        if (isset($_SESSION['user']) && $_SESSION['user']->getRole() == 'admin') {
            $this->render('product-creator');
            return;
        }

        header("Location: {$this->baseUrl()}");
    }
}
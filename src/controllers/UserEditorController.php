<?php

namespace src\controllers;

class UserEditorController extends SecurityAppController
{
    public function index(): void
    {
        if (isset($_SESSION['user']) && $_SESSION['user']->getRole() == 'admin') {
            return $this->render('user-creator');
        }

        header("Location: {$this->baseUrl()}");
    }
}
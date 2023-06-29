<?php

namespace src\controllers;

class DashboardController extends SecurityAppController
{
    public function index(): void
    {
        if ($_SESSION['user']) {
            return $this->render('dashboard');
        }

        header("Location: {$this->baseUrl()}/login");
    }
}
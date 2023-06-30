<?php

namespace src\controllers;

class DashboardController extends SecurityAppController
{
    public function index(): void
    {
        if ($_SESSION['user']) {
            $this->render('dashboard');
            return;
        }

        header("Location: {$this->baseUrl()}/login");
    }
}
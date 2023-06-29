<?php

namespace src\controllers;

class ForgotPasswordController extends AppController
{
    public function index(): void
    {
        $this->render('forgot-password');
    }
}
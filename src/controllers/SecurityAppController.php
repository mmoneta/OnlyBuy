<?php

namespace src\controllers;

class SecurityAppController extends AppController
{
    public function __construct()
    {
        session_start();
        parent::__construct();
    }
}
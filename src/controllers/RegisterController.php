<?php

namespace src\controllers;

use src\repository\UserRepository;

class RegisterController extends SecurityAppController
{
    private UserRepository $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function index(): void
    {
        if (!$_SESSION['user']) {
            $this->render('register');
            return;
        }

        header("Location: {$this->baseUrl()}");
    }

    public function register(): void
    {
        if ($this->isGet()) {
            self::index();
            return;
        }

        $isUserCreated = $this->userRepository->createUser(
            $_POST['username'],
            $_POST['email'],
            $_POST['password'],
            1,
            $_FILES['avatar']
        );

        http_response_code(200);
        echo json_encode($isUserCreated);
    }
}
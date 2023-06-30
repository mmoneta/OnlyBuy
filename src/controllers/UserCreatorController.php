<?php

namespace src\controllers;

use src\repository\UserRepository;

class UserCreatorController extends SecurityAppController
{
    private UserRepository $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function index(): void
    {
        if (isset($_SESSION['user']) && $_SESSION['user']->getRole() == 'admin') {
            $this->render('user-creator');
            return;
        }

        header("Location: {$this->baseUrl()}");
    }

    public function user(): void
    {
        $isUserCreated = $this->userRepository->createUser(
            $_POST['username'],
            $_FILES['avatar'],
            $_POST['email'],
            $_POST['password'],
            $_POST['roleId']
        );

        http_response_code(200);
        echo json_encode($isUserCreated);
    }
}
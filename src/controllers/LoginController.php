<?php

namespace src\controllers;

use src\repository\UserRepository;

class LoginController extends SecurityAppController
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
            $this->render('login');
            return;
        }

        header("Location: {$this->baseUrl()}");
    }

    public function login(): void
    {
        if ($this->isGet()) {
            self::index();
            return;
        }

        $json = file_get_contents('php://input');

        $data = json_decode($json);

        $user = $this->userRepository->verifyUser($data->username, $data->password);

        if (!$user) {
            echo json_encode(false);
            return;
        }

        $_SESSION["user"] = $user;

        http_response_code(200);
        echo json_encode(true);
    }
}
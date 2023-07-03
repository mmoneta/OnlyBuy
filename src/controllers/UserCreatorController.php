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
        if ($this->isPost()) {
            $isUserCreated = $this->userRepository->createUser(
                $_POST['username'],
                $_POST['email'],
                $_POST['password'],
                $_POST['roleId'],
                $_FILES['avatar']
            );
    
            http_response_code(200);
            echo json_encode($isUserCreated);
            return;
        }

        if ($this->isPut()) {
            $json = file_get_contents('php://input');

            $data = json_decode($json);

            if ($data->password) {
                $updatedUser = $this->userRepository->updatePassword($data->username, $data->password);
                http_response_code(200);
                echo json_encode($updatedUser);
                return;
            }

            if ($data->roleId) {
                $updatedUser = $this->userRepository->updateRole($data->username, intval($data->roleId));
                http_response_code(200);
                echo json_encode($updatedUser);
            }
        }
    }
}
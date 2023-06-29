<?php

namespace src\controllers;

use src\repository\UserRepository;

class UsersController extends SecurityAppController
{
    private UserRepository $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function index(string $username): void
    {
        if (isset($_SESSION['user']) && $_SESSION['user']->getRole() == 'admin') {
            if ($username) {
                return $this->render('user-editor');
            }

            return $this->render('users');
        }

        header("Location: {$this->baseUrl()}");
    }

    public function users(string $username = ''): void
    {
        if ($this->isAjax() && !$username) {
            $users = $this->userRepository->getUsers();

            http_response_code(200);
            echo json_encode($users);
            return;
        }

        if ($this->isAjax() && $username) {
            $user = $this->userRepository->getUserDetails($username);

            http_response_code(200);
            echo json_encode($user);
            return;
        }

        self::index($username);
    }
}
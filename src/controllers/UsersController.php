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
                $this->render('user-editor');
                return;
            }

            $this->render('users');
            return;
        }

        header("Location: {$this->baseUrl()}");
    }

    public function users(): void
    {
        $username = func_get_args() ? func_get_args()[0] : '';
        
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
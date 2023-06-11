<?php
    require_once 'AppController.php';
    require_once __DIR__.'/../repository/UserRepository.php';

    class RegisterController extends AppController {
        public function index() {
            session_start();

            if (!$_SESSION['user']) {
                return $this->render('register');
            }

            header("Location: {$this->baseUrl()}");
        }

        public function register() {
            if ($this->isGet()) {
                self::index();
                return;
            }

            $userRepository = new UserRepository();

            $isUserCreated = $userRepository->createUser(
                $_POST['username'],
                $_FILES['avatar'],
                $_POST['email'],
                $_POST['password'],
                1
            );
            
            echo json_encode($isUserCreated);
        }
    }
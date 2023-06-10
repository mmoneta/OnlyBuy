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

            $json = file_get_contents('php://input');
            $userRepository = new UserRepository();

            $data = json_decode($json);

            $isUserCreated = $userRepository->createUser($data->username, $data->email, $data->password);
            
            echo json_encode($isUserCreated);
        }
    }
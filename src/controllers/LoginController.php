<?php
    require_once 'AppController.php';
    require_once __DIR__.'/../repository/UserRepository.php';

    class LoginController extends AppController {
        public function index() {
            if (!$_SESSION['user']) {
                return $this->render('login');
            }

            header("Location: {$this->baseUrl()}");
        }

        public function login() {
            if ($this->isGet()) {
                self::index();
            }

            $json = file_get_contents('php://input');
            $userRepository = new UserRepository();

            $data = json_decode($json);

            $user = $userRepository->getUser($data->username, $data->password);

            if (!$user) {
                echo json_encode(false);
                return;
            }

            session_start();
            $_SESSION["user"] = $user;
            echo json_encode(true);
        }
    }
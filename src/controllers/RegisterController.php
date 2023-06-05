<?php
    require_once 'AppController.php';

    class RegisterController extends AppController {
        public function index() {
            session_start();

            if (!$_SESSION['user']) {
                return $this->render('register');
            }

            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}");
        }

        public function register() {
            if ($this->isGet()) {
                self::index();
            }

            $json = file_get_contents('php://input');
            $userRepository = new UserRepository();

            $data = json_decode($json);

            $isUserCreated = $userRepository->createUser($data->username, $data->email, $data->password);

            header('Content-type: application/json');
            
            if ($isUserCreated) {
                echo json_encode(true);
                return;
            }
            
            echo json_encode(false);
        }
    }
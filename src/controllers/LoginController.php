<?php
    require_once 'AppController.php';
    require_once __DIR__.'/../repository/UserRepository.php';

    class LoginController extends AppController {
        public function index() {
            $this->render('login');
        }

        public function login() {
            if ($this->isGet()) {
                return $this->render('login');
            }

            $json = file_get_contents('php://input');
            $userRepository = new UserRepository();

            $data = json_decode($json);

            $user = $userRepository->getUser($data->username, $data->password);
            echo($user);

            if (!$user) {
                return $this->render('login', ['messages' => ['User not found!']]);
            }

            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/register");
        }
    }
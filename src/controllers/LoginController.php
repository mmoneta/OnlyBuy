<?php
    require_once 'AppController.php';
    require_once __DIR__.'/../repository/UserRepository.php';

    class LoginController extends AppController {
        private $userRepository;

        public function __construct() {
            parent::__construct();
            $this->$userRepository = new UserRepository();
        }

        public function index() {
            session_start();

            if (!$_SESSION['user']) {
                return $this->render('login');
            }

            header("Location: {$this->baseUrl()}");
        }

        public function login() {
            if ($this->isGet()) {
                self::index();
                return;
            }

            $json = file_get_contents('php://input');

            $data = json_decode($json);

            $user = $userRepository->getUser($data->username, $data->password);

            if (!$user) {
                echo json_encode(false);
                return;
            }

            session_start();
            $_SESSION["user"] = $user;

            http_response_code(200);
            echo json_encode(true);
        }
    }
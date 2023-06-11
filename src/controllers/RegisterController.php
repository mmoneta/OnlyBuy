<?php
    require_once 'AppController.php';
    require_once __DIR__.'/../repository/UserRepository.php';

    class RegisterController extends AppController {
        private $userRepository;

        public function __construct() {
            parent::__construct();
            $this->$userRepository = new UserRepository();
        }
        
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

            $isUserCreated = $userRepository->createUser(
                $_POST['username'],
                $_FILES['avatar'],
                $_POST['email'],
                $_POST['password']
            );
            
            http_response_code(200);
            echo json_encode($isUserCreated);
        }
    }
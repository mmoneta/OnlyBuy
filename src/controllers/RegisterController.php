<?php
    require_once 'SecurityAppController.php';
    require_once __DIR__.'/../repository/UserRepository.php';

    class RegisterController extends SecurityAppController {
        private $userRepository;

        public function __construct() {
            parent::__construct();
            $this->userRepository = new UserRepository();
        }
        
        public function index() {
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

            $isUserCreated = $this->userRepository->createUser(
                $_POST['username'],
                $_FILES['avatar'],
                $_POST['email'],
                $_POST['password']
            );
            
            http_response_code(200);
            echo json_encode($isUserCreated);
        }
    }
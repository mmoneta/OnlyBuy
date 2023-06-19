<?php
    require_once 'SecurityAppController.php';
    require_once __DIR__.'/../repository/UserRepository.php';

    class UserCreatorController extends SecurityAppController {
        private $userRepository;

        public function __construct() {
            parent::__construct();
            $this->userRepository = new UserRepository();
        }

        public function index() {
            if (isset($_SESSION['user']) && $_SESSION['user']->getRole() == 'admin') {
                return $this->render('user-creator');
            }

            header("Location: {$this->baseUrl()}");
        }
    
        public function user() {
            $isUserCreated = $this->userRepository->createUser(
                $_POST['username'],
                $_FILES['avatar'],
                $_POST['email'],
                $_POST['password'],
                $_POST['roleId']
            );
            
            http_response_code(200);
            echo json_encode($isUserCreated);
        }
    }
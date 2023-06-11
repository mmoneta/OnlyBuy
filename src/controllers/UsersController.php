<?php
    require_once 'AppController.php';
    require_once __DIR__.'/../repository/UserRepository.php';

    class UsersController extends AppController {
        private $userRepository;

        public function __construct() {
            parent::__construct();
            $this->$userRepository = new UserRepository();
        }

        public function index(string $username) {
            session_start();
            
            if (isset($_SESSION['user']) && $_SESSION['user']->getRole() == 'admin') {
                if ($username) {
                    return $this->render('user-editor');
                }

                return $this->render('users');
            }

            header("Location: {$this->baseUrl()}");
        }

        public function users(string $username) {
            if ($this->isAjax()) {
                $users = $userRepository->getUsers();
                    
                echo json_encode($users);
                return;
            }

            self::index($username);
        }
    }
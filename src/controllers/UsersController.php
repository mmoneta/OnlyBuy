<?php
    require_once 'SecurityAppController.php';
    require_once __DIR__.'/../repository/UserRepository.php';

    class UsersController extends SecurityAppController {
        private $userRepository;

        public function __construct() {
            parent::__construct();
            $this->userRepository = new UserRepository();
        }

        public function index(string $username) {
            if (isset($_SESSION['user']) && $_SESSION['user']->getRole() == 'admin') {
                if ($username) {
                    return $this->render('user-editor');
                }

                return $this->render('users');
            }

            header("Location: {$this->baseUrl()}");
        }

        public function users(string $username = '') {
            if ($this->isAjax() && !$username) {
                $users = $this->userRepository->getUsers();
                    
                http_response_code(200);
                echo json_encode($users);
                return;
            }

            if ($this->isAjax() && $username) {
                $user = $this->userRepository->getUserDetails($username);
                    
                http_response_code(200);
                echo json_encode($user);
                return;
            }

            self::index($username);
        }
    }
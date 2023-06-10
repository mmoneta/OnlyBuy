<?php
    require_once 'AppController.php';
    require_once __DIR__.'/../repository/UserRepository.php';

    class UsersController extends AppController {
        public function index() {
            if (isset($_SESSION['user']) && $_SESSION['user']->getRole() == 'admin') {
                return $this->render('users');
            }

            header("Location: {$this->baseUrl()}");
        }

        public function users() {
            if ($this->isAjax()) {
                $userRepository = new UserRepository();
                $users = $userRepository->getUsers();
                    
                echo json_encode($users);
                return;
            }
            
            self::index();
        }
    }
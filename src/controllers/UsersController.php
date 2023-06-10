<?php
    require_once 'AppController.php';
    require_once __DIR__.'/../repository/UserRepository.php';

    class UsersController extends AppController {
        public function index() {
            session_start();

            if (isset($_SESSION['user']) && $_SESSION['user']->getRole() == 'admin') {
                return $this->render('users');
            }

            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}");
        }

        public function users() {
            if ($this->isAjax()) {
                $userRepository = new UserRepository();
                $users = $userRepository->getUsers();
    
                header('Content-type: application/json');
                
                echo json_encode($users);
                return;
            }
            
            self::index();
        }
    }
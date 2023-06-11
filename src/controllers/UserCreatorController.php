<?php
    require_once 'AppController.php';
    require_once __DIR__.'/../repository/UserRepository.php';

    class UserCreatorController extends AppController {
        public function index() {
            session_start();

            if (isset($_SESSION['user']) && $_SESSION['user']->getRole() == 'admin') {
                return $this->render('user-creator');
            }

            header("Location: {$this->baseUrl()}");
        }
    
        public function user() {
            $userRepository = new UserRepository();

            $isUserCreated = $userRepository->createUser(
                $_POST['username'],
                $_FILES['avatar'],
                $_POST['email'],
                $_POST['password'],
                $_POST['roleId']
            );
            
            echo json_encode($isUserCreated);
        }
    }
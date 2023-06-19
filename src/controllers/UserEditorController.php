<?php
    require_once 'SecurityAppController.php';
    require_once __DIR__.'/../repository/UserRepository.php';

    class UserEditorController extends SecurityAppController {
        public function index() {
            if (isset($_SESSION['user']) && $_SESSION['user']->getRole() == 'admin') {
                return $this->render('user-creator');
            }

            header("Location: {$this->baseUrl()}");
        }
    }
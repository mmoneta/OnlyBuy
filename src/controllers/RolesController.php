<?php
    require_once 'AppController.php';
    require_once __DIR__.'/../repository/RoleRepository.php';

    class RolesController extends AppController {
        private $roleRepository;

        public function __construct() {
            parent::__construct();
            $this->roleRepository = new RoleRepository();
        }

        public function roles() {
            $roles = $this->roleRepository->getRoles();
            
            http_response_code(200);
            echo json_encode($roles);
        }
    }
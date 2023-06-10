<?php
    require_once 'AppController.php';
    require_once __DIR__.'/../repository/RoleRepository.php';

    class RolesController extends AppController {
        public function roles() {
            $roleRepository = new RoleRepository();
            $roles = $roleRepository->getRoles();

            header('Content-type: application/json');
            
            echo json_encode($roles);
        }
    }
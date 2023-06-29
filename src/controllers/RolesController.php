<?php

namespace src\controllers;

use src\repository\RoleRepository;

class RolesController extends AppController
{
    private RoleRepository $roleRepository;

    public function __construct()
    {
        parent::__construct();
        $this->roleRepository = new RoleRepository();
    }

    public function roles()
    {
        $roles = $this->roleRepository->getRoles();

        http_response_code(200);
        echo json_encode($roles);
    }
}
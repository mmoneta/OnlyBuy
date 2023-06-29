<?php

namespace src\repository;

use PDO;
use src\models\Role;

class RoleRepository extends Repository
{
    public function getRoles(): array
    {
        $sql = $this->database->connection->prepare('
                SELECT * FROM public.roles
            ');
        $sql->execute();

        $roles = $sql->fetchAll(PDO::FETCH_ASSOC);

        $output = [];

        foreach ($roles as $role) {
            $output[] = new Role(
                $role['role_id'],
                $role['name']
            );
        }

        return $output;
    }
}
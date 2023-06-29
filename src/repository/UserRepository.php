<?php

namespace src\repository;

use PDO;
use src\models\User;

class UserRepository extends Repository
{
    public function createUser(string $username, string $email, string $password, int $roleId, $avatar): bool
    {
        $uploadFile = NULL;

        if ($avatar) {
            $dir = $this->files->getUploadDirectory() . 'avatar';

            if (!is_dir($dir)) {
                mkdir($dir, 0700);
            }

            $uploadFile = $dir . '/'
                . basename(date('d_m_y_h_i_s_'))
                . basename(str_replace(' ', '_', $avatar['name']));
            move_uploaded_file($avatar['tmp_name'], $uploadFile);
        }

        $sql = $this->database->connection->prepare('
                INSERT INTO users (username, avatar, email, password, role_id, created_date, modified_date)
                    VALUES(:username, :avatar, :email, :password, :role_id, :created_date, :modified_date)
            ');
        $sql->bindParam(':username', $username, PDO::PARAM_STR);
        $sql->bindParam(':avatar', $uploadFile, PDO::PARAM_STR);
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->bindParam(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
        $sql->bindParam(':role_id', $roleId, PDO::PARAM_INT);
        $sql->bindParam(':created_date', date("Y-m-d"), PDO::PARAM_STR);
        $sql->bindParam(':modified_date', date("Y-m-d"), PDO::PARAM_STR);

        try {
            $sql->execute();
            return true;
        } catch (Exception $e) {
            if ($uploadFile) {
                unlink($uploadFile);
            }

            return false;
        }
    }

    public function getUserDetails(string $username): ?User
    {
        $user = $this->getUser($username);

        return new User(
            $user['avatar'],
            $user['username'],
            $user['email'],
            $user['role'],
            $user['created_date'],
            $user['modified_date']
        );
    }

    public function verifyUser(string $username, string $password): ?User
    {
        $user = $this->getUser($username);

        if (password_verify($password, $user['password'])) {
            return new User(
                $user['avatar'],
                $user['username'],
                $user['email'],
                $user['role'],
                $user['created_date'],
                $user['modified_date']
            );
        }

        return null;
    }

    public function getUsers(): array
    {
        $sql = $this->database->connection->prepare('
                SELECT users.avatar, users.username, users.email, roles.name as role, users.created_date, users.modified_date
                    FROM users
                    INNER JOIN roles ON users.role_id = roles.role_id
            ');
        $sql->execute();

        $users = $sql->fetchAll(PDO::FETCH_ASSOC);

        $output = [];

        foreach ($users as $user) {
            $output[] = new User(
                $user['avatar'],
                $user['username'],
                $user['email'],
                $user['role'],
                $user['created_date'],
                $user['modified_date']
            );
        }

        return $output;
    }

    private function getUser(string $username)
    {
        $sql = $this->database->connection->prepare('
                SELECT u.avatar, u.username, u.email, u.password, r.name as role, u.created_date, u.modified_date
                    FROM users u
                    INNER JOIN roles r ON u.role_id = r.role_id
                    WHERE u.username = :username
            ');
        $sql->bindParam(':username', $username, PDO::PARAM_STR);
        $sql->execute();

        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return $user;
    }
}
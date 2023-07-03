<?php

namespace src\repository;

use Exception;
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

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

        $date = date("Y-m-d");

        $sql->bindParam(':role_id', $roleId, PDO::PARAM_INT);
        $sql->bindParam(':created_date', $date, PDO::PARAM_STR);
        $sql->bindParam(':modified_date', $date, PDO::PARAM_STR);

        try {
            $sql->execute();
            return true;
        } catch (Exception $e) {
            var_dump($e);
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
            $user['user_id'],
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
                $user['user_id'],
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
        $sql = $this->database->connection->prepare('SELECT * FROM users_with_roles');
        $sql->execute();

        $users = $sql->fetchAll(PDO::FETCH_ASSOC);

        $output = [];

        foreach ($users as $user) {
            $output[] = new User(
                $user['user_id'],
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

    public function updatePassword(string $username, string $password)
    {
        $sql = $this->database->connection->prepare('
                UPDATE users
                SET password = :password
                WHERE username = :username
            ');
        $sql->bindParam(':username', $username, PDO::PARAM_STR);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

        $sql->execute();

        return true;
    }

    public function updateRole(string $username, int $roleId)
    {
        $sql = $this->database->connection->prepare('
                UPDATE users
                SET role_id = :role_id
                WHERE username = :username
            ');
        $sql->bindParam(':username', $username, PDO::PARAM_STR);
        $sql->bindParam(':role_id', $roleId, PDO::PARAM_INT);

        $sql->execute();

        return true;
    }

    private function getUser(string $username)
    {
        $sql = $this->database->connection->prepare('
                SELECT u.user_id, u.avatar, u.username, u.email, u.password, r.name as role, u.created_date, u.modified_date
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
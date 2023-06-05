<?php
    require_once 'Repository.php';
    require_once __DIR__.'/../models/User.php';

    class UserRepository extends Repository {
        public function getUser(string $username, string $password): ?User {
            $stmt = $this->database->connection->prepare('
                SELECT * FROM public.users WHERE username = :username AND password = :password
            ');
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user == false) {
                return null;
            }

            return new User(
                $user['username'],
                $user['email'],
                $user['password'],
                $user['created_date'],
                $user['modified_date']
            );
        }
    }
<?php
    require_once 'Repository.php';
    require_once __DIR__.'/../models/User.php';

    class UserRepository extends Repository {
        public function createUser(string $username, string $email, string $password): bool {
            $sql = $this->database->connection->prepare('
                INSERT INTO public.users (username, email, password, role_id, created_date, modified_date)
                    VALUES(:username, :email, :password, 1, :created_date, :modified_date)
            ');
            $sql->bindParam(':username', $username, PDO::PARAM_STR);
            $sql->bindParam(':email', $email, PDO::PARAM_STR);
            $sql->bindParam(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
            $sql->bindParam(':created_date', date("Y-m-d"), PDO::PARAM_STR);
            $sql->bindParam(':modified_date', date("Y-m-d"), PDO::PARAM_STR);

            try {
                $sql->execute();
                return true;
            }
            catch (Exception $e) {
                return false;
            }
        }

        public function getUser(string $username, string $password): ?User {
            $sql = $this->database->connection->prepare('
                SELECT public.users.username, public.users.email, public.users.password, public.roles.name, public.users.created_date, public.users.modified_date
                    FROM public.users
                    INNER JOIN public.roles ON public.users.role_id = public.roles.role_id
                    WHERE public.users.username = :username
            ');
            $sql->bindParam(':username', $username, PDO::PARAM_STR);
            $sql->execute();

            $user = $sql->fetch(PDO::FETCH_ASSOC);

            if ($user == false) {
                return null;
            }

            if (password_verify($password, $user['password'])) {
                return new User(
                    $user['username'],
                    $user['email'],
                    $user['name'],
                    $user['created_date'],
                    $user['modified_date']
                );
            }

            return null;
        }
    }
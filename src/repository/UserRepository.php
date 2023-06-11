<?php
    require_once 'Repository.php';
    require_once __DIR__.'/../models/User.php';

    class UserRepository extends Repository {
        public function createUser(string $username, ?File $avatar, string $email, string $password, int $roleId = 1): bool {
            $uploadFile = NULL;

            if ($avatar) {
                $dir = $this->files->getUploadDirectory().'avatar';

                if (!is_dir($dir)) {
                    mkdir($dir, 0700);
                }

                $uploadFile = $dir.'/'
                    .basename(date('d_m_y_h_i_s_'))
                    .basename($avatar['name']);
                move_uploaded_file($avatar['tmp_name'], $uploadFile);
            } 

            $sql = $this->database->connection->prepare('
                INSERT INTO public.users (username, avatar, email, password, role_id, created_date, modified_date)
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
            }
            catch (Exception $e) {
                echo($avatar);
                if ($uploadFile) {
                    unlink($uploadFile);
                }

                return false;
            }
        }

        public function getUser(string $username, string $password): ?User {
            $sql = $this->database->connection->prepare('
                SELECT public.users.username, public.users.email, public.users.password, public.roles.name as role, public.users.created_date, public.users.modified_date
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
                    $user['role'],
                    $user['created_date'],
                    $user['modified_date']
                );
            }

            return null;
        }

        public function getUsers(): array {
            $sql = $this->database->connection->prepare('
                SELECT public.users.username, public.users.email, public.roles.name as role, public.users.created_date, public.users.modified_date
                    FROM public.users
                    INNER JOIN public.roles ON public.users.role_id = public.roles.role_id
            ');
            $sql->execute();

            $users = $sql->fetchAll(PDO::FETCH_ASSOC);

            $output = [];

            foreach ($users as $user) {
                $output[] = new User(
                    $user['username'],
                    $user['email'],
                    $user['role'],
                    $user['created_date'],
                    $user['modified_date']
                );
            }

            return $output;
        }
    }
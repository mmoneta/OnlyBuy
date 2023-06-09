<?php
    require_once 'Repository.php';
    require_once __DIR__.'/../models/Product.php';

    class ProductRepository extends Repository {
        public function createProduct(string $name, string $description, array $images, bool $isActive, bool $isPromo): bool {
            $sql = $this->database->connection->prepare('
                INSERT INTO public.products (name, description, is_active, is_promo)
                    VALUES(:name, :description, :is_active, :is_promo)
            ');
            $sql->bindParam(':name', $name, PDO::PARAM_STR);
            $sql->bindParam(':description', $description, PDO::PARAM_STR);
            $sql->bindParam(':is_active', $isActive, PDO::PARAM_BOOL);
            $sql->bindParam(':is_promo', $isPromo, PDO::PARAM_BOOL);

            try {
                $sql->execute();
                $productId = $this->database->connection->lastInsertId();

                for ($i = 0; $i < count($images['name']); $i++) {
                    $uploadFile = $this->files->getUploadDirectory().basename($images['name'][$i]);
                    move_uploaded_file($images['tmp_name'][$i], $uploadFile);
    
                    $fileSql = $this->database->connection->prepare('
                        INSERT INTO public.products_images (product_id, file) VALUES(:product_id, :file)
                    ');
                    $fileSql->bindParam(':product_id', $productId, PDO::PARAM_INT);
                    $fileSql->bindParam(':file', $uploadFile, PDO::PARAM_STR);
                    $fileSql->execute();
                }

                return true;
            }
            catch (Exception $e) {
                return false;
            }
        }

        public function getProducts(string $username, string $password): array {
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
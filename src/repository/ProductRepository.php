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

        public function getProducts(): array {
            $sql = $this->database->connection->prepare('
                SELECT * FROM public.products
                    LEFT JOIN public.products_images ON products.product_id = products_images.product_id
            ');
            $sql->execute();

            $products = $sql->fetchAll(PDO::FETCH_ASSOC);

            $output = [];

            for ($i = 0; $i < count($products); $i++) {
                echo($products[$i]["product_id"]);
                $product = new Product(
                    $products[$i]['product_id'],
                    $products[$i]['name'],
                    $products[$i]['description'],
                    $products[$i]['is_active'],
                    $products[$i]['is_promo'],
                    [$products[$i]['file']]
                );
                    
                array_push($output, $product);
            }

            return $output;
        }
    }
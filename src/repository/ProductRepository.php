<?php
    require_once 'Repository.php';
    require_once __DIR__.'/../models/Product.php';

    class ProductRepository extends Repository {
        public function createProduct(string $name, string $description, array $images, bool $isActive, bool $isPromo): bool {
            $sql = $this->database->connection->prepare('
                INSERT INTO public.products (name, description, is_active, is_promo, created_date, modified_date)
                    VALUES(:name, :description, :is_active, :is_promo, :created_date, :modified_date)
            ');
            $sql->bindParam(':name', $name, PDO::PARAM_STR);
            $sql->bindParam(':description', $description, PDO::PARAM_STR);
            $sql->bindParam(':is_active', $isActive, PDO::PARAM_BOOL);
            $sql->bindParam(':is_promo', $isPromo, PDO::PARAM_BOOL);
            $sql->bindParam(':created_date', date("Y-m-d"), PDO::PARAM_STR);
            $sql->bindParam(':modified_date', date("Y-m-d"), PDO::PARAM_STR);

            try {
                $sql->execute();
                $productId = $this->database->connection->lastInsertId();

                $dir = $this->files->getUploadDirectory().'product/'.$productId;

                if (!is_dir($dir)) {
                    mkdir($dir, 0700);
                }

                for ($i = 0; $i < count($images['name']); $i++) {
                    $uploadFile = $dir.'/'
                        .basename(date('d_m_y_h_i_s_'))
                        .basename($images['name'][$i]);
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

            $output = array();

            foreach ($products as $product) {
                $output[$product['product_id']]['productId'] = $product['product_id'];
                $output[$product['product_id']]['name'] = $product['name'];
                $output[$product['product_id']]['description'] = $product['description'];
                $output[$product['product_id']]['isActive'] = $product['is_active'];
                $output[$product['product_id']]['isPromo'] = $product['is_promo'];
                $output[$product['product_id']]['createdDate'] = $product['created_date'];
                $output[$product['product_id']]['modifiedDate'] = $product['modified_date'];
                $output[$product['product_id']]['images'][] = $product['file'];
            }

            return array_values($output);
        }
    }
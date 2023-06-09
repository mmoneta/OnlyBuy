<?php

namespace src\repository;

use Exception;
use PDO;

class ProductRepository extends Repository
{
    public function createProduct(string $name, string $description, array $images, bool $isActive, bool $isPromo): bool
    {
        $sql = $this->database->connection->prepare('
                INSERT INTO products (name, description, is_active, is_promo, created_date, modified_date)
                    VALUES(:name, :description, :is_active, :is_promo, :created_date, :modified_date)
            ');
        $sql->bindParam(':name', $name, PDO::PARAM_STR);
        $sql->bindParam(':description', $description, PDO::PARAM_STR);

        $isActive = intval($isActive); 
        $sql->bindParam(':is_active', $isActive, PDO::PARAM_BOOL);

        $isPromo = intval($isPromo);
        $sql->bindParam(':is_promo', $isPromo, PDO::PARAM_BOOL);

        $date = date("Y-m-d");

        $sql->bindParam(':created_date', $date, PDO::PARAM_STR);
        $sql->bindParam(':modified_date', $date, PDO::PARAM_STR);

        try {
            $sql->execute();
            $productId = $this->database->connection->lastInsertId();

            $dir = $this->files->getUploadDirectory() . 'product';

            if (!is_dir($dir)) {
                mkdir($dir, 0700);
            }

            $dir = $dir . '/' . $productId;

            if (!is_dir($dir)) {
                mkdir($dir, 0700);
            }

            for ($i = 0; $i < count($images['name']); $i++) {
                $uploadFile = $dir . '/'
                    . basename(date('d_m_y_h_i_s_'))
                    . basename(str_replace(' ', '_', $images['name'][$i]));
                move_uploaded_file($images['tmp_name'][$i], $uploadFile);

                $fileSql = $this->database->connection->prepare('
                        INSERT INTO products_images (product_id, file) VALUES(:product_id, :file)
                    ');
                $fileSql->bindParam(':product_id', $productId, PDO::PARAM_INT);
                $fileSql->bindParam(':file', $uploadFile, PDO::PARAM_STR);
                $fileSql->execute();
            }

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getProducts(int $userId, string $search, bool $isActive, bool $isPromo): array
    {
        $command = 'SELECT
            products.product_id,
            products.name,
            products_rates.value,
            products.description,
            products.is_active,
            products.is_promo,
            products.created_date,
            products.modified_date,
            products_images.file 
                FROM products
                LEFT JOIN products_images ON products.product_id = products_images.product_id
                LEFT JOIN products_rates ON products.product_id = products_rates.product_id
                    WHERE products.is_active = :is_active
                        AND products.is_promo = :is_promo';

        if ($search) {
            $command = $command . ' AND products.name LIKE :search';
        }

        $sql = $this->database->connection->prepare($command);

        $isActive = intval($isActive);   
        $sql->bindParam(':is_active', $isActive, PDO::PARAM_BOOL);

        $isPromo = intval($isPromo);
        $sql->bindParam(':is_promo', $isPromo, PDO::PARAM_BOOL);

        if ($search) {
            $search = '%' . $search . '%';
            $sql->bindParam(':search', $search, PDO::PARAM_STR);
        }

        $sql->execute();

        $products = $sql->fetchAll(PDO::FETCH_ASSOC);

        $output = [];

        foreach ($products as $product) {
            $output[$product['product_id']]['productId'] = $product['product_id'];
            $output[$product['product_id']]['name'] = $product['name'];
            $output[$product['product_id']]['rate'] = $product['value'];
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
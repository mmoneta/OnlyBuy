<?php

namespace src\repository;

use Exception;
use PDO;

class RateRepository extends Repository
{
    public function createRate(int $productId, int $userId, int $value): bool
    {
        try {
            $sql = $this->database->connection->prepare('
                INSERT INTO products_rates (product_id, user_id, value)
                    VALUES(:product_id, :user_id, :value)
            ');
            $sql->bindParam(':product_id', $productId, PDO::PARAM_INT);
            $sql->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $sql->bindParam(':value', $value, PDO::PARAM_INT);

            $sql->execute();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
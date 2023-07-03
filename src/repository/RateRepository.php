<?php

namespace src\repository;

use Exception;
use PDO;

class RateRepository extends Repository
{
    public function setRate(int $productId, int $userId, int $value): string
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

            return 'CREATED';
        } catch (Exception $e) {
            if ($e->getCode() === '23505') {
                try {
                    $sql = $this->database->connection->prepare('
                        UPDATE products_rates
                            SET value = :value
                            WHERE product_id = :product_id
                                AND user_id = :user_id
                    ');
                    $sql->bindParam(':product_id', $productId, PDO::PARAM_INT);
                    $sql->bindParam(':user_id', $userId, PDO::PARAM_INT);
                    $sql->bindParam(':value', $value, PDO::PARAM_INT);

                    $sql->execute();

                    return 'UPDATED';
                } catch (Exception $e) {
                    return 'ERROR';
                }
            }

            return 'ERROR';
        }
    }
}
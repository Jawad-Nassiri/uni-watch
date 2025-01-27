<?php

namespace model\repository;

use PDOException;
use model\entity\Admin_add_product;

class ProductRepository extends BaseRepository {
    public function getAllProduct() {
        try {
            $sql = "SELECT * FROM product LIMIT 9";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();

            $productsData = $stmt->fetchAll();

            $products = [];
            foreach ($productsData as $productData) {
                $product = new Admin_add_product();
                $product->setTitle($productData['title']);
                $product->setBrand($productData['brand']);
                $product->setCategory($productData['category']);
                $product->setDescription($productData['description']);
                $product->setImagePath($productData['image_path']);
                $product->setPrice($productData['price']);
                $product->setStock($productData['stock']);

                $products[] = $product;
            }

            return $products;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }


    public function getProductsByOffset($limit, $offset) {
        try {
            $sql = "SELECT * FROM product LIMIT :limit OFFSET :offset";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
            $stmt->execute();
    
            $productsData = $stmt->fetchAll();
    
            $products = [];
            foreach ($productsData as $productData) {
                $product = new Admin_add_product();
                $product->setTitle($productData['title']);
                $product->setBrand($productData['brand']);
                $product->setCategory($productData['category']);
                $product->setDescription($productData['description']);
                $product->setImagePath($productData['image_path']);
                $product->setPrice($productData['price']);
                $product->setStock($productData['stock']);
    
                $products[] = $product;
            }
    
            return $products;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }
    
}

<?php

namespace model\repository;

use PDOException;
use model\entity\Admin_add_product;

class ProductRepository extends BaseRepository {
    public function getAllProduct() {
        try {
            $sql = "SELECT * FROM product LIMIT 12";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();

            $productsData = $stmt->fetchAll();

            $products = [];
            foreach ($productsData as $productData) {
                $product = new Admin_add_product();
                $product->setId($productData['id']);
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
    
            return $productsData;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }

    // get product by id 
    public function getProductById($id) {
        try {
            $sql = "SELECT * FROM product WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
    
            $product = $stmt->fetch(\PDO::FETCH_ASSOC);
    
            if ($product) {
                return $product;
            } else {
                return false;
            }
        } catch(PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }

    // get the product count 
    public function getTotalProductCount() {
        try {
            $sql = "SELECT COUNT(*) as total FROM product";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch();
    
            return (int)$result['total'];
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return 0;
        }
    }
    
    
}

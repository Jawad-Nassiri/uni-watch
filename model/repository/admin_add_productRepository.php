<?php

namespace model\repository;

use PDOException;
use model\entity\Admin_add_product;

class Admin_add_productRepository extends BaseRepository {
    
    // Insert products into product table by admin
    public function addProductByAdmin(Admin_add_product $admin_add_product) {
        try {

            $sql = "INSERT INTO product(title, brand, category, description, image_path, price) VALUES (:title, :brand, :category, :description, :image_path, :price)";
                        
            $stmt = $this->connection->prepare($sql);

            $title = $admin_add_product->getTitle();
            $brand = $admin_add_product->getBrand();
            $category = $admin_add_product->getCategory();
            $description = $admin_add_product->getDescription();
            $imagePath = $admin_add_product->getImagePath();
            $price = $admin_add_product->getPrice();


            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":brand", $brand);
            $stmt->bindParam(":category", $category);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":image_path", $imagePath);
            $stmt->bindParam(":price", $price);


            $stmt->execute();
            return true;

        } catch (PDOException $e) {
            $this->connection->rollBack();

            error_log("Database error: " . $e->getMessage());
            echo "Something went wrong. Please try again.";
            return false;
        }
    }


    // get all products method 
    public function getAllProducts() {
        try {
            $sql = "SELECT * FROM product";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();

            $products = $stmt->fetchAll();

            return $products;

        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            throw new \Exception("Unable to fetch products.");
        }
    }

    // delete product method 
    public function deleteProduct($id) {
        try {
             // Delete the image file
            $sql = "SELECT image_path FROM product WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $product = $stmt->fetch(\PDO::FETCH_ASSOC);
    
            if ($product && isset($product['image_path'])) {
                $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/uni-watch/public/assets/images/watches/' . $product['image_path'];
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }



            $sql = "DELETE FROM product WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
    
            $stmt->bindParam(':id', $id);
            $stmt->execute();
    
        } catch(PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            throw new \Exception("Unable to delete product.");
        }
    }  
}
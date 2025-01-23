<?php

namespace model\repository;

use PDOException;
use model\entity\Admin_add_product;

class admin_add_productRepository extends BaseRepository {
    
    // Insert products into watch and watch_variation tables by admin
    public function addProductByAdmin(Admin_add_product $admin_add_product) {
        try {
            $this->connection->beginTransaction();

            $sqlWatch = "INSERT INTO watch(title, brand, description, price) 
                        VALUES (:title, :brand, :description, :price)";
                        
            $stmtWatch = $this->connection->prepare($sqlWatch);

            $title = $admin_add_product->getTitle();
            $brand = $admin_add_product->getBrand();
            $description = $admin_add_product->getDescription();
            $price = $admin_add_product->getPrice();

            $stmtWatch->bindParam(":title", $title);
            $stmtWatch->bindParam(":brand", $brand);
            $stmtWatch->bindParam(":description", $description);
            $stmtWatch->bindParam(":price", $price);

            $stmtWatch->execute();

            $watchId = $this->connection->lastInsertId();



            $sqlVariation = "INSERT INTO watch_variation(watch_id, color, image_url, stock) 
                            VALUES (:watch_id, :color, :image_url, :stock)";

            $stmtVariation = $this->connection->prepare($sqlVariation);

            $color = $admin_add_product->getColor();
            $photo = $admin_add_product->getPhoto();
            $stock = $admin_add_product->getStock();

            $stmtVariation->bindParam(":watch_id", $watchId);
            $stmtVariation->bindParam(":color", $color);
            $stmtVariation->bindParam(":image_url", $photo);
            $stmtVariation->bindParam(":stock", $stock);

            $stmtVariation->execute();

            $this->connection->commit();

            return true;

        } catch (PDOException $e) {
            $this->connection->rollBack();

            error_log("Database error: " . $e->getMessage());
            echo "Something went wrong. Please try again.";
            return false;
        }
    }
}





 // get all products for admin 
    // public function getAllProductsForAdmin() {
    //     try {
    //         $sql = "SELECT * FROM product";
    //         $stmt = $this->connection->prepare($sql);
    //         $stmt->execute();

    //         $products = $stmt->fetchAll();

    //         return $products;

    //     } catch (PDOException $e) {
    //         error_log("Database error: " . $e->getMessage());
    //         throw new \Exception("Unable to fetch products.");
    //     }
    // }
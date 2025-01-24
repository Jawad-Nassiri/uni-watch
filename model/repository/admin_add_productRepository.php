<?php

namespace model\repository;

use PDOException;
use model\entity\Admin_add_product;

class Admin_add_productRepository extends BaseRepository {
    
    // Insert products into watch and watch_variation tables by admin
    public function addProductByAdmin(Admin_add_product $admin_add_product) {
        try {

            $sqlWatch = "INSERT INTO watch(title, brand, description, image, price, stock) VALUES (:title, :brand, :description, :image, :price, :stock)";
                        
            $stmtWatch = $this->connection->prepare($sqlWatch);

            $title = $admin_add_product->getTitle();
            $brand = $admin_add_product->getBrand();
            $description = $admin_add_product->getDescription();
            $image = $admin_add_product->getImage();
            $price = $admin_add_product->getPrice();
            $stock = $admin_add_product->getStock();


            $stmtWatch->bindParam(":title", $title);
            $stmtWatch->bindParam(":brand", $brand);
            $stmtWatch->bindParam(":description", $description);
            $stmtWatch->bindParam(":image", $image);
            $stmtWatch->bindParam(":price", $price);
            $stmtWatch->bindParam(":stock", $stock);


            $stmtWatch->execute();
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
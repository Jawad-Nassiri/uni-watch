<?php


namespace Model\repository;

class Admin_edit_productRepository extends BaseRepository {

    public function getProductById($id) {
        $sql = "SELECT * FROM product WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    
    public function editProduct($id, $title, $brand, $category, $description, $image_path, $price, $stock) {
        $sql = "UPDATE product 
                SET title = :title, brand = :brand, category = :category, 
                    description = :description, image_path = :image_path, 
                    price = :price, stock = :stock 
                WHERE id = :id";
        
        $stmt = $this->connection->prepare($sql);
        
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, \PDO::PARAM_STR);
        $stmt->bindParam(':brand', $brand, \PDO::PARAM_STR);
        $stmt->bindParam(':category', $category, \PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, \PDO::PARAM_STR);
        $stmt->bindParam(':image_path', $image_path, \PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, \PDO::PARAM_STR);
        $stmt->bindParam(':stock', $stock, \PDO::PARAM_INT);

        return $stmt->execute();
    }
}
<?php

namespace Model\repository;

class Admin_edit_productRepository extends BaseRepository {
    public function editProduct($id, $title, $brand, $category, $description, $image_path, $price, $stock) {
        $sql = "UPDATE product SET title = ?, brand = ?, category = ?, description = ?, image_path = ?, price = ?, stock = ? WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        
        $stmt->bind_param("ssssssddi", $title, $brand, $category, $description, $image_path, $price, $stock, $id);
        return $stmt->execute();
    }
    
}
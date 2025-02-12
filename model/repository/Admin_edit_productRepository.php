<?php

namespace Model\repository;

use controller\BaseController;


class Admin_edit_productRepository extends BaseRepository {
    public function editProduct() {
        $sql = "UPDATE product SET id = ?, title = ?, brand = ?, category = ?, description = ?, price = ?, stock = ? WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        
    }
}
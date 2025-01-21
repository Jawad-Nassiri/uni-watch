<?php

namespace model\repository;

use PDOException;

class Sign_InRepository extends BaseRepository {

    public function getUserByUsername($username) {
        try {
            $sql = "SELECT * FROM user WHERE username = :username LIMIT 1";
            $stmt = $this->connection->prepare($sql); 
            $stmt->bindParam(':username', $username); 
            $stmt->execute();

            $user = $stmt->fetch();

            return $user ? $user : null; 
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false; 
        }
    }
}

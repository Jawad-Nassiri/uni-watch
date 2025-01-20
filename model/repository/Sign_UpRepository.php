<?php

namespace model\repository;

use PDOException;
use model\entity\Sign_Up; 

class Sign_UpRepository extends BaseRepository{

    public function saveSign_UpForm(Sign_Up $sign_up){
    try {
        $sql = "INSERT INTO user (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->connection->prepare($sql);
        
        $username = $sign_up->getUsername();
        $email = $sign_up->getEmail();
        $password = $sign_up->getPassword();
        
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        
        $result = $stmt->execute();
        
        if ($result) {
            return $this->connection->lastInsertId();
        }
        
        return false;
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());

        echo "Something went wrong. Please try again.";
        return false;

    }
}
}

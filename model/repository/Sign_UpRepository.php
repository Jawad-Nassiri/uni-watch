<?php

namespace model\repository;

use PDOException;
use model\entity\Sign_Up; 

class Sign_UpRepository extends BaseRepository{

    public function saveSign_UpForm(Sign_Up $sign_up){
        try {
            $sql = "INSERT INTO user (username, email, password, role)
             VALUES (:username, :email, :password, :role)";
            $stmt = $this->connection->prepare($sql);
            
            $username = $sign_up->getUsername();
            $email = $sign_up->getEmail();
            $password = $sign_up->getPassword();
            $role = $sign_up->getRole();

            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':role', $role);
 
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



    // Method to check if a username already exists
    public function checkIfUsernameExists($username) {
        try {
            $sql = "SELECT COUNT(*) FROM user WHERE username = :username";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }


    
    // Method to check if a email already exists
    public function checkIfEmailExists($email) {
        try {
            $sql = "SELECT COUNT(*) FROM user WHERE email = :email";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }


    public function getAllUsers() {
        try {
            $sql = "SELECT * FROM `user`";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }
}

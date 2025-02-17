<?php

namespace Model\repository;
use PDOException;

class Admin_edit_userRepository extends BaseRepository {
    
    public function deleteUser($id) {
        try {
            
            $sql = "DELETE FROM user WHERE id = :id";
            $stmt = $this->connection->prepare($sql);

            $stmt->bindParam(':id', $id);
            $stmt->execute();

        } catch(PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            throw new \Exception("Unable to delete user.");
        }
    }



    public function editUser($id, $username, $email, $password, $role) {
        $sql = "UPDATE user 
                SET username = :username, email = :email, password = :password, role = :role 
                WHERE id = :id";
    
        $stmt = $this->connection->prepare($sql);
        
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashedPassword, \PDO::PARAM_STR); 
        
        $stmt->bindParam(':role', $role, \PDO::PARAM_INT);
    
        return $stmt->execute();
    }


    public function getUserById($id) {
        try {
            $sql = "SELECT * FROM user WHERE id = :id";
            $stmt = $this->connection->prepare($sql); 
            $stmt->bindParam(':id', $id); 
            $stmt->execute();

            $user = $stmt->fetch();

            return $user ? $user : null; 
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false; 
        }
    }
    
}

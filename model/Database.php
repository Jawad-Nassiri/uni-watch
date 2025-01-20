<?php

namespace model;

class Database {
    private $connection = null;

    public function dbConnect() {
        try {
            $pdo = new \PDO('mysql:host=localhost;dbname=uni-watch', 'root', '');
            $this->connection = $pdo;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
        }

        return $this->connection;
    }
}

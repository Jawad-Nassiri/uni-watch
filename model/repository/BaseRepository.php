<?php

namespace model\repository;

use model\Database;

abstract class BaseRepository {

    protected $db;
    protected $connection;

    public function __construct() {
        $this->db = new Database;
        $this->connection = $this->db->dbConnect();
    }

}
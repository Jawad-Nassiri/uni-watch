<?php

namespace model\entity;

abstract class BaseEntity {
    protected ?int $id = null;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
}
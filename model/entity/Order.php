<?php

namespace model\entity;

class Order extends BaseEntity {
    private $total_price;
    private $date_register;
    private $user_id;

    public function getTotalPrice() {
        return $this->total_price;
    }

    public function setTotalPrice($total_price) {
        $this->total_price = $total_price;
    }

    public function getDateRegister() {
        return $this->date_register;
    }

    public function setDateRegister($date_register) {
        $this->date_register = $date_register;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

}
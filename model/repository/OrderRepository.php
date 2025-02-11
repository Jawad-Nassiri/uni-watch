<?php

namespace Model\Repository;
use Model\Entity\Order;

class OrderRepository extends BaseRepository {

    public function createOrder(Order $order) {
        $sql = "INSERT INTO `order` (`total_price`, `date_register`, `user_id`) VALUES (:total_price, :date_register, :user_id)";
        $stmt = $this->connection->prepare($sql);

        $totalPrice = $order->getTotalPrice();
        $dateRegister = $order->getDateRegister();
        $userId = $order->getUserId();

        $stmt->bindParam(':total_price', $totalPrice);
        $stmt->bindParam(':date_register', $dateRegister);
        $stmt->bindParam(':user_id', $userId);

        $stmt->execute();

        return $this->connection->lastInsertId();
    }
}

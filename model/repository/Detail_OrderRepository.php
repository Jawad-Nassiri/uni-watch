<?php

namespace Model\Repository;
use Model\entity\Order_Detail;

class Detail_OrderRepository extends BaseRepository {
    public function insertOrderDetail(Order_Detail $order_detail) {
        $sql = "INSERT INTO order_detail (order_id, product_id, quantity) VALUES (:order_id, :product_id, :quantity)";
        $stmt = $this->connection->prepare($sql);

        $orderId = $order_detail->getOrderId();
        $productId = $order_detail->getProductId();
        $quantity = $order_detail->getQuantity();

        $stmt->bindValue(':order_id', $orderId);
        $stmt->bindValue(':product_id', $productId);
        $stmt->bindValue(':quantity', $quantity);

        $stmt->execute();
    }
}

<?php

namespace controller;
use Model\repository\OrderRepository;
use Model\repository\Detail_OrderRepository;
use Model\entity\Order;
use Model\entity\Order_Detail;




class PaymentController extends BaseController {
    public function paymentDetail() {

        $input = file_get_contents("php://input");
        $data = json_decode($input, true);

        if (!empty($data["cartProducts"])) {
            $_SESSION["cartProducts"] = $data["cartProducts"];
            $_SESSION["payment_subtotal"] = $data["payment_subtotal"];

            if (isset($_SESSION['user_id'])) {
                echo json_encode(["status" => "success", 'logIn' => $_SESSION['user_id']]);
            } else {
                echo json_encode(["status" => "notLoggedIn", 'message' => 'Please log in to proceed']);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "No data received"]);
        }
    }

    public function paymentPage() {
        $this->render('payment.html.php', [
            "cartProducts" => $_SESSION["cartProducts"],
            "payment_subtotal" => $_SESSION["payment_subtotal"]
        ]);
    }


    // create an order method 
    public function createOrder() {

        $input = file_get_contents("php://input");
        $data = json_decode($input, true);
    
        if (!empty($data["paymentProducts"]) && isset($data["subtotalPrice"])) {


            $orderRepository = new OrderRepository();
            $detailOrderRepository = new Detail_OrderRepository();
    
            $order = new Order();
            $order->setTotalPrice($data["subtotalPrice"]);
            $order->setDateRegister(date('Y-m-d H:i:s'));
            $order->setUserId($_SESSION['user_id']);
    
            $orderId = $orderRepository->createOrder($order);
    
    
            foreach ($data["paymentProducts"] as $product) {
                $orderDetail = new Order_Detail();
                $orderDetail->setOrderId($orderId);
                $orderDetail->setProductId($product["productId"]);
                $orderDetail->setQuantity($product["quantity"]);
    
                $detailOrderRepository->insertOrderDetail($orderDetail);
            }
    
            echo json_encode(["status" => "success", "message" => "Order created successfully"]);
            unset($_SESSION['cart']);
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid order data"]);
        }
    }
    
}

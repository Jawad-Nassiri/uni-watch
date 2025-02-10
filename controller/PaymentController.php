<?php

namespace controller;

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
}

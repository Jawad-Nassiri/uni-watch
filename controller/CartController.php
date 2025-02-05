<?php 

namespace controller;

class CartController extends BaseController {

    public function cartDetail() {
        $cartItems = $_SESSION['cart'] ?? [];
        $totalPrice = $_SESSION['totalPrice'] ?? 0;

        $this->render('cart.html.php', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice
        ]);
    }
}
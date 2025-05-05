<?php 

namespace controller;

class CartController extends BaseController {

    // passing the cart detail to the cart view file 
    public function cartDetail() {
        $cartItems = $_SESSION['cart'] ?? [];
        $totalPrice = $_SESSION['totalPrice'] ?? 0;

        $totalPrice = !empty($cartItems) ? ($_SESSION['totalPrice'] ?? 0) : 0; 

        

        $this->render('cart.html.php', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice
        ]);
    }
    

   


    public function deleteProduct() {
        if (isset($_GET['productId'])) {
            $productId = (int)$_GET['productId'];
    
            if (isset($_SESSION['cart'][$productId])) {
                $productQuantity = isset($_GET['quantity']) ? (int)$_GET['quantity'] : $_SESSION['cart'][$productId]['quantity'];
                $productPrice = $_SESSION['cart'][$productId]['price'];
    
                $_SESSION['totalPrice'] -= $productPrice * $productQuantity;
    
                if ($_SESSION['totalPrice'] < 0) {
                    $_SESSION['totalPrice'] = 0;
                }
    
                unset($_SESSION['cart'][$productId]);
    
    
                echo json_encode([
                    'status' => 'success',
                    'totalPrice' => $_SESSION['totalPrice']
                ]);
                exit;
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Product not found in the cart']);
                exit;
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No product ID provided']);
            exit;
        }
    }
    



    public function updateQuantity() {
        if (isset($_GET['productId']) && isset($_GET['quantity'])) {
            $productId = (int)$_GET['productId'];
            $newQuantity = (int)$_GET['quantity'];

            if ($newQuantity < 1 || $newQuantity > 100) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid quantity']);
                exit;
            }

            if (isset($_SESSION['cart'][$productId])) {
                $oldQuantity = $_SESSION['cart'][$productId]['quantity'];
                $pricePerItem = $_SESSION['cart'][$productId]['price'];

                $_SESSION['totalPrice'] -= $oldQuantity * $pricePerItem;
                $_SESSION['totalPrice'] += $newQuantity * $pricePerItem;

                $_SESSION['cart'][$productId]['quantity'] = $newQuantity;

                echo json_encode([
                    'status' => 'success',
                    'newTotal' => $_SESSION['totalPrice']
                ]);
                exit;
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Product not found in cart']);
                exit;
            }
        }

        echo json_encode(['status' => 'error', 'message' => 'Missing productId or quantity']);
        exit;
    }

}
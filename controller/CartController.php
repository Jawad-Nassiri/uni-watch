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


    // delete product method for the cart file 
    public function deleteProduct() {
        if (isset($_GET['productId'])) {
            $productId = (int)$_GET['productId'];
    
            if (isset($_SESSION['cart'][$productId])) {
                
                $productPrice = $_SESSION['cart'][$productId]['price'];
                $productQuantity = $_SESSION['cart'][$productId]['quantity'];
    
                $_SESSION['totalPrice'] -= $productPrice * $productQuantity;
    
                unset($_SESSION['cart'][$productId]);
    
                $cartCount = count($_SESSION['cart']); 
    
                echo json_encode([
                    'status' => 'success',
                    'cartCount' => $cartCount,
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
    


}
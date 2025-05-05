<?php

namespace controller;

use model\repository\ProductRepository;

class BasketController extends BaseController {

    // Get product detail and store in session
    public function productDetail() {
        if (isset($_GET['productId']) && isset($_GET['quantity'])) {
            $productId = (int)$_GET['productId'];
            $productQuantity = (int)$_GET['quantity'];  

            $productRepository = new ProductRepository();
            $product = $productRepository->getProductById($productId);

            if (!$product) {
                echo json_encode(['status' => 'error', 'message' => 'Product not found']);
                exit;
            }

            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
                $_SESSION['totalPrice'] = 0;
            }

            if (isset($_SESSION['cart'][$productId])) {
                echo json_encode(['status' => 'error']);
                exit;
            } else {
                $_SESSION['cart'][$productId] = [
                    'id' => $product['id'],
                    'title' => $product['title'],
                    'brand' => $product['brand'],
                    'category' => $product['category'],
                    'description' => $product['description'],
                    'image_path' => $product['image_path'],
                    'price' => $product['price'],
                    'quantity' => $productQuantity
                ];

                $_SESSION['totalPrice'] += $product['price'] * $productQuantity;

                echo json_encode([
                    'status' => 'success',
                    'cartCount' => count($_SESSION['cart']),
                    'product' => $_SESSION['cart'][$productId],
                    'totalPrice' => $_SESSION['totalPrice']
                ]);
                exit;
            }
        }

        echo json_encode(['status' => 'error', 'message' => 'No product ID or quantity provided']);
        exit;
    }  


    // delete a product from the cart box 
    public function deleteProduct() {
        if (isset($_GET['productId'])) {
            $productId = (int)$_GET['productId'];

            if (isset($_SESSION['cart'][$productId])) {
                
                $_SESSION['totalPrice'] -= $_SESSION['cart'][$productId]['price'] * $_SESSION['cart'][$productId]['quantity'];
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




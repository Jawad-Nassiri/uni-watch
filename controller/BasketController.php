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
            }

            if (isset($_SESSION['cart'][$productId])) {
                echo json_encode(['status' => 'error', 'message' => 'This product is already in your cart.']);
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
                    'stock' => $product['stock'],
                    'quantity' => $productQuantity
                ];

                echo json_encode([
                    'status' => 'success',
                    'success' => 'Product added to cart',
                    'cartCount' => count($_SESSION['cart']),
                    'product' => $_SESSION['cart'][$productId]
                ]);
                exit;
            }
        }

        echo json_encode(['status' => 'error', 'message' => 'No product ID or quantity provided']);
        exit;
    }  
}




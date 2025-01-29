<?php

namespace controller;

use model\repository\ProductRepository;

class BasketController extends BaseController {
    // get product detail 
    public function productDetail() {
        if (isset($_GET['productId'])) {
            $productId = (int)$_GET['productId'];

            $productRepository = new ProductRepository();
            $product = $productRepository->getProductById($productId);


            if ($product !== false) {
                echo json_encode(['product' => $product]);
            } else {
                echo json_encode(['product' => []]);
            }
        } else {
            echo json_encode(['error' => 'Invalid parameters']);
        }
    }
}



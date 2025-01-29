<?php

namespace controller;

use model\repository\ProductRepository;

class DetailController extends BaseController {
    // get product detail 
    public function productDetail() {
        if (isset($_GET['productId'])) {
            $productId = (int)$_GET['productId'];

            $productRepository = new ProductRepository();
            $product = $productRepository->getProductById($productId);


            if ($product !== false) {
                $this->render('detail.html.php', [
                    'product' => $product
                ]);
            } else {
                $this->render('detail.html.php', [
                    'error' => 'Product not found'
                ]);
            }
        } else {
            $this->render('detail.html.php', [
                'error' => 'Invalid parameters'
            ]);
        }
    }
}

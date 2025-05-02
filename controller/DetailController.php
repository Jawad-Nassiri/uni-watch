<?php

namespace controller;

use model\repository\ProductRepository;

class DetailController extends BaseController {
    // get product detail 
    public function productDetail() {
        if (isset($_GET['id'])) {
            $productId = (int)$_GET['id'];

            $productRepository = new ProductRepository();
            $product = $productRepository->getProductById($productId);


            if ($product) {
                return $this->render('detail.html.php', ['product' => $product]);
            } else {
                echo 'Product not found';
            }
        } else {
            echo 'Invalid parameters';
        }
    }
}

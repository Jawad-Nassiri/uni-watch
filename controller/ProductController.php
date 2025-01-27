<?php

namespace controller;

use model\repository\ProductRepository;

class ProductController extends BaseController {
    public function allProducts() {
        $productRepository = new ProductRepository();
        $products = $productRepository->getAllProduct();

        if ($products !== false) {
            $this->render('shop.html.php', [
                'products' => $products
            ]);
        } else {
            $this->render('shop.html.php', [
                'error' => 'Products not found or failed to load.'
            ]);
        }
    }
}

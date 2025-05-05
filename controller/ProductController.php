<?php

namespace controller;

use model\repository\ProductRepository;

class ProductController extends BaseController {
    public function allProducts() {
        $productRepository = new ProductRepository();
        $products = $productRepository->getAllProduct();

        if ($products) {
            $this->render('shop.html.php', [
                'products' => $products
            ]);
        } else {
            $this->render('shop.html.php', [
                'error' => 'Products not found or failed to load.'
            ]);
        }
    }


     // Method for loading more products via AJAX
    public function loadMoreProducts() {
        if (isset($_GET['offset']) && isset($_GET['limit'])) {
            $offset = (int)$_GET['offset'];
            $limit = (int)$_GET['limit'];

            
            $productRepository = new ProductRepository();
            $products = $productRepository->getProductsByOffset($limit, $offset);
            $totalProductCount = $productRepository->getTotalProductCount();

            if ($products) {
                echo json_encode([
                    'products' => $products,
                    'total' => $totalProductCount
                ]);
            } else {
                echo json_encode(['products' => []]);
            }
        } else {
            echo json_encode(['error' => 'Invalid parameters']);
        }
    }
}

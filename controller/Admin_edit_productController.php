<?php
namespace Controller;

use Model\repository\Admin_edit_productRepository;

class Admin_edit_productController extends BaseController {
    private Admin_edit_productRepository $repository;

    public function __construct() {
        $this->repository = new Admin_edit_productRepository();
    }

    public function editProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $productId = (int)$_GET['id'];
            $product = $this->repository->getProductById($productId);
    
            if (!$product) {
                header("Location: /uni-watch/admin_add_product/addProduct");
                exit;
            }
    
            return $this->render('admin-edit-product.html.php', [
                'product' => $product,
            ]);
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
            $productId = (int)$_GET['id'];
            $title = $_POST['product-title'];
            $brand = $_POST['product-brand'];
            $category = $_POST['product-category'];
            $description = $_POST['product-description'];
            $price = $_POST['product-price'];
            $stock = $_POST['product-stock'];
    
            if (!empty($_FILES['product-image']['name'])) {
                $oldProduct = $this->repository->getProductById($productId);
                $oldImagePath = __DIR__ . '/../public/assets/images/watches/' . $oldProduct['image_path'];
                
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            
                $image_path = basename($_FILES['product-image']['name']);
                $full_path = __DIR__ . '/../public/assets/images/watches/' . $image_path;
                move_uploaded_file($_FILES['product-image']['tmp_name'], $full_path);
            } else {
                $product = $this->repository->getProductById($productId);
                $image_path = $product['image_path'];
            }
    
            $this->repository->editProduct($productId, $title, $brand, $category, $description, $image_path, $price, $stock);
    
            header("Location: /uni-watch/admin_add_product/addProduct");
            exit;
        }
    }
}
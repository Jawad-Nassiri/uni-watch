<?php
namespace controller;

use model\repository\admin_add_productRepository;
use Form\Admin_add_productHandleRequest;
use model\entity\Admin_add_product;
use Exception;

class Admin_add_productController extends BaseController {
    private Admin_add_product $admin_add_product;
    private admin_add_productRepository $repository;

    public function __construct() {
        $this->admin_add_product = new Admin_add_product;
        $this->repository = new admin_add_productRepository();
    }

    public function addProduct() {
        $products = $this->repository->getAllProducts();
        $formHandler = new Admin_add_productHandleRequest();
        
        $admin_add_product = $formHandler->handleAdminAddProductRequest($this->admin_add_product);
        $errors = [];

        if ($formHandler->isSubmitted()) {
            if ($formHandler->isValid()) {
                $result = $this->repository->addProductByAdmin($admin_add_product);
                
                if ($result) {
                    redirection('/uni-watch/home/index');
                    exit;
                } else {
                    $errors['general'] = "Failed to add the product. Please try again.";
                    $formHandler->setErrorsForm($errors);
                }
            } else {
                $formHandler->setErrorsForm($formHandler->getErrorsForm());
            }
        }

        return $this->render('admin-add-product.html.php', [
            'errors' => $formHandler->getErrorsForm(),
            'products' => $products
        ]);
    }



    public function getProduct() {
        $products = $this->repository->getAllProducts();
        
        if(empty($products)) {
            return ['status' => 'error', 'message' => 'No products found'];
        }
        
        return ['status' => 'success', 'products' => $products];
    }


    public function deleteProduct() {
        if (!isset($_GET['productId'])) {
            echo json_encode(['status' => 'error', 'message' => 'Id not found']);
            exit;
        }
    
        $productId = (int)$_GET['productId'];
        
        try {
            $this->repository->deleteProduct($productId);
            echo json_encode(['status' => 'success', 'message' => 'Product deleted successfully']);
            exit;
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Error deleting product']);
            exit;
        }
    }
    
}

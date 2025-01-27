<?php

// namespace controller;

// use model\repository\admin_add_productRepository;
// use Form\Admin_add_productHandleRequest;
// use model\entity\Admin_add_product;

// class Admin_add_productController extends BaseController {
//     private Admin_add_product $admin_add_product;

//     public function __construct() {
//         $this->admin_add_product = new Admin_add_product;
//     }

//     public function addProduct() {
//         $formHandler = new Admin_add_productHandleRequest();
//         $admin_add_product = $formHandler->handleAdminAddProductRequest($this->admin_add_product);
//         $errors = [];

//         if ($formHandler->isSubmitted()) {
//             if ($formHandler->isValid()) {
//                 $repository = new admin_add_productRepository();
//                 $result = $repository->addProductByAdmin($admin_add_product);

//                 if ($result) {
//                     redirection('/uni-watch/home/index');
//                     exit;
//                 } else {
//                     $errors['general'] = "Failed to add the product. Please try again.";
//                     $formHandler->setErrorsForm($errors);
//                 }
//             } else {
//                 $formHandler->setErrorsForm($formHandler->getErrorsForm());
//             }
//         }

//         return $this->render('admin-add-product.html.php', [
//             'errors' => $formHandler->getErrorsForm()
//         ]);
//     }
// }
namespace controller;

use model\repository\admin_add_productRepository;
use Form\Admin_add_productHandleRequest;
use model\entity\Admin_add_product;

class Admin_add_productController extends BaseController {
    private Admin_add_product $admin_add_product;

    public function __construct() {
        $this->admin_add_product = new Admin_add_product;
    }

    public function addProduct() {
        // Initialize the form handler
        $formHandler = new Admin_add_productHandleRequest();
        
        // Handle the form and get the product entity
        $admin_add_product = $formHandler->handleAdminAddProductRequest($this->admin_add_product);
        $errors = [];

        // Check if form is submitted
        if ($formHandler->isSubmitted()) {
            // Check if form is valid
            if ($formHandler->isValid()) {
                // Attempt to add the product to the repository
                $repository = new admin_add_productRepository();
                $result = $repository->addProductByAdmin($admin_add_product);

                // If the product was successfully added, redirect to the home page
                if ($result) {
                    redirection('/uni-watch/home/index');
                    exit;
                } else {
                    // If there was an error adding the product, set a general error message
                    $errors['general'] = "Failed to add the product. Please try again.";
                    $formHandler->setErrorsForm($errors);
                }
            } else {
                // If the form was not valid, set the form errors
                $formHandler->setErrorsForm($formHandler->getErrorsForm());
            }
        }

        // Render the form with any errors
        return $this->render('admin-add-product.html.php', [
            'errors' => $formHandler->getErrorsForm()
        ]);
    }
}

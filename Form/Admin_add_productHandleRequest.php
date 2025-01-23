<?php


namespace Form;
use model\entity\Admin_add_product;
class Admin_add_productHandleRequest extends BaseHandleRequest {
    public function handleAdminAddProductRequest(Admin_add_product $admin_add_product) {
        if($this->isSubmitted()) {
            $errors = [];

            if (empty($_POST['product-title'])) {
                $errors['title'] = "Title is required";
            }

            if (empty($_POST['product-brand'])) {
                $errors['brand'] = "Brand is required";
            }

            if (empty($_POST['product-description'])) {
                $errors['description'] = "Description is required";
            }

            if (empty($_POST['product-price'])) {
                $errors['price'] = "Price is required";
            }
            // if (empty($_POST['product-photo'])) {
            //     $errors['photo'] = "Photo is required";
            // }


            // if (empty($_POST['product-stock'])) {
            //     $errors['stock'] = "Stock is required";
            // }

            if(empty($errors)) {
                $admin_add_product->setTitle($_POST['product-title']);
                $admin_add_product->setBrand($_POST['product-brand']);
                $admin_add_product->setDescription($_POST['product-description']);
                $admin_add_product->setPrice($_POST['product-price']);
                // $admin_add_product->setPhoto($_POST['product-photo']);
                // $admin_add_product->setStock($_POST['product-stock']);

                return $admin_add_product;
            }else {
                $this->setErrorsForm($errors);
            }
        }
    }
}
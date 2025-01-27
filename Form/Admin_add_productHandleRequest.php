<?php

namespace Form;
use model\entity\Admin_add_product;

class Admin_add_productHandleRequest extends BaseHandleRequest {
    public function handleAdminAddProductRequest(Admin_add_product $admin_add_product) {
        $errors = [];

        if ($this->isSubmitted()) {
            if (empty($_POST['product-title'])) {
                $errors['title'] = "Title is required";
            }

            if (empty($_POST['product-brand'])) {
                $errors['brand'] = "Brand is required";
            }

            if (empty($_POST['product-category'])) {
                $errors['category'] = "Category is required";
            }

            if (empty($_POST['product-description'])) {
                $errors['description'] = "Description is required";
            }


            if (empty($_FILES['product-image']['name'])) {
                $errors['image'] = "Image is required";
            } else {
                if ($_FILES['product-image']['error'] != UPLOAD_ERR_OK) {
                    $errors['image'] = "Error uploading image";
                }

                $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
                $fileType = mime_content_type($_FILES['product-image']['tmp_name']);
                if (!in_array($fileType, $allowedTypes)) {
                    $errors['image'] = "Invalid image type. Allowed types: JPEG, PNG, GIF";
                }
            }

            if (empty($_POST['product-price']) || !is_numeric($_POST['product-price'])) {
                $errors['price'] = "Price is required and must be a valid number";
            }

            if (empty($_POST['product-stock']) || !is_numeric($_POST['product-stock'])) {
                $errors['stock'] = "Stock is required and must be a valid number";
            }

            if (empty($errors)) {
                $admin_add_product->setTitle($_POST['product-title']);
                $admin_add_product->setBrand($_POST['product-brand']);
                $admin_add_product->setCategory($_POST['product-category']);
                $admin_add_product->setDescription($_POST['product-description']);
                
                $imagePath = basename($_FILES['product-image']['name']);
                $imageDirection =  __DIR__ . '/../public/assets/images/watches/'. basename($_FILES['product-image']['name']);
                if (move_uploaded_file($_FILES['product-image']['tmp_name'], $imageDirection)) {
                    $admin_add_product->setImagePath($imagePath);
                } else {
                    $errors['image'] = "Failed to upload image";
                }

                $admin_add_product->setPrice($_POST['product-price']);
                $admin_add_product->setStock($_POST['product-stock']);
                
                if (empty($errors)) {
                    return $admin_add_product;
                } else {
                    $this->setErrorsForm($errors);
                }
            } else {
                $this->setErrorsForm($errors);
            }
        }

        $this->setErrorsForm($errors);
    }
}
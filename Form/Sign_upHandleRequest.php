<?php

namespace Form;

use model\entity\Sign_Up;

class Sign_upHandleRequest extends BaseHandleRequest {

    public function handleSignUpRequest(Sign_Up $sign_up) {

        if ($this->isSubmitted()) {
            $errors = [];
            if (empty($_POST['username']) || strlen($_POST['username']) < 3) {
                $errors['username'] = "Username must be at least 3 characters";
            }

            if (empty($_POST['email'])) {
                $errors['email'] = "Email is required.";
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Invalid email format";
            }
            
            if (empty($_POST['password']) || strlen($_POST['password']) < 6) {
                $errors['password'] = "Password must be at least 6 characters";
            } 
            
            if (empty($errors)) {
                $sign_up->setUsername($_POST['username']);
                $sign_up->setEmail($_POST['email']);
                $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $sign_up->setPassword($hashedPassword);

                return $sign_up;
            } else {
                $this->setErrorsForm($errors);
            }
        }
    }
}
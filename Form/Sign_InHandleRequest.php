<?php

namespace Form;

use model\repository\Sign_InRepository;

class Sign_InHandleRequest extends BaseHandleRequest {

    public function handleSignInRequest() {
        if ($this->isSubmitted()) {
            $errors = [];

            if (empty($_POST['username'])) {
                $errors['username'] = "Username is required.";
            }

            if (empty($_POST['password'])) {
                $errors['password'] = "Password is required.";
            }

            if (empty($errors)) {
                $signInRepo = new Sign_InRepository();
                
                $user = $signInRepo->getUserByUsername($_POST['username']);
                
                if ($user && password_verify($_POST['password'], $user['password'])) {
                    return $user; 
                } else {
                    $errors['general'] = "Invalid username or password.";
                }
            }

            $this->setErrorsForm($errors);
        }
        return null;
    }
}

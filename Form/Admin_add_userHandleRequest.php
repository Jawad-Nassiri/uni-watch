<?php

namespace Form;
use Model\entity\Sign_Up;
use Model\repository\Sign_UpRepository;
class Admin_add_userHandleRequest extends BaseHandleRequest {
    public function handleAddUserRequest(Sign_Up $sign_up) {

        if($this->isSubmitted()) {
            $errors = [];

            if (empty($_POST['username']) || strlen($_POST['username']) < 3) {
                $errors['username'] = "Username must be at least 3 characters";
            }

            $signUpRepo = new Sign_UpRepository();
            if ($signUpRepo->checkIfUsernameExists($_POST['username'])) {
                $errors['username'] = "Username already exists. Please choose another one.";
            }

            if (empty($_POST['email'])) {
                $errors['email'] = "Email is required.";
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Invalid email format.";
            } elseif ($signUpRepo->checkIfEmailExists($_POST['email'])) {
                $errors['email'] = "Email already exists. Please use a different one.";
            }

            if (empty($_POST['password']) || strlen($_POST['password']) < 6) {
                $errors['password'] = "Password must be at least 6 characters";
            } 

            if (!isset($_POST['role'])) {
                $errors['role'] = "Please select a valid user role.";
            }

            if (empty($errors)) {
                $sign_up->setUsername($_POST['username']);
                $sign_up->setEmail($_POST['email']);
                $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $sign_up->setPassword($hashedPassword);
                $sign_up->setRole($_POST['role']); 
                return $sign_up;
            } else {
                $this->setErrorsForm($errors);
            }
        }
    }
}
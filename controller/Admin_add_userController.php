<?php

namespace controller;
use Model\entity\Sign_Up;
use Form\Admin_add_userHandleRequest;
use Model\repository\Sign_UpRepository;

class Admin_add_userController extends BaseController {
    private  Sign_Up $sign_up;
    public function __construct() {
        $this->sign_up = new Sign_Up;
    }

    public function addUser_form() {
        $errors = [];
        $users = [];

        $formHandler = new Admin_add_userHandleRequest();
        $formHandler->handleAddUserRequest($this->sign_up);

        $signUpRepo = new Sign_UpRepository();
        $users = $signUpRepo->getAllUsers();

        if ($formHandler->isSubmitted()) {
            if ($formHandler->isValid()) {
                $signUpRepo->saveSign_UpForm($this->sign_up);  
                redirection('/uni-watch/home/index');
                exit();
            } else {
                $errors = $formHandler->getErrorsForm();
            }
        }

        return $this->render('admin-add-user.html.php', [
            'errors' => $errors,
            'users' => $users 
        ]);
    }



}


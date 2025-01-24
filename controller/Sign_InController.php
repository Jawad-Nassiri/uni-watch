<?php


namespace controller;

use Form\Sign_InHandleRequest;

class Sign_InController extends BaseController {

    public function signInForm() {
        $formHandler = new Sign_InHandleRequest();
        $formHandler->handleSignInRequest();
        $errors = [];

        if ($formHandler->isSubmitted()) {
            if ($formHandler->isValid()) {
                $user = $formHandler->handleSignInRequest();
                
                $_SESSION['user_id'] = $user['id']; 
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                redirection('/uni-watch/home/index');
                exit();
            } else {
                $errors = $formHandler->getErrorsForm();
            }
        }

        return $this->render('sign-in.html.php', ['errors' => $errors]);
    }
}

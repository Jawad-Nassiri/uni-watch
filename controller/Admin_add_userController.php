<?php

namespace controller;
use Model\entity\Sign_Up;
use Form\Admin_add_userHandleRequest;
use Model\repository\Sign_UpRepository;
use Model\repository\Admin_edit_userRepository;
use PDOException;

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
                redirection('/uni-watch/admin_add_user/addUser_form');
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



    public function deleteUser() {
        if (!isset($_GET['userId'])) {
            echo json_encode(['status' => 'error', 'message' => 'Id not found']);
            exit;
        }
    
        $userId = (int)$_GET['userId'];
        $repository = new Admin_edit_userRepository();
        
        try {
            $repository->deleteUser($userId);
            echo json_encode(['status' => 'success', 'message' => 'User deleted successfully']);
            exit;
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Error deleting user']);
            exit;
        }
    }

}


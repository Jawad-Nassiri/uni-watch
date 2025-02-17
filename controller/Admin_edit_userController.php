<?php

namespace controller;
use Model\repository\Admin_edit_userRepository;

class Admin_edit_userController extends BaseController {
    
    private $repository; 
    
    public function __construct() {
        $this->repository = new Admin_edit_userRepository();
    }
    
    public function editUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $userId = (int)$_GET['id'];
            $user = $this->repository->getUserById($userId);


            if (!$user) {
                header("Location: /uni-watch/admin_add_user/addUser_form?error=UserNotFound");
                exit;
            }

            return $this->render('admin-edit-user.html.php', [
                'user' => $user
            ]);
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
            $userId = (int)$_GET['id'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = (int)$_POST['role'];

            if (!empty($password)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            } else {
                $user = $this->repository->getUserById($userId);
                $hashedPassword = $user['password'];
            }

            $updateResult = $this->repository->editUser($userId, $username, $email, $hashedPassword, $role);

            if ($updateResult) {
                header("Location: /uni-watch/admin_add_user/addUser_form?success=UserUpdated");
            } else {
                header("Location: /uni-watch/admin_add_user/addUser_form?error=UpdateFailed");
            }
            exit;
        }
    }
}

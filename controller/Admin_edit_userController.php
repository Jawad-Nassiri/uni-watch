<?php

namespace controller;
use Model\repository\Admin_edit_userRepository;
use controller\Admin_add_productController;


class Admin_edit_userController extends BaseController {
    
    private $repository; 
    private Admin_add_productController $addProduct;

    
    public function __construct() {
        $this->repository = new Admin_edit_userRepository();
        $this->addProduct = new Admin_add_productController();
    }
    
    public function editUser() {

        $this->addProduct->checkAdminAccess();

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $userId = (int)$_GET['id'];
            $user = $this->repository->getUserById($userId);


            if (!$user) {
                echo "User Not Found";
                exit;
            }

            return $this->render('admin-edit-user.html.php', [
                'user' => $user
            ]);
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
            $userId = (int)$_GET['id'];
            $role = (int)$_POST['role'];

            $updateResult = $this->repository->editUser($userId, $role);

            if ($updateResult) {
                header("Location: /uni-watch/admin_add_user/addUser_form?success=UserUpdated");
            } else {
                echo "Update Failed";
            }
            exit;
        }
    }
}

<!-- admin add user form  -->
<?php include "../public/header.html.php" ?>

<div class="add-user-container">
    <div class="add-user-form">
        <div class="add-user-title">
            <h1>Add New User</h1>
        </div>
        <form class="add-user" method="post" action="/uni-watch/Admin_add_user/addUser">

            <input type="text" class="user-username" name="username" placeholder="Username" autocomplete="none" required>

            <input type="email" class="user-email" name="email" placeholder="Email" autocomplete="none" required>

            <input type="password" class="user-password" name="password" placeholder="Password" autocomplete="none" required>

            <select class="user-role" name="role" aria-placeholder="User Role" required>
                <option value="" disabled selected>User Role</option>
                <option value="0" <?= (isset($_POST['role']) && $_POST['role'] == 0) ? 'selected' : '' ?>>User</option>
                <option value="1" <?= (isset($_POST['role']) && $_POST['role'] == 1) ? 'selected' : '' ?>>Admin</option>
            </select>

            <div class="add-user-submit">
                <input type="submit" value="Register">
            </div>

        </form>

    </div>
    <div class="sign-up-bg-container">
        <div class="sign-up-bg">
        </div>
    </div>
</div>


<?php include "../public/footer.html.php" ?>

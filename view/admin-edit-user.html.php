<!-- admin edit user form  -->
<div class="add-product-container">
    <div class="add-product-form">
        <div class="add-product-title">
            <h1>Edit User</h1>
        </div>
        
        <form class="add-product" method="post" action="/uni-watch/Admin_edit_user/editUser?id=<?= $user['id'] ?>">
            <input type="text" class="product-title" name="username" placeholder="Username"
                value="<?= htmlspecialchars($user['username'] ?? '') ?>" readonly>

            <p class="error-message product-title-error"><?= isset($errors['username']) ? htmlspecialchars($errors['username']) : ''?></p>
            
            <input type="email" class="product-brand" name="email" placeholder="Email"
                value="<?= htmlspecialchars($user['email'] ?? '') ?>" readonly>

            <input type="password" class="product-category" name="password" placeholder="Password" value="000000" readonly>
            <p class="error-message product-category-error"><?= isset($errors['password']) ? htmlspecialchars($errors['password']) : ''?></p>

            <select name="role" class="user-role">
                <option value="1" <?= $user['role'] == 1 ? 'selected' : '' ?>>Admin</option>
                <option value="0" <?= $user['role'] == 0 ? 'selected' : '' ?>>User</option>
            </select>

            <div class="edit-product-submit">
                <input type="submit" value="Update User">
            </div>
        </form>

    </div>
    <div class="sign-up-bg-container">
        <div class="sign-up-bg">
        </div>
    </div>
</div>
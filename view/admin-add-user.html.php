<!-- admin add user form  -->
<div class="add-user-container">
    <div class="add-user-form">
        <div class="add-user-title">
            <h1>Add New User</h1>
        </div>
        <form class="add-user" method="post" action="/uni-watch/Admin_add_user/addUser_form">

            <input type="text" class="user-username" name="username" placeholder="Username" autocomplete="none" required>
            <p class="error-message username-error">
                <?= !empty($errors['username']) ? $errors['username'] : ''; ?>
            </p>

            <input type="email" class="user-email" name="email" placeholder="Email" autocomplete="none" required>
            <p class="error-message email-error">
                <?= !empty($errors['email']) ? $errors['email'] : ''; ?>
            </p>

            <input type="password" class="user-password" name="password" placeholder="Password" autocomplete="none" required>
            <p class="error-message password-error">
                <?= !empty($errors['password']) ? $errors['password'] : ''; ?>
            </p>

            <select class="user-role" name="role" aria-placeholder="User Role" required>
                <option class="selected-option" disabled selected>User Role</option>
                <option value="0" <?= (isset($_POST['role']) && $_POST['role'] == "0") ? 'selected' : '' ?>>User</option>
                <option value="1" <?= (isset($_POST['role']) && $_POST['role'] == "1") ? 'selected' : '' ?>>Admin</option>
            </select>
            <p class="error-message role-error">
                <?= !empty($errors['role']) ? $errors['role'] : ''; ?>
            </p>

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


<!-- user list  -->

<div class="table-container user-list">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id']; ?></td>
                    <td><?= htmlspecialchars($user['username']); ?></td>
                    <td class="email-td"><?= htmlspecialchars($user['email']); ?></td>
                    <td>
                        <?= $user['role'] == 1 ? 'Admin' : 'User'; ?>
                    </td>
                    <td>
                        <div class="user-action-buttons">
                            <button class="btn btn-edit" onclick="location.href = '/uni-watch/admin_edit_user/editUser?id=<?= $user['id']; ?>'; ">Edit</button>
                            <button class="btn btn-delete" data-id="<?= $user['id']; ?>">Delete</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
</div>

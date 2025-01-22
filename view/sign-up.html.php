

<div class="sign-up-container">
    <div class="sign-up-form">
        <div class="sign-up-title">
            <h1>Sign Up</h1>
        </div>
        <form class="sign-up" method="post" action="/uni-watch/sign_up/sign_UpForm">

            <input type="text" class="sign-up-username" name="username" placeholder="Username">
            <p class="error-message username-error">
                <?= !empty($errors['username']) ? $errors['username'] : ''; ?>
            </p>


            <input type="email" class="sign-up-email" name="email" placeholder="Email">
            <p class="error-message email-error">
                <?= !empty($errors['email']) ? $errors['email'] : ''; ?>
            </p>


            <div class="sign-up-password">
                <input type="password" class="sign-up-password-input" name="password" placeholder="Password">
                <i class="fa-solid fa-eye-slash" id="eye"></i>
            </div>
            <p class="error-message password-error">
                <?= !empty($errors['password']) ? $errors['password'] : ''; ?>
            </p>


            <div class="sign-up-submit">
                <input type="submit" value="Send">
            </div>
        </form>
    </div>
    <div class="sign-up-bg-container">
        <div class="sign-up-bg">
        </div>
    </div>
</div>


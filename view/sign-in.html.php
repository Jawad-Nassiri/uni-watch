
<div class="sign-in-container">
    <div class="sign-in-form">
        <div class="sign-in-title">
            <h1>Sign In</h1>
        </div>
        <form class="sign-in" method="post" action="/uni-watch/sign_In/signInForm">
            <input type="text" class="sign-in-username" name="username" placeholder="Username">
            <p class="error-message sign-in-username-error"><?= isset($errors['username']) ? htmlspecialchars($errors['username']) : '' ?></p>
            
            <div class="sign-in-password">
                <input type="password" class="sign-in-password-input" name="password" placeholder="Password">
                <i class="fa-solid fa-eye-slash" id="eye"></i>
            </div>
            <p class="error-message sign-in-password-error"><?= isset($errors['password']) ? htmlspecialchars($errors['password']) : '' ?></p>
            
            <p class="error-message sign-in-general-error"><?= isset($errors['general']) ? htmlspecialchars($errors['general']) : '' ?></p>

            <div class="account">
                <p>Don't have an account? <a href="/uni-watch/sign_up/sign_UpForm">Sign Up</a></p>
            </div>

            <div class="sign-in-submit">
                <input type="submit" value="Send">
            </div>
        </form>
    </div>
    <div class="sign-up-bg-container">
        <div class="sign-up-bg">
        </div>
    </div>
</div>
<?php require "../public/header.html.php" ?>
<div class="sign-in-container">
    <div class="sign-in-form">
        <div class="sign-in-title">
            <h1>Sign In</h1>
        </div>
        <form class="sign-in" method="post" action="#">
            <input type="text" class="sign-in-username" name="username" placeholder="Username">
            <p class="error-message sign-in-username-error"></p>
            <div class="sign-in-password">
                <input type="password" class="sign-in-password-input" name="password" placeholder="Password">
                <i class="fa-solid fa-eye-slash" id="eye"></i>
            </div>
            <p class="error-message sign-in-password-error"></p>
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

<?php require "../public/footer.html.php" ?>

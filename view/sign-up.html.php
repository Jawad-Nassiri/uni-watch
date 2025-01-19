<?php require "../public/header.html.php" ?>
<div class="sign-up-container">
    <div class="sign-up-form">
        <div class="sign-up-title">
            <h1>Sign Up</h1>
        </div>
        <form class="sign-up" method="post" action="#">
            <input type="text" class="sign-up-username" name="username" placeholder="Username">
            <input type="email" class="sign-up-email" name="email" placeholder="Email">
            <input type="password" class="sign-up-password" name="password" placeholder="Password">
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

<?php require "../public/footer.html.php" ?>

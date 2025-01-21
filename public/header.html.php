<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- font awesome link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- css custom  -->
    <link rel="stylesheet" href="http://localhost/uni-watch/public/assets/css/style.css">
    <!-- js custom  -->
    <script src="http://localhost/uni-watch/public/assets/js/script.js" defer></script>
</head>
<body>
    <div class="header-section">
        <div class="logo-container">
            <img src="/uni-watch/public/assets/images/logo.png" alt="logo">
        </div>
        <div id="open" class="open-icon">
            <i class="fa-solid fa-bars"></i>
        </div>
        <div class="list">
            <ul id="nav">
                <li id="close"><i class="fa-solid fa-xmark"></i></li>
                <li class="list-item"><a href="http://localhost/uni-watch/view/home.html.php">Home</a></li>
                <li class="list-item"><a href="http://localhost/uni-watch/view/shop.html.php">Watches</a></li>
                <li class="list-item"><a href="http://localhost/uni-watch/view/about.html.php">About</a></li>
                <?php if(!isset($_SESSION['user_id'])): ?>
                    <li class="list-item"><a href="http://localhost/uni-watch/view/sign-in.html.php">Sign in</a></li>
                    <li class="list-item"><a href="http://localhost/uni-watch/sign_up/sign_UpForm">Sign up</a></li>
                <?php else: ?>
                    <li class="list-item"><a href="/uni-watch/sign_up/logout">Logout</a></li>
                    <?php if (isset($_SESSION['username'])): ?>
                        <li class="list-item">
                            <i class="fa-solid fa-user"></i>
                            <?= htmlspecialchars($_SESSION['username']); ?>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <li class="list-item"><a id="card" href=""><i class="fa-solid fa-basket-shopping"></i></a></li>
            </ul>
        </div>
    </div>
    
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
                <li class="list-item"><a href="/uni-watch/home/index">Home</a></li>
                <li class="list-item"><a href="/uni-watch/product/allProducts">Watches</a></li>
                <li class="list-item"><a href="/uni-watch/view/about.html.php">About</a></li>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <li class="list-item"><a href="/uni-watch/sign_in/signInForm">Sign in</a></li>
                    <li class="list-item"><a href="/uni-watch/sign_up/sign_UpForm">Sign up</a></li>
                <?php else: ?>
                    <li class="list-item"><a href="/uni-watch/sign_up/logout">Logout</a></li>

                    <?php if (isset($_SESSION['username'])): ?>
                        <li class="list-item admin">
                            <i class="fa-solid fa-user"></i>
                            <?= htmlspecialchars($_SESSION['username']); ?>

                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 1): ?>
                                <span> (admin) <i class="fa-solid fa-angle-down"></i></span>
                            <?php endif; ?>
                        </li>
                    <?php endif; ?>

                <?php endif; ?>
            </ul>
            <li class="list-item basket-icon">
                <a id="card" href="#">
                    <i class="fa-solid fa-basket-shopping"></i>
                </a>

                <div class="cart-detail-box">
                    <div class="title">
                        <p class="my-cart">My Shopping Cart</p>
                        <p class="product-quantity">
                            <?= isset($_SESSION['cart']) && is_array($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                            <span>Product(s)</span>
                        </p>
                    </div>
                    <div class="product-detail-container">
                        <?php if (!empty($_SESSION['cart'])): ?>
                            <?php foreach ($_SESSION['cart'] as $item): ?>
                                <div class="product-box">
                                    <div class="delete-icon-container">
                                        <i class="fa-regular fa-trash-can" data-id="<?= htmlspecialchars($item['id']); ?>"></i>
                                    </div>
                                    <div class="product-details-container">
                                        <p class="product-name"><?= htmlspecialchars($item['title']); ?></p>
                                        <div class="product-price">
                                            <p class="price">$<?= htmlspecialchars($item['price']); ?></p>
                                        </div>
                                    </div>
                                    <div class="product-img-container">
                                        <img src="/uni-watch/public/assets/images/watches/<?= htmlspecialchars($item['image_path']); ?>" alt="<?= htmlspecialchars($item['title']); ?>">
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="total-price-container">
                        <?php if (!empty($_SESSION['cart']) && isset($_SESSION['totalPrice']) && $_SESSION['totalPrice'] > 0 ): ?>
                            <p class="total-price">Total Price: $<?= number_format($_SESSION['totalPrice'], 2); ?></p>
                        <?php else: ?>
                            <p class="total-price">Your Basket Is Empty !</p>
                        <?php endif; ?>
                    </div>

                    <div class="button-container">
                        <button class="go-to-basket">See shopping cart</button>
                    </div>
                </div>

            </li>
        </div>
    </div>
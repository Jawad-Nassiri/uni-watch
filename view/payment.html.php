<div class="payment-container">
    <div class="payment-box">
        <div class="info-container">
            <form action="">
                <div class="fname-lname">
                    <div class="f-name">
                        <label for="f-name">First Name</label>
                        <input type="text" id="f-name" placeholder="Your first name">
                    </div>

                    <div class="l-name">
                        <label for="l-name">Last Name</label>
                        <input type="text" id="l-name" placeholder="Your last name">
                    </div>
                </div>

                <div class="email-container">
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="Your email address">
                </div>

                <div class="city-container">
                    <label for="city">City</label>
                    <input type="text" id="city" placeholder="Your city">
                </div>

                <div class="address-container">
                    <label for="address">Address</label>
                    <input type="email" id="email" placeholder="Your address">
                </div>

                <div class="button-container">
                    <button>Continue To Payment</button>
                </div>
            </form>
        </div>

        <div class="detail-payment-container">
            <div class="payment-title">
                <h2>Detail Product</h2>
            </div>
            <div class="product-payment-detail">
                <?php foreach ($cartProducts as $cartProduct): ?>
                    <div class="product" data-id="<?= $cartProduct['productId'] ?>">
                        <div class="pro-img">
                            <img src="<?= $cartProduct['image']; ?>" alt="<?= htmlspecialchars($cartProduct['name']); ?>">
                        </div>
                        <div class="pro-name">
                            <span style="color: #000;">Category</span> 
                            <p><?= htmlspecialchars($cartProduct['name']); ?></p>
                        </div>
                        <div class="pro-price">
                            <span><?= $cartProduct['quantity']; ?><i class="fa-solid fa-xmark"></i></span>
                            <p>Price: $<?= number_format($cartProduct['price'], 2); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>


            <div class="payment-total">
                <p>Total</p>
                <p class="subtotal">$<?= $payment_subtotal; ?></p>
            </div>
        </div>
    </div>
</div>
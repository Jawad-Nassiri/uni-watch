<div class="cart-container">
    <div class="cart-detail-container">
        <div class="cart-detail">
            <div class="title">
                <h2>
                    CART
                </h2>                
            </div>

            <div class="cart-item-titles">
                <div class="image">
                    <span>Image</span>
                </div>
                <div class="name">
                    <span>Name</span>
                </div>
                <div class="price">
                    <span>Price</span>
                </div>
                <div class="quantity">
                    <span>Quantity</span>
                </div>

                <div class="total">
                    <span>Total</span>
                </div>

                <div class="delete remove">
                    <span>Remove</span>
                </div>
            </div>

            <div class="cart-item-container">
                <?php if (!empty($cartItems)): ?>
                    <?php foreach ($cartItems as $cartItem): ?>
                        <div class="cart-items" data-id="<?= $cartItem['id']; ?>">
                            <div class="image">
                                <div><img src="<?= IMG_ROOT ?>watches/<?= htmlspecialchars($cartItem["image_path"]); ?>" alt="watch"></div>
                            </div>

                            <div class="name">
                                <span><?= htmlspecialchars($cartItem["title"]); ?></span>
                            </div>

                            <div class="cart-price">
                                <span>$<?= number_format($cartItem["price"], 2); ?></span>
                            </div>

                            <div class="cart-plus-minus quantity">
                                <div class="dec ctnbutton">_</div>
                                <input id="detail-quantity" name="quantity" value="<?= (int)$cartItem["quantity"]; ?>" type="text" min="1" readonly>
                                <div class="inc ctnbutton">+</div>
                            </div>

                            <div class="total">
                                <span>$<?= number_format($cartItem["price"] * $cartItem["quantity"], 2); ?></span>
                            </div>

                            <div class="delete">
                                <i class="fa-solid fa-trash"></i>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h5 class="empty-message">Your cart is empty !</h5>
                <?php endif; ?>
            </div>


            <div class="subtotal-container">

                <div class="payment-method">
                    <h5> Accepted Payment Methods </h5>
                    <img alt="Payment Methods" src="<?= IMG_ROOT ?>cart.png">
                </div>

                <div class="subtotal">
                    <div class="total">
                        <h1><?php echo "Subtotal : $" . number_format(!empty($totalPrice) ? $totalPrice : 0, 2) ?></h1>
                    </div>
                    <div class="checkout">
                        <i class="fa-regular fa-credit-card"></i>
                        <span>Checkout</span>
                    </div>
                </div>

            </div>
        </div>

        <div class="help">

            <div class="help-title">
                <h5>need help?</h5>
            </div>

            <div class="titles">
                <div class="delivery">
                    <h3 class="active">free delivery and returns</h3>
                </div>

                <div class="payment">
                    <h3>ordering & payment</h3>
                </div>

                <div class="promotion">
                    <h3>promotions</h3>
                </div>
            </div>

            <div class="content">
                <div id="delivery-content" class="content-box active">
                    <p>
                        We offer free delivery and returns to ensure a smooth shopping experience. Orders are processed within 1-2 business days, and standard shipping takes approximately 3-5 business days. <br><br> Expedited options are available for faster delivery.If you're not satisfied with your purchase, you can return items within 30 days of receipt. Returned products must be unused, in their original packaging, and accompanied by the purchase receipt. <br><br> Once we receive the return, refunds will be processed within 5-7 business days to the original payment method.

                        For any damaged or incorrect items, please contact our support team within 48 hours of delivery to arrange a replacement or refund.

                        Exclusions apply: Final sale items, personalized products, and perishable goods cannot be returned.

                        For further details, visit our Returns & Refunds Policy page or contact our customer support team for assistance.
                    </p>
                </div>
                <div id="payment-content" class="content-box">
                    <p>
                        Placing an order is quick and easy. Simply browse our collection, add your desired items to the cart, and proceed to checkout. <br><br>

                        We accept multiple payment methods, including credit/debit cards, PayPal, and other secure payment options. All transactions are encrypted to ensure your information stays protected. <br><br>

                        Once your payment is processed, you will receive a confirmation email with your order details and tracking information. Orders cannot be modified after checkout, but you may contact support for cancellation requests before shipping. <br><br>

                        If you experience any issues with payment, please ensure your card details are correct or try a different method. For further assistance, reach out to our customer support team.
                    </p>
                </div>
                <div id="promotions-content" class="content-box">
                    <p>
                        We regularly offer exclusive promotions, discounts, and special deals to enhance your shopping experience. <br><br>

                        To stay updated on the latest offers, subscribe to our newsletter or check our Promotions page. Discount codes must be applied at checkout and cannot be combined with other offers unless stated otherwise. <br><br>

                        Some promotions may have restrictions, such as minimum purchase requirements, specific product eligibility, or expiration dates. Please review the terms before applying any discount. <br><br>

                        If you encounter issues with a promo code, ensure it is correctly entered and still valid. For further assistance, contact our customer support team.
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>


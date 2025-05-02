
<div class="detail-container">
    <div class="detail-box">
        <div class="left-box">
            <div class="img-box">
                <img src="<?= IMG_ROOT ?>watches/<?= htmlspecialchars($product['image_path']); ?>" alt="<?= htmlspecialchars($product['title']); ?>">
            </div>
        </div>
        <div class="product-detail-box">
            <div class="product-detail-content">
                <h2 class="product-title"><?= htmlspecialchars($product['title']); ?></h2>

                <h4 class="price product-price"><span class="dollar">$</span><?= htmlspecialchars($product['price']); ?></h4>
            </div>
            <div class="shop-details-desc">
                <p><?= htmlspecialchars($product['description']); ?></p>
            </div>
            <div class="detail-quantity">
                <div class="cart-plus-minus">
                    <div class="dec ctnbutton">-</div>
                    <input id="detail-quantity" name="quantity" value="1" type="text" readonly>
                    <div class="inc ctnbutton">+</div>
                </div>
                <div class="add-to-cart-btn">
                    <p class="add-to-cart">Add to Cart</p>
                </div>
            </div>
            <hr class="style-detail">
            <div class="cart-category">
                <span>Category: <p><?= htmlspecialchars($product['category']); ?></p></span>
            </div>
        </div>
    </div>
</div>





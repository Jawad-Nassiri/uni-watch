
<div class="shop-banner">
    <div class="banner">
        <p>Sale Off 20% All Products</p>
        <h4>New Trending Collection</h4>
        <span>We Believe That Good Design is Always in Season</span>
    </div>
</div>

<!-- Products Section -->
<div class="product-container">
    <div class="product-list">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="product-box">
                    <a href="/uni-watch/detail/productDetail?id=<?= htmlspecialchars($product->getId());?>" class="product-img-box">
                        <img src="/uni-watch/public/assets/images/watches/<?= htmlspecialchars($product->getImagePath()); ?>" alt="<?= htmlspecialchars($product->getTitle()); ?>">
                    </a>
                    <div class="product-details">
                        <p class="product-tag"><?= htmlspecialchars($product->getBrand()); ?></p>
                        <h4 class="product-name"><?= htmlspecialchars($product->getTitle()); ?></h4>
                        <p class="product-price">$<?= htmlspecialchars($product->getPrice()); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-products">No products available at the moment.</p>
        <?php endif; ?>
    </div>
</div>



<button class="read_bt see-more" id="see-more-product" data-offset="9"><p>See More</p></button>


<!-- shop carousel  -->
<div class="shop-carousel-container">
    <div class="shop-carousel-list">
        
        <div class="shop-carousel-item">
            <img src="/uni-watch/public/assets/images/shop-carousel/shop-w1.png" alt="watch">
        </div>

        <div class="shop-carousel-item">
            <img src="/uni-watch/public/assets/images/shop-carousel/shop-w2.png" alt="watch">
        </div>

        <div class="shop-carousel-item">
            <img src="/uni-watch/public/assets/images/shop-carousel/shop-w3.png" alt="watch">
        </div>

        <div class="shop-carousel-item">
            <img src="/uni-watch/public/assets/images/shop-carousel/shop-w4.png" alt="watch">
        </div>

        <div class="shop-carousel-item">
            <img src="/uni-watch/public/assets/images/shop-carousel/shop-w5.png" alt="watch">
        </div>

        <div class="shop-carousel-item">
            <img src="/uni-watch/public/assets/images/shop-carousel/shop-w6.png" alt="watch">
        </div>

    </div>
</div>



<div class="shop-banner">
    <div class="banner">
        <p>Sale Off 20% All Products</p>
        <h4>New Trending Collection</h4>
        <span>We Believe That Good Design is Always in Season</span>
    </div>
</div>


<div class="product-grid">

    <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <div class="product-item">
                <div class="product-image-container">
                    <div class="product-image">
                        <img src="/uni-watch/public/assets/images/watches/<?= htmlspecialchars($product->getImagePath()); ?>" alt="Watch">
                    </div>
                    <div class="quick-view-container">
                        <a href="/uni-watch/detail/productDetail?id=<?= htmlspecialchars($product->getId());?>" class="quick-view">Quick View</a>
                    </div>
                </div>
                <div class="product-info">
                    <h3><?= htmlspecialchars($product->getTitle()); ?></h3>
                    <span class="price"><span><bdi><span>$</span><?= htmlspecialchars($product->getPrice()); ?></bdi></span></span>
                    <?php $starCount = rand(3, 5);?>
                    <div class="stars">
                        <?php for ($i = 0; $i < $starCount; $i++): ?>
                            <i class="fa-solid fa-star"></i>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    <?php else: ?>
        <p class="no-products">No products available at the moment.</p>
    <?php endif; ?>

</div>



<button class="read_bt see-more" id="see-more-product" data-offset="12"><p>See More</p></button>


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



<!-- https://preview.themeforest.net/item/luxrio-ecommerce-jewellery-wordpress-theme/full_screen_preview/56476584  -->
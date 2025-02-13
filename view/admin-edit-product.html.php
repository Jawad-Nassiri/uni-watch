<!-- admin edit product form  -->
<div class="add-product-container">
    <div class="add-product-form">
        <div class="add-product-title">
            <h1>Edit Product</h1>
        </div>
        
        <form class="add-product" method="post" action="/uni-watch/Admin_edit_product/editProduct?id=<?= $product['id'] ?>" enctype="multipart/form-data">
            <input type="text" class="product-title" name="product-title" placeholder="Watch Title"
                value="<?= htmlspecialchars($product['title'] ?? '') ?>">
            
            <p class="error-message product-title-error"><?= isset($errors['title']) ? htmlspecialchars($errors['title']) : ''?></p>
            
            <input type="text" class="product-brand" name="product-brand" placeholder="Watch Brand"
                value="<?= htmlspecialchars($product['brand'] ?? '') ?>">

            <input type="text" class="product-category" name="product-category" placeholder="Watch category"
                value="<?= htmlspecialchars($product['category'] ?? '') ?>">

            <textarea class="product-description" name="product-description" placeholder="Watch Description"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>

            <div class="show-img">
                <input type="file" class="product-image" name="product-image" placeholder="Watch image" value="<?= htmlspecialchars($product['image_path']) ?>">
                <?php if (!empty($product['image_path'])): ?>
                    <img src="/uni-watch/public/assets/images/watches/<?= htmlspecialchars($product['image_path']) ?>" alt="Product Image" width="100">
                <?php endif; ?>
            </div>

            <input type="text" class="product-price" name="product-price" placeholder="Watch Price: 19.99"
                value="<?= htmlspecialchars($product['price'] ?? '') ?>">

            <input type="number" class="product-stock" name="product-stock" placeholder="Watch Stock: 100"
                value="<?= htmlspecialchars($product['stock'] ?? '') ?>">

            <div class="edit-product-submit">
                <input type="submit" value="Update Product">
            </div>
        </form>

    </div>
    <div class="sign-up-bg-container">
        <div class="sign-up-bg">
        </div>
    </div>
</div>

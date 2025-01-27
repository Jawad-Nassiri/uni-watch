<div class="add-product-container">
    <div class="add-product-form">
        <div class="add-product-title">
            <h1>Add Product</h1>
        </div>
        <form class="add-product" method="post" action="/uni-watch/Admin_add_product/addProduct" enctype="multipart/form-data">

            <input type="text" class="product-title" name="product-title" placeholder="Watch Title" value="<?= isset($_POST['product-title']) ? htmlspecialchars($_POST['product-title']) : '' ?>" required>
            <p class="error-message product-title-error"><?= isset($errors['title']) ? htmlspecialchars($errors['title']) : '' ?></p>

            <input type="text" class="product-brand" name="product-brand" placeholder="Watch Brand" value="<?= isset($_POST['product-brand']) ? htmlspecialchars($_POST['product-brand']) : '' ?>" required>
            <p class="error-message product-brand-error"><?= isset($errors['brand']) ? htmlspecialchars($errors['brand']) : '' ?></p>

            <input type="text" class="product-category" name="product-category" placeholder="Watch category" value="<?= isset($_POST['product-category']) ? htmlspecialchars($_POST['product-category']) : '' ?>" required>
            <p class="error-message product-category-error"><?= isset($errors['category']) ? htmlspecialchars($errors['category']) : '' ?></p>

            <textarea class="product-description" name="product-description" placeholder="Watch Description" required><?= isset($_POST['product-description']) ? htmlspecialchars($_POST['product-description']) : '' ?></textarea>
            <p class="error-message product-description-error"><?= isset($errors['description']) ? htmlspecialchars($errors['description']) : '' ?></p>
            
            <input type="file" class="product-image" name="product-image" placeholder="Watch image" required>
            <p class="error-message product-image-error"><?= isset($errors['image']) ? htmlspecialchars($errors['image']) : '' ?></p>
            
            <input type="text" class="product-price" name="product-price" placeholder="Watch Price: 19.99" value="<?= isset($_POST['product-price']) ? htmlspecialchars($_POST['product-price']) : '' ?>" required>
            <p class="error-message product-price-error"><?= isset($errors['price']) ? htmlspecialchars($errors['price']) : '' ?></p>

            <input type="number" class="product-stock" name="product-stock" placeholder="Watch Stock: 100" value="<?= isset($_POST['product-stock']) ? htmlspecialchars($_POST['product-stock']) : '' ?>" required>
            <p class="error-message product-stock-error"><?= isset($errors['stock']) ? htmlspecialchars($errors['stock']) : '' ?></p>

            <div class="add-product-submit">
                <input type="submit" value="Send">
            </div>
        </form>
    </div>
    <div class="sign-up-bg-container">
        <div class="sign-up-bg">
        </div>
    </div>
</div>








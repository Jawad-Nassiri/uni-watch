<div class="add-product-container">
    <div class="add-product-form">
        <div class="add-product-title">
            <h1>Add Product</h1>
        </div>
        <form class="add-product" method="post" action="/uni-watch/Admin_add_product/addProduct">

            <input type="text" class="product-title" name="product-title" placeholder="Watch Title" value="<?= isset($_POST['product-title']) ? $_POST['product-title'] : '' ?>">
            <p class="error-message product-title-error"><?= isset($errors['title']) ? $errors['title'] : '' ?></p>

            <input type="text" class="product-brand" name="product-brand" placeholder="Watch Brand" value="<?= isset($_POST['product-brand']) ? $_POST['product-brand'] : '' ?>">
            <p class="error-message product-brand-error"><?= isset($errors['brand']) ? $errors['brand'] : '' ?></p>

            <textarea class="product-description" name="product-description" placeholder="Watch Description"><?= isset($_POST['product-description']) ? $_POST['product-description'] : '' ?></textarea>
            <p class="error-message product-description-error"><?= isset($errors['description']) ? $errors['description'] : '' ?></p>
            
            <input type="text" class="product-image" name="product-image" placeholder="Watch image name" value="<?= isset($_POST['product-image']) ? $_POST['product-image'] : '' ?>">
            <p class="error-message product-image-error"><?= isset($errors['image']) ? $errors['image'] : '' ?></p>
            
            <input type="text" class="product-price" name="product-price" placeholder="Watch Price: 19.99" value="<?= isset($_POST['product-price']) ? $_POST['product-price'] : '' ?>">
            <p class="error-message product-price-error"><?= isset($errors['price']) ? $errors['price'] : '' ?></p>

            <input type="number" class="product-stock" name="product-stock" placeholder="Watch Stock: 100" value="<?= isset($_POST['product-stock']) ? $_POST['product-stock'] : '' ?>">
            <p class="error-message product-stock-error"><?= isset($errors['stock']) ? $errors['stock'] : '' ?></p>

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












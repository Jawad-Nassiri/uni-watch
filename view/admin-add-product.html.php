<div class="add-product-container">
    <div class="add-product-form">
        <div class="add-product-title">
            <h1>Add Product</h1>
        </div>
        <form class="add-product" method="post" action="/uni-watch/Admin_add_product/addProduct">

            <input type="text" class="product-title" name="product-title" placeholder="Watch Title">
            <p class="error-message product-title-error"><?= isset($errors['title']) ? $errors['title'] : '' ?></p>

            <input type="text" class="product-brand" name="product-brand" placeholder="Watch Brand">
            <p class="error-message product-brand-error"><?= isset($errors['brand']) ? $errors['brand'] : '' ?></p>

            <textarea class="product-description" name="product-description" placeholder="Watch Description"><?= isset($_POST['product-description']) ? $_POST['product-description'] : '' ?></textarea>
            <p class="error-message product-description-error"><?= isset($errors['description']) ? $errors['description'] : '' ?></p>

            <input type="text" class="product-price" name="product-price" placeholder="Watch Price: 19.99">
            <p class="error-message product-price-error"><?= isset($errors['price']) ? $errors['price'] : '' ?></p>

            <input type="text" class="product-photo" name="product-color" placeholder="Watch color">
            <p class="error-message product-photo-error"></p>
            
            <input type="text" class="product-photo" name="product-photo" placeholder="Watch Photo url">
            <p class="error-message product-photo-error"></p>

            <input type="number" class="product-stock" name="product-stock" placeholder="Watch Stock: 100">
            <p class="error-message product-stock-error"></p>

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
















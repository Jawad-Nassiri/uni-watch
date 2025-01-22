<?php require '../public/header.html.php'?>
<div class="add-product-container">
    <div class="add-product-form">
        <div class="add-product-title">
            <h1>Add Product</h1>
        </div>
        <form class="add-product" method="post" action="/uni-watch/admin_add_product/add_product">

            <input type="text" class="product-title" name="product-title" placeholder="Product Title">
            <p class="error-message product-title-error"></p>

            <input type="text" class="product-brand" name="product-brand" placeholder="Product Brand">
            <p class="error-message product-brand-error"></p>

            <textarea class="product-description" name="product-description" placeholder="Product Description"></textarea>
            <p class="error-message product-description-error"></p>

            <input type="text" class="product-photo" name="product-photo" placeholder="Product Photo Name">
            <p class="error-message product-photo-error"></p>

            <input type="text" class="product-photo" name="product-photo" placeholder="Product Photo Name">
            <p class="error-message product-photo-error"></p>

            <input type="number" class="product-price" name="product-price" placeholder="Product Price">
            <p class="error-message product-price-error"></p>

            <input type="number" class="product-stock" name="product-stock" placeholder="Product Stock">
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

<?php require '../public/footer.html.php'?>

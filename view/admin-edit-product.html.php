<!-- admin edit product form  -->
<?php include '../public/header.html.php' ?>
<div class="add-product-container">
    <div class="add-product-form">
        <div class="add-product-title">
            <h1>Add Product</h1>
        </div>
        <form class="add-product" method="post" action="/uni-watch/Admin_add_product/addProduct" enctype="multipart/form-data">

            <input type="text" class="product-title" name="product-title" placeholder="Watch Title">

            <input type="text" class="product-brand" name="product-brand" placeholder="Watch Brand">

            <input type="text" class="product-category" name="product-category" placeholder="Watch category">

            <textarea class="product-description" name="product-description" placeholder="Watch Description"></textarea>

            <input type="file" class="product-image" name="product-image" placeholder="Watch image" required>

            <input type="text" class="product-price" name="product-price" placeholder="Watch Price: 19.99">

            <input type="number" class="product-stock" name="product-stock" placeholder="Watch Stock: 100">

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

<?php include '../public/footer.html.php' ?>

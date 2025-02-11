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


<!-- admin product list  -->
<div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>iPhone 13</td>
                    <td>Apple</td>
                    <td>Smartphones</td>
                    <td>Latest iPhone model with...</td>
                    <td>$999</td>
                    <td>50</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-edit">Edit</button>
                            <button class="btn btn-delete">Delete</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Galaxy S22</td>
                    <td>Samsung</td>
                    <td>Smartphones</td>
                    <td>Premium Android smartphone...</td>
                    <td>$899</td>
                    <td>35</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-edit">Edit</button>
                            <button class="btn btn-delete">Delete</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>MacBook Pro</td>
                    <td>Apple</td>
                    <td>Laptops</td>
                    <td>16-inch laptop with...</td>
                    <td>$1999</td>
                    <td>25</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-edit">Edit</button>
                            <button class="btn btn-delete">Delete</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Surface Laptop</td>
                    <td>Microsoft</td>
                    <td>Laptops</td>
                    <td>Sleek and powerful Windows...</td>
                    <td>$1299</td>
                    <td>40</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-edit">Edit</button>
                            <button class="btn btn-delete">Delete</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>iPad Pro</td>
                    <td>Apple</td>
                    <td>Tablets</td>
                    <td>12.9-inch tablet with...</td>
                    <td>$1099</td>
                    <td>30</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-edit">Edit</button>
                            <button class="btn btn-delete">Delete</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Dell XPS 15</td>
                    <td>Dell</td>
                    <td>Laptops</td>
                    <td>Premium Windows laptop...</td>
                    <td>$1799</td>
                    <td>20</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-edit">Edit</button>
                            <button class="btn btn-delete">Delete</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>AirPods Pro</td>
                    <td>Apple</td>
                    <td>Audio</td>
                    <td>Wireless earbuds with...</td>
                    <td>$249</td>
                    <td>100</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-edit">Edit</button>
                            <button class="btn btn-delete">Delete</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Galaxy Tab S8</td>
                    <td>Samsung</td>
                    <td>Tablets</td>
                    <td>Premium Android tablet...</td>
                    <td>$699</td>
                    <td>45</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-edit">Edit</button>
                            <button class="btn btn-delete">Delete</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>ThinkPad X1</td>
                    <td>Lenovo</td>
                    <td>Laptops</td>
                    <td>Business laptop with...</td>
                    <td>$1499</td>
                    <td>15</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-edit">Edit</button>
                            <button class="btn btn-delete">Delete</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Pixel 6 Pro</td>
                    <td>Google</td>
                    <td>Smartphones</td>
                    <td>Android phone with...</td>
                    <td>$899</td>
                    <td>55</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-edit">Edit</button>
                            <button class="btn btn-delete">Delete</button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>10</td>
                    <td>Pixel 6 Pro</td>
                    <td>Google</td>
                    <td>Smartphones</td>
                    <td>Android phone with...</td>
                    <td>$899</td>
                    <td>55</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-edit">Edit</button>
                            <button class="btn btn-delete">Delete</button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>10</td>
                    <td>Pixel 6 Pro</td>
                    <td>Google</td>
                    <td>Smartphones</td>
                    <td>Android phone with...</td>
                    <td>$899</td>
                    <td>55</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-edit">Edit</button>
                            <button class="btn btn-delete">Delete</button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>10</td>
                    <td>Pixel 6 Pro</td>
                    <td>Google</td>
                    <td>Smartphones</td>
                    <td>Android phone with...</td>
                    <td>$899</td>
                    <td>55</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-edit">Edit</button>
                            <button class="btn btn-delete">Delete</button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>10</td>
                    <td>Pixel 6 Pro</td>
                    <td>Google</td>
                    <td>Smartphones</td>
                    <td>Android phone with...</td>
                    <td>$899</td>
                    <td>55</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-edit">Edit</button>
                            <button class="btn btn-delete">Delete</button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>10</td>
                    <td>Pixel 6 Pro</td>
                    <td>Google</td>
                    <td>Smartphones</td>
                    <td>Android phone with...</td>
                    <td>$899</td>
                    <td>55</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-edit">Edit</button>
                            <button class="btn btn-delete">Delete</button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>10</td>
                    <td>Pixel 6 Pro</td>
                    <td>Google</td>
                    <td>Smartphones</td>
                    <td>Android phone with...</td>
                    <td>$899</td>
                    <td>55</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-edit">Edit</button>
                            <button class="btn btn-delete">Delete</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
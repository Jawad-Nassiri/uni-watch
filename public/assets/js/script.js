document.addEventListener('DOMContentLoaded', () => {

    //open and close the navbar in the tablet and mobile device
    document.querySelector('div#open').onclick = () => {document.querySelector('ul#nav').classList = 'active'}
    document.querySelector('li#close').onclick = () => {document.querySelector('ul#nav').className = ''}
    
    // highlight the active link based on the current URL
    const navLinks = document.querySelectorAll('#nav li a')
    navLinks.forEach((navItem) => {
        if(navItem.href === location.href) {
            navItem.style.cssText = 'background:#b60213; color:white;'
        }
    })



    // filter the body after clicking on the basket icon 
    const basketIcon = document.querySelector('#card');
    const cartDetailBox = document.querySelector('.cart-detail-box');
    let isHidden = true


    const toggleCartDetail = (evt) => {
        evt.preventDefault();
        cartDetailBox.style.display = isHidden ? 'block' : 'none';
        isHidden = !isHidden;
        document.body.classList.toggle('blur-effect')
    }

    basketIcon.addEventListener('click', toggleCartDetail);

    document.addEventListener('click', (evt) => {
        if (!cartDetailBox.contains(evt.target) && !basketIcon.contains(evt.target)) {
            cartDetailBox.style.display = 'none';
            document.body.classList.remove('blur-effect');
            isHidden = true;
        }
    });


    // redirection to the cart page 
    document.querySelector('.button-container').onclick = () => {location.href = 'http://localhost/uni-watch/cart/cartDetail'};



    // home page 
    if(location.pathname == '/uni-watch/home/index') {
        //home page carousel 
        const carousel = document.querySelector('.carousel');
        const prevBtn = document.querySelector('.prev');
        const nextBtn = document.querySelector('.next');
        const items = document.querySelectorAll('.carousel-item');

        let itemWidth = document.querySelector('.carousel-item').offsetWidth + 20;
        let totalItems = items.length;
        let visibleItems = Math.round(carousel.offsetWidth / itemWidth);
        let maxIndex = totalItems - visibleItems;
        let currentIndex = 0;

        window.addEventListener('resize', function(){
            itemWidth = document.querySelector('.carousel-item').offsetWidth + 20; 
            visibleItems = Math.round(carousel.offsetWidth / itemWidth); 
            maxIndex = totalItems - visibleItems; 
        });
        

        nextBtn.addEventListener('click', () => {
            currentIndex++;

            if (currentIndex > maxIndex) {
                currentIndex = 0; 
                carousel.scrollLeft = 0;
            } else {
                carousel.scrollLeft = itemWidth * currentIndex;
            }
        });

        prevBtn.addEventListener('click', () => {
            currentIndex--;

            if (currentIndex < 0) {
                currentIndex = maxIndex;
                carousel.scrollLeft = itemWidth * maxIndex;
            } else {
                carousel.scrollLeft = itemWidth * currentIndex;
            }
        });

        carousel.addEventListener('scroll', () => {
            currentIndex = Math.round(carousel.scrollLeft / itemWidth);
        });

        // redirection to the admin page method 
        const adminTagElement = document.querySelector('.list-item.admin')

        if(adminTagElement) {
            redirectionToAdminDashboard('.list-item.admin', '.fa-solid.fa-angle-down', '.admin-dashboard')
        }


    }



    // shop page 
    if (location.pathname == '/uni-watch/product/allProducts') {

        // shop carousel
        const shopCarouselContainer = document.querySelector('.shop-carousel-list')
        const shopCarouselItems = document.querySelectorAll('.shop-carousel-item')
        let shopCarouselItemWidth = document.querySelector('.shop-carousel-item').offsetWidth + 1
        
        const itemsClone = Array.from(shopCarouselItems).map(item => item.cloneNode(true))
        itemsClone.forEach(item => shopCarouselContainer.append(item))

        window.addEventListener('resize', function(){
            shopCarouselItemWidth = document.querySelector('.shop-carousel-item').offsetWidth + 1
        });

        setInterval(() => {
            shopCarouselContainer.scrollBy({
                left: shopCarouselItemWidth,
                behavior: 'smooth'
            })

            if(shopCarouselContainer.scrollLeft >= shopCarouselContainer.scrollWidth / 2){
                shopCarouselContainer.scrollLeft = 0
            }

        }, 3000)


        // fetch product 3 by 3 by clicking on the see more button 
        document.getElementById('see-more-product').addEventListener('click', function () {
            const button = this;
            const offset = parseInt(button.getAttribute('data-offset'));
            const limit = 3;
        
            fetch(`/uni-watch/product/loadMoreProducts?offset=${offset}&limit=${limit}`)
                .then(response => response.json())
                .then(data => {
                    if (data.products && data.products.length > 0) {
                        const productList = document.querySelector('.product-list');
                        
                        data.products.forEach(product => {
                            const productBox = document.createElement('div');
                            productBox.classList.add('product-box');
                        
                            const productImgBox = document.createElement('a');
                            productImgBox.classList.add('product-img-box');
                            productImgBox.setAttribute('href', `/uni-watch/detail/productDetail?id=${product.id}`);
                        
                            const productImage = document.createElement('img');
                            productImage.src = `/uni-watch/public/assets/images/watches/${product.image_path}`;
                            productImage.alt = product.title;
                        
                            productImgBox.appendChild(productImage);
                        
                            const productDetails = document.createElement('div');
                            productDetails.classList.add('product-details');
                            productDetails.innerHTML = `
                                <p class="product-tag">${product.category}</p>
                                <h4 class="product-name">${product.title}</h4>
                                <p class="product-price">$${product.price}</p>
                            `;
                        
                            productBox.appendChild(productImgBox);
                            productBox.appendChild(productDetails);
                        
                            productList.appendChild(productBox);
                        });
                        
        
                        button.setAttribute('data-offset', offset + limit);
        
                        if (data.products.length < limit) {
                            button.style.display = 'none';
                        }

                    } else {
                        button.style.display = 'none';
                    }
                })
                .catch(error => console.error('Error loading more products:', error));
        });


        
        // redirection to the admin page method 
        const adminTagElement = document.querySelector('.list-item.admin');

        if(adminTagElement) {
            redirectionToAdminDashboard('.list-item.admin', '.fa-solid.fa-angle-down', '.admin-dashboard');
        }


    }


    // cart page 
    if(location.pathname.includes('/cart')) {

        // remove the event listener from the cart detail box 
        document.querySelector('#card').removeEventListener('click', toggleCartDetail);

        // show the help content 
            const titles = document.querySelectorAll(".help .titles > div");
            const contents = document.querySelectorAll(".help .content .content-box");
        
            titles.forEach((title, index) => {
                title.addEventListener("click", function () {
                    contents.forEach(content => content.classList.remove("active"));
                    contents[index].classList.add("active");
        
                    titles.forEach(title => title.classList.remove('active'));
                    titles[index].classList.add('active');
                });
            })    
            
            
        // handles increment, decrement, and manual input for quantity with min/max limits.
        const increaseBtns = document.querySelectorAll('.inc.ctnbutton');
        const decreaseBtns = document.querySelectorAll('.dec.ctnbutton');
        const inputQuantityElements = document.querySelectorAll('#detail-quantity');

        increaseBtns.forEach((increaseBtn, index) => {
            const decreaseBtn = decreaseBtns[index];
            const inputQuantity = inputQuantityElements[index];

            if(increaseBtn && decreaseBtn && inputQuantity) {
                handleQuantityChange(increaseBtn, decreaseBtn, inputQuantity);
            }
        });


        // disable the increase btn when the quantity is 100 
        inputQuantityElements.forEach((inputQuantityElement, index) => {
            if(Number(inputQuantityElement.value) === 100) {
                increaseBtns[index].classList.add('disabled')
            }
        });



        // calculate the product price in the cart page
        const productPriceElements = document.querySelectorAll('.cart-price > span');
        const productInputElements = document.querySelectorAll('#detail-quantity');
        const productTotalPriceElements = document.querySelectorAll('.cart-items .total > span');
        let subtotal = document.querySelector('.subtotal .total h1')


        function updateSubtotal() {
            let total = 0;
        
            const productTotalPriceElements = document.querySelectorAll('.cart-items .total > span');

            productTotalPriceElements.forEach((productTotalPriceElement) => {
                const productTotalPrice = parseFloat(productTotalPriceElement.textContent.replace('$', '').replace(',', ''));
                total += productTotalPrice;
            });
        
            subtotal.textContent = `Subtotal : $${total.toFixed(2)}`;
        }
        

        // increase btn calculation 
        increaseBtns.forEach((increaseBtn, index) => {
            const productInputElement = productInputElements[index];
            const productPrice = parseFloat(productPriceElements[index].textContent.replace('$', ''));

            // disable increase bnt when the quantity is 100
            increaseBtn.addEventListener('click', () => {

                let inputValue = Number(productInputElement.value);
                // the input value increase is done in the handleQuantityChange function
                // inputValue++;
                productInputElement.value = inputValue;

                const productTotalPrice = productPrice * inputValue;
                productTotalPriceElements[index].textContent = `$${productTotalPrice.toFixed(2)}`;


                updateSubtotal()
            });
        });



        // decrease btn calculation 
        decreaseBtns.forEach((decreaseBtn, index) => {
            const productInputElement = productInputElements[index];
            const productPrice = parseFloat(productPriceElements[index].textContent.replace('$', ''));
            
            decreaseBtn.addEventListener('click', () => {
                    let inputValue = Number(productInputElement.value);
                    // the input value decrease is done in the handleQuantityChange function
                    // inputValue--;
                    productInputElement.value = inputValue;
        
                    const productTotalPrice = productPrice * inputValue;
                    productTotalPriceElements[index].textContent = `$${productTotalPrice.toFixed(2)}`;

                    updateSubtotal()

                    // enable the increase btn when the quantity is 100 
                    increaseBtns[index].classList.remove('disabled')

            });
        });



        // change the icon basket background when the user is on the cart page 
        document.querySelector('.list-item.basket-icon > a i').style.cssText = ' background: #b60213; color: #fff';


        // delete product after clicking on the delete icon 
        document.querySelector('.cart-item-container').addEventListener('click', (evt) => {
            if (evt.target.classList.contains('fa-trash')) {
                const cartItemContainer = evt.target.closest('.cart-items');
                const productId = cartItemContainer.getAttribute('data-id');
        
                fetch(`/uni-watch/basket/deleteProduct?productId=${productId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            // remove the product from the cart 
                            cartItemContainer.remove();

                            // if there are no products in the cart, show the message
                            if(data.cartCount === 0) {
                                const messageElement = document.createElement('h5')
                                messageElement.className = 'empty-message'
                                messageElement.textContent = 'Your basket is empty !';
                                document.querySelector('.cart-item-container').appendChild(messageElement);
                            }

                            // update the total price 
                            document.querySelector('.subtotal .total h1').textContent = `Subtotal : $${data.totalPrice.toFixed(2)}`;

                            successBoxGenerator('Item deleted successfully !');
                        }
                    })
                    .catch(error => console.error('Error deleting product:', error));
            }
        });


        // get the product information and send them to the server
        const checkoutBtn = document.querySelector('.subtotal .checkout');
        
        checkoutBtn.onclick = () => {

            const proImgElements = document.querySelectorAll('.cart-items .image img');
            const proNameElements = document.querySelectorAll('.cart-items .name span');
            const proPriceElements = document.querySelectorAll('.cart-items .cart-price span');
            const proQuantityElements = document.querySelectorAll('.cart-items .quantity #detail-quantity');
            const proTotalPriceElements = document.querySelectorAll('.cart-items .total span');
            const proSubtotalElement = document.querySelector('.subtotal .total h1');
    
            const cartProducts = [];
    
            proImgElements.forEach((img, index) => {
                cartProducts.push({
                    image: img.src,
                    name: proNameElements[index].textContent.trim(),
                    price: parseFloat(proPriceElements[index].textContent.replace('$', '')).toFixed(2),
                    quantity: parseInt(proQuantityElements[index].value),
                    total: parseFloat(proTotalPriceElements[index].textContent.replace('$', '')).toFixed(2)
                });
            });
    
            const data = {
                cartProducts: cartProducts,
                payment_subtotal: parseFloat(proSubtotalElement.textContent.replace('Subtotal : $', '').replace(',', '')).toFixed(2)
            };

            fetch('/uni-watch/payment/paymentDetail', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    location.href = "/uni-watch/payment/paymentPage";
                } else {
                    // function unsuccess message
                    unsuccessBoxGenerator('Please log in to proceed');
                    
                    setTimeout(() => {
                        location.href = "/uni-watch/sign_up/sign_UpForm";
                    }, 3000)
                }
            })
        }

    }


    // sign up page 
    if (location.pathname.includes('sign_up')) {

        const usernameInput = document.querySelector('.sign-up > input[name="username"]');
        const emailInput = document.querySelector('.sign-up > input[name="email"]');
        const passwordInput = document.querySelector('.sign-up-password-input');
        const usernameErrorMessage = document.querySelector('.error-message.username-error');
        const emailErrorMessage = document.querySelector('.error-message.email-error');
        const passwordErrorMessage = document.querySelector('.error-message.password-error');

    
        // username validation
        usernameInput.addEventListener('keyup', () => {
            usernameValidation(usernameInput, usernameErrorMessage);
        });

        // email validation
        emailInput.addEventListener('keyup', () => {
            emilValidation(emailInput, emailErrorMessage)
        });

        // password validation
        passwordInput.addEventListener('keyup', () => {
            passwordValidation(passwordInput, passwordErrorMessage)
        });

        // function to add show/hide password functionality
        togglePasswordVisibility('.sign-up-password > input[name="password"]', '#eye')
            
    }

    // detail page 
    if (location.pathname.includes('detail'))  {

        // Handles increment, decrement, and manual input for quantity with min/max limits.
        const increaseBtn = document.querySelector('.inc.ctnbutton');
        const decreaseBtn = document.querySelector('.dec.ctnbutton');
        const detailInputQuantity = document.querySelector('#detail-quantity');

        if(increaseBtn && decreaseBtn &&  detailInputQuantity) {
            handleQuantityChange(increaseBtn, decreaseBtn, detailInputQuantity)
        }




        // retrieve the product detail and show them in the box product detail 
        const params = new URLSearchParams(window.location.search);
        const productId = params.get("id");
        const addToCartBtn = document.querySelector('.add-to-cart-btn');
        const productQuantity = document.querySelector('.title .product-quantity');
        const quantityInput = document.querySelector('#detail-quantity');
        const cartContainer = document.querySelector('.product-detail-container');
        const totalPriceElement = document.querySelector('.total-price-container .total-price')



        addToCartBtn.onclick = () => {
            const quantity = quantityInput.value;
        
            fetch(`/uni-watch/basket/productDetail?productId=${productId}&quantity=${quantity}`)
                .then(response => response.json())
                .then(data => {
        
                    if (data.status === 'success') {

                        // function success message 
                        successBoxGenerator('Item successfully added to your cart !');
        
                        productQuantity.innerHTML = `${data.cartCount} <span>Product(s)</span>`;
        
                        const productBox = document.createElement('div');
                        productBox.classList.add('product-box');
                        productBox.innerHTML = `
                            <div class="delete-icon-container">
                                <i class="fa-regular fa-trash-can" data-id= "${data.product.id}"></i>
                            </div>
                            <div class="product-details-container">
                                <p class="product-name">${data.product.title}</p>
                                <div class="product-price">
                                    <p class="price">$${data.product.price}</p>
                                    <p class="product-quantity"><i class="fa-solid fa-xmark"></i>${data.product.quantity}</p>
                                </div>
                            </div>
                            <div class="product-img-container">
                                <img src="/uni-watch/public/assets/images/watches/${data.product.image_path}" alt="${data.product.title}">
                            </div>
                        `;
                        cartContainer.append(productBox);

                        if (data.cartCount > 0 && data.totalPrice > 0) {
                            totalPriceElement.textContent = `Total Price: $${data.totalPrice.toFixed(2)}`;
                        } else {
                            totalPriceElement.textContent = "Your Basket Is Empty!";
                        }
                        
        
                    } else {
                        // function unsuccess message
                        successBoxGenerator('Item is already in your cart !')
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                });
        
        };
        

        // redirection to the admin page method 
        const adminTagElement = document.querySelector('.list-item.admin')

        if(adminTagElement) {
            redirectionToAdminDashboard('.list-item.admin', '.fa-solid.fa-angle-down', '.admin-dashboard')
        }

    }


    // delete a product from the cart box 
    document.querySelector('.product-detail-container').onclick = (evt) => {
        if(evt.target.classList.contains('fa-trash-can')) {

            const item = evt.target
            const productId = item.getAttribute('data-id')

            fetch(`/uni-watch/basket/deleteProduct?productId=${productId}`)
            .then(response => response.json())
            .then(data => {
                if(data.status ==='success') {
                    // success box generator function
                    successBoxGenerator('Item deleted successfully !');

                    item.closest('.product-box').remove()

                    updateTotalPrice(data.totalPrice, data.cartCount);
                }
            })
            .catch(error => console.error('Error deleting product:', error));

        }
    }

    // Function to update total price dynamically
    function updateTotalPrice(newTotal, cartCount) {
        const totalPriceElement = document.querySelector('.total-price');
        const productQuantity = document.querySelector('.product-quantity');

        if (cartCount > 0) {
            totalPriceElement.textContent = `Total Price: $${newTotal.toFixed(2)}`;
        } else {
            totalPriceElement.textContent = "Your Basket Is Empty!";
        }

        productQuantity.innerHTML = `${cartCount} <span>Product(s)</span>`;
    }


    
    



    if (location.pathname.includes('sign_in')) {
    
        const signInUsernameInputElement = document.querySelector('.sign-in-username')
        const signInPasswordInputElement = document.querySelector('.sign-in-password-input')

        const signInUsernameErrMessage = document.querySelector('.sign-in-username-error')
        const signInPasswordErrMessage = document.querySelector('.sign-in-password-error')

        // username validation
        signInUsernameInputElement.onkeyup = () => {
            usernameValidation(signInUsernameInputElement, signInUsernameErrMessage)
        }

        // password validation
        signInPasswordInputElement.onkeyup = () => {
            passwordValidation(signInPasswordInputElement, signInPasswordErrMessage)
        }

        // function to add show/hide password functionality
        togglePasswordVisibility('.sign-in-password > input[name="password"]', '#eye')
    }


    // function to add show/hide password functionality
    function togglePasswordVisibility(passwordSelector, eyeSelector) {
        const passwordInput = document.querySelector(passwordSelector);
        const eye = document.querySelector(eyeSelector);
        let isShowing = false;
    
        if (eye && passwordInput) {
            eye.onclick = () => {

                if (passwordInput.value === '') {
                    // If the input is empty, nothing ll happens
                    return;
                } 

                if (!isShowing) {
                    eye.classList.remove('fa-eye-slash');
                    eye.classList.add('fa-eye');
                    passwordInput.type = 'text';
                    isShowing = true;
                } else {
                    eye.classList.remove('fa-eye');
                    eye.classList.add('fa-eye-slash');
                    passwordInput.type = 'password';
                    isShowing = false;
                }
            };
        } else {
            console.error('Password input or eye icon not found.');
        }
    }

    // username validation function 
    function usernameValidation(inputElement, errMessageElement) {
        const value = inputElement.value;
        if (value.length < 3) {
            inputElement.style.border = '3px solid #b60213';
            errMessageElement.textContent = 'Username must be at least 3 characters';
            errMessageElement.style.color = '#b60213';
        } else {
            inputElement.style.border = '3px solid green';
            errMessageElement.textContent = 'Username is valid';
            errMessageElement.style.color = 'green';
        }
    }

    // email validation function 
    function emilValidation(inputElement, errMessageElement) {
        const value = inputElement.value;
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test(value)) {
            inputElement.style.border = '3px solid #b60213';
            errMessageElement.textContent = 'Please enter a valid email';
            errMessageElement.style.color = '#b60213';
        } else {
            inputElement.style.border = '3px solid green';
            errMessageElement.textContent = 'Email is valid';
            errMessageElement.style.color = 'green';
        }
    }

    // password validation function
    function passwordValidation(inputElement, errMessageElement) {
        const value = inputElement.value;
        if (value.length < 6) {
            inputElement.style.border = '3px solid #b60213';
            errMessageElement.textContent = 'Password must be at least 6 characters';
            errMessageElement.style.color = '#b60213';
        } else {
            inputElement.style.border = '3px solid green';
            errMessageElement.textContent = 'Password is valid';
            errMessageElement.style.color = 'green';
        }
    }   



    function redirectionToAdminDashboard(adminTagSelector, angleSelector, adminDashboardSelector) {
        let adminTagElement = document.querySelector(adminTagSelector);
        let angleElement = document.querySelector(angleSelector);
        let adminDashboardLink = document.querySelector(adminDashboardSelector);
        let angleUp = false;
    
        if (!adminDashboardLink) {
            adminDashboardLink = document.createElement('a');
            adminDashboardLink.classList.add('admin-dashboard');
            adminDashboardLink.href = '/uni-watch/Admin_add_product/addProduct';
            adminDashboardLink.textContent = 'Admin Dashboard';
            adminDashboardLink.style.display = 'none';
            adminTagElement.appendChild(adminDashboardLink);  
        }
    
            angleElement.onclick = () => {
                angleUp = !angleUp;
                angleElement.className = angleUp ? 'fa-solid fa-angle-up' : 'fa-solid fa-angle-down';
                adminDashboardLink.style.display = angleUp ? 'block' : 'none';
            };
        
    }



    // handles increment, decrement, and manual input for quantity with min/max limits.
    function handleQuantityChange(increaseBtnElement, decreaseBtnElement, inputQuantityElement) {

        let currentValue = parseInt(inputQuantityElement.value);

        if(currentValue === 1) {
            decreaseBtnElement.classList.add('disabled'); 
        }


        increaseBtnElement.onclick = () => {
            currentValue = parseInt(inputQuantityElement.value);
            inputQuantityElement.value = currentValue + 1;
    
            if (currentValue + 1 >= 100) {
                increaseBtnElement.classList.add('disabled');
            } else {
                increaseBtnElement.classList.remove('disabled');
            }
    
            decreaseBtnElement.classList.remove('disabled');
        };

    
        decreaseBtnElement.onclick = () => {
            currentValue = parseInt(inputQuantityElement.value);
            if (currentValue > 0) {
                inputQuantityElement.value = currentValue - 1;
            }
    
            if (currentValue - 1 <= 1) {
                decreaseBtnElement.classList.add('disabled');
            } else {
                decreaseBtnElement.classList.remove('disabled');
            }
    
            increaseBtnElement.classList.remove('disabled');
        };

        inputQuantityElement.onkeyup = () => {
            const quantity = Number(inputQuantityElement.value);
        
            if (quantity >= 100) {
                increaseBtnElement.classList.add('disabled');
            } else {
                increaseBtnElement.classList.remove('disabled');
            }
        
            if (quantity <= 1) {
                decreaseBtnElement.classList.add('disabled');
            } else {
                decreaseBtnElement.classList.remove('disabled');
            }
        };
    }


    // success box generator function
    function successBoxGenerator(message) {
        const successAlertBox = document.createElement('div');
        successAlertBox.className = 'success';
        successAlertBox.innerHTML = `
            <div class="success-status"><i class="fa-regular fa-circle-check"></i></div>
            <div class="massage-content">
                <span>Success</span>
                <p>${message}</p>
            </div>
        `;
        document.body.appendChild(successAlertBox);

        setTimeout(() => {
            successAlertBox.remove();
        }, 3000);
    }


    // unsuccess box generator function
    function unsuccessBoxGenerator(message) {
        const unsuccessAlertBox = document.createElement('div');
        unsuccessAlertBox.className = 'unsuccess';
        unsuccessAlertBox.innerHTML = `
            <div class="unsuccess-status"><i class="fa-regular fa-circle-xmark"></i></div>
            <div class="massage-content">
                <span>Error</span>
                <p>${message}</p>
            </div>
        `;
        document.body.appendChild(unsuccessAlertBox);

        setTimeout(() => {
            unsuccessAlertBox.remove();
        }, 3000);
    }

});




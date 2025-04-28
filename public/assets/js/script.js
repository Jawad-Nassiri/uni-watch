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

    // redirection to the admin pages and adding the angle icon functionality
    document.onclick = (evt) => {
        const adminLinks = document.getElementById('admin-links');
        const angleIcon = document.getElementById('angle-icon');
    
        if (evt.target.id === "angle-icon") {
            const isOpen = adminLinks.style.display === "block";
            adminLinks.style.display = isOpen ? "none" : "block";
            angleIcon.classList.toggle('fa-angle-down');
            angleIcon.classList.toggle('fa-angle-up');
        }
    
        if (adminLinks && !adminLinks.contains(evt.target) && evt.target.id !== "angle-icon") {
            adminLinks.style.display = "none";
            if (angleIcon) {
                angleIcon.classList.add('fa-angle-down');
                angleIcon.classList.remove('fa-angle-up');
            }
        }
    }
    

    // redirection to the cart page 
    document.querySelector('.button-container').onclick = () => {location.href = 'http://localhost/uni-watch/cart/cartDetail'};



    // home page 
    if(location.pathname == '/uni-watch/home/index') {
        //home carousel 
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
            });

            if(shopCarouselContainer.scrollLeft >= shopCarouselContainer.scrollWidth / 2){
                shopCarouselContainer.scrollLeft = 0
            }

        }, 3000)


        // fetch product 4 by 4 by clicking on the see more button 
        document.getElementById('see-more-product').addEventListener('click', function () {
            const button = this;
            const offset = parseInt(button.getAttribute('data-offset'));
            const limit = 4;
                (async () => {
                    try{
                        let response = await fetch(`/uni-watch/product/loadMoreProducts?offset=${offset}&limit=${limit}`);
                        let obj = await response.json();

                        if (obj.products && obj.products.length > 0) {
                            const productList = document.querySelector('.product-grid');
                            
                            obj.products.forEach(product => {

                                const starsCount = Math.floor(Math.random() * 3) + 3;
                                let starsHTML = '';
                                for (let i = 0; i < starsCount; i++) {
                                    starsHTML += `<i class="fa-solid fa-star"></i>`;
                                }

                                console.log(product)
                                productList.insertAdjacentHTML('beforeend', 
                                    `
                                        <div class="product-item">
                                            <div class="product-image-container">
                                                <div class="product-image">
                                                    <img src="/uni-watch/public/assets/images/watches/${product.image_path}" alt="Watch">
                                                </div>
                                                <div class="quick-view-container">
                                                    <a href="/uni-watch/detail/productDetail?id=${product.id}" class="quick-view">Quick View</a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h3>${product.title}</h3>
                                                <span class="price"><span><bdi><span>$</span>${product.price}</bdi></span></span>
                                                <div class="stars">
                                                    ${starsHTML}
                                                </div>
                                            </div>
                                        </div>

                                    `
                                )
                            });
                            
            
                            button.setAttribute('data-offset', offset + limit);
            
                            if (obj.products.length < limit) {
                                button.style.display = 'none';
                            }
    
                        } else {
                            button.style.display = 'none';
                        }
                    } catch (error){
                        button.style.display = 'none';
                    }
                })();
        });



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

                const productTotalPrice = productPrice * inputValue;
                productTotalPriceElements[index].textContent = `$${productTotalPrice.toFixed(2)}`;


                updateSubtotal();
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
            
                (async () => {
                    try {
                        let response = await fetch(`/uni-watch/basket/deleteProduct?productId=${productId}`);
                        let obj = await response.json();
            
                        if (obj.status === 'success') {
                            cartItemContainer.remove();
                            if (obj.cartCount === 0) {
                                document.querySelector('.cart-item-container').innerHTML = '<h5 class="empty-message">Your basket is empty!</h5>';
                            }
                            document.querySelector('.subtotal .total h1').textContent = `Subtotal : $${obj.totalPrice.toFixed(2)}`;
                            successBoxGenerator('Item deleted successfully!');
                        }
                    } catch (error) {
                        unsuccessBoxGenerator('Error deleting product');
                    }
                })();
            }
            
        });


        // get the product information and send them to the server
        const checkoutBtn = document.querySelector('.subtotal .checkout');
        
        checkoutBtn.onclick = () => {

            const productContainerElements = document.querySelectorAll('.cart-item-container .cart-items')
            const proImgElements = document.querySelectorAll('.cart-items .image img');
            const proNameElements = document.querySelectorAll('.cart-items .name span');
            const proPriceElements = document.querySelectorAll('.cart-items .cart-price span');
            const proQuantityElements = document.querySelectorAll('.cart-items .quantity #detail-quantity');
            const proTotalPriceElements = document.querySelectorAll('.cart-items .total span');
            const proSubtotalElement = document.querySelector('.subtotal .total h1');
    
            const cartProducts = [];
    
            proImgElements.forEach((img, index) => {
                cartProducts.push({
                    productId: productContainerElements[index].getAttribute('data-id'),
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

            (async () => {
                try {
                    let response = await fetch('/uni-watch/payment/paymentDetail', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    }) ;

                    let obj = await response.json()

                        if (obj.status === "success") {
                            location.href = "/uni-watch/payment/paymentPage";
                            
                        } else if (obj.status === "notLoggedIn") {
                            
                            unsuccessBoxGenerator('Please log in to proceed');
                            
                            setTimeout(() => {
                                location.href = "/uni-watch/sign_in/signInForm";
                            }, 3000)
                        } else {
                            unsuccessBoxGenerator('Your cart is empty !');
                            
                            setTimeout(() => {
                                location.href = "/uni-watch/product/allProducts";
                            }, 3000)
                        }
                } catch (error) {
                    console.log(error)
                }
            })();
        }

    }

    // payment page 
    if (location.pathname.includes('paymentPage')) {

        // send the product detail to the server and create an order 
        document.querySelector('.info-container .button-container button').addEventListener('click', (evt) => {
            evt.preventDefault()

                const productContainers = document.querySelectorAll('.product');
                const productQuantities = document.querySelectorAll('.product .pro-price span');
                const subtotalPrice = document.querySelector('.payment-total .subtotal');

                const paymentProducts = [];

                
                productContainers.forEach((productContainer, index) => {
                    paymentProducts.push({
                        productId: productContainer.getAttribute('data-id'),
                        quantity: parseInt(productQuantities[index].textContent)
                    });
                });
                
                const subtotalValue = parseFloat(subtotalPrice.textContent.replace('$', '')).toFixed(2)

                const data = {
                    paymentProducts: paymentProducts,
                    subtotalPrice: subtotalValue
                };

                (async () => {
                    try {
                        let response = await fetch('/uni-watch/payment/createOrder', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(data)
                        })
        
                        let obj = await response.json()
                        if(obj.status === "success") {
                            successBoxGenerator('Order created successfully !');
        
                            setTimeout(() => {
                                location.href = "/uni-watch/home/index";
                            }, 3000)
                        } else {
                            unsuccessBoxGenerator('Failed to place the order.')
                        }
                    } catch (error) {
                        console.log(error)
                    }
                })();
        }, {once: true})


    }


    // admin page (product)
    if (location.pathname.includes('admin_add_product')) {

        // delete product from the product list (admin) 
        const deleteBtns = document.querySelectorAll('.action-buttons .btn-delete');

        deleteBtns.forEach((item) => {
            item.onclick = () => {
                const productId = item.getAttribute('data-id');
                const confirmDelete = confirm("Are you sure you want to delete this product?");

                if(confirmDelete) {
                    (async () => {
                        try {
                            let response = await fetch(`/uni-watch/Admin_add_product/deleteProduct?productId=${productId}`)
                            let obj = await response.json();
                            if(obj.status === "success") {
                                item.closest('tr').remove();
                                successBoxGenerator('Item deleted successfully !');
                            } else {
                                unsuccessBoxGenerator('Error deleting product');
                            }
                        } catch(error) {
                            console.log(error)
                        }
                    })();
                }


            }
        });
    }

    // admin page (user)
    if (location.pathname.includes('admin_add_user')) {
        // delete user from the user list (admin) 
        const deleteBtns = document.querySelectorAll('.user-action-buttons .btn-delete');

        deleteBtns.forEach((deleteBtn) => {
            deleteBtn.onclick = () => {
                const userId = deleteBtn.getAttribute('data-id');
                const confirmDelete = confirm("Are you sure you want to delete this user?");

                if(confirmDelete) {
                    (async () => {
                        try {
                            let response = await fetch(`/uni-watch/admin_add_user/deleteUser?userId=${userId}`)
                            let obj = await response.json()

                            if(obj.status === 'success') {
                                deleteBtn.closest('tr').remove();
                                successBoxGenerator('User deleted successfully !');
                            } else {
                                unsuccessBoxGenerator('Error deleting user');
                            }
                        } catch(error) {
                            console.log(error)
                        }
                    })();
                }
            }
        });


        const passwordInput = document.querySelector('input[type="password"]');

        // Disable copy on the password input   
        preventCopy(passwordInput);

        // Disable cut on the password input   
        preventCut(passwordInput);

        // Disable paste on the password input   
        preventPaste(passwordInput);
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
        togglePasswordVisibility('.sign-up-password > input[name="password"]', '#eye');


        // Disable copy on the password input   
        preventCopy(passwordInput);

        // Disable cut on the password input   
        preventCut(passwordInput);

        // Disable paste on the password input   
        preventPaste(passwordInput);
            
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




        // add product to the cartContainer(box) 
        const params = new URLSearchParams(window.location.search);
        const productId = params.get("id");
        const addToCartBtn = document.querySelector('.add-to-cart-btn');
        const productQuantity = document.querySelector('.title .product-quantity');
        const quantityInput = document.querySelector('#detail-quantity');
        const cartContainer = document.querySelector('.product-detail-container');
        const totalPriceElement = document.querySelector('.total-price-container .total-price');

        addToCartBtn.onclick = () => {
            const quantity = quantityInput.value;

                (async () => {
                    try {
                        let response = await fetch(`/uni-watch/basket/productDetail?productId=${productId}&quantity=${quantity}`);
                        let obj = await response.json();

                        if (obj.status === 'success') {
                            // function success message 
                            successBoxGenerator('Item successfully added to your cart !');
    
                            productQuantity.innerHTML = `${obj.cartCount} <span>Product(s)</span>`;
            
                            const productBox = document.createElement('div');
                            productBox.classList.add('product-box');
                            productBox.innerHTML = `
                                <div class="delete-icon-container">
                                    <i class="fa-regular fa-trash-can" data-id= "${obj.product.id}"></i>
                                </div>
                                <div class="product-details-container">
                                    <p class="product-name">${obj.product.title}</p>
                                    <div class="product-price">
                                        <p class="price">$${obj.product.price}</p>
                                        <p class="product-quantity"><i class="fa-solid fa-xmark"></i>${obj.product.quantity}</p>
                                    </div>
                                </div>
                                <div class="product-img-container">
                                    <img src="/uni-watch/public/assets/images/watches/${obj.product.image_path}" alt="${obj.product.title}">
                                </div>
                            `;
                            
                            cartContainer.append(productBox);
    
                            if (obj.cartCount > 0 && obj.totalPrice > 0) {
                                totalPriceElement.textContent = `Total Price: $${obj.totalPrice.toFixed(2)}`;
                            } else {
                                totalPriceElement.textContent = "Your Basket Is Empty!";
                            }
                            
            
                        } else {
                            // function unsuccess message
                            unsuccessBoxGenerator('Item is already in your cart !');
                        }
                    } catch(error) {
                        console.log(error)
                    }
                })();
        
        };

    }


    // terms&privacy page 
    if (location.pathname.includes('terms&privacy'))  {
        const accordionsContainer = document.querySelector('.accordion');

        accordionsContainer.addEventListener('click', (event) => {
            let button = event.target.closest('.accordion-btn');
            
            if (button) {
                const angleElem = button.querySelector('.accordion-angle');
                const accordionContentElem = button.parentElement.querySelector('.accordion-content');
                
                if (accordionContentElem.classList.contains('open')) {
                    button.style.color = '#fff';
                    angleElem.style.transform = 'rotate(0)';
                    accordionContentElem.classList.remove('open');
                } else {
                    button.style.color = '#b60213';
                    angleElem.style.transform = 'rotate(180deg)';
                    accordionContentElem.classList.add('open');
                }
            }
        });
    }



    // delete product from the cart box 
    document.querySelector('.product-detail-container').onclick = (evt) => {
        if(evt.target.classList.contains('fa-trash-can')) {

            const item = evt.target
            const productId = item.getAttribute('data-id')

            fetch(`/uni-watch/basket/deleteProduct?productId=${productId}`)
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success') {
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


    
    


    // sign in page  
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
        togglePasswordVisibility('.sign-in-password > input[name="password"]', '#eye');

        // Disable copy on the password input   
        preventCopy(signInPasswordInputElement);

         // Disable cut on the password input   
         preventCut(signInPasswordInputElement);

         // Disable paste on the password input   
         preventPaste(signInPasswordInputElement);
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


        //! optional for the quantity 
        // let increaseInterval;
        // increaseBtnElement.addEventListener('mousedown', () => {
        //     increaseInterval = setInterval(() => {
        //         inputQuantityElement.value = parseInt(inputQuantityElement.value) + 1;
        //     }, 100); 
        // });

        // increaseBtnElement.addEventListener('mouseup', () => {
        //     clearInterval(increaseInterval);
        // });
        
        // increaseBtnElement.addEventListener('mouseleave', () => {
        //     clearInterval(increaseInterval);
        // });

        // increaseBtnElement.addEventListener('mousedown', () => {
        //     inputQuantityElement.value = currentValue + 1;
        // });
    
    }


    // success box generator function
    function successBoxGenerator(message) {

        const successBox = document.querySelector('.success')

        if(!successBox) {
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

        
    }


    // unsuccess box generator function
    function unsuccessBoxGenerator(message) {

        const unsuccessBox = document.querySelector('.unsuccess')

        if(!unsuccessBox) {
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
    }


    // Disable copy on the password input function
    function preventCopy(inputElement) {
        inputElement.addEventListener('copy', (evt) => {
            evt.preventDefault();
        })
    }

     // Disable cut on the password input function
     function preventCut(inputElement) {
        inputElement.addEventListener('cut', (evt) => {
            evt.preventDefault();
        })
    }

     // Disable paste on the password input function
     function preventPaste(inputElement) {
        inputElement.addEventListener('paste', (evt) => {
            evt.preventDefault();
        })
    }

});




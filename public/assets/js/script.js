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


    basketIcon.addEventListener('click', (evt) => {
        evt.preventDefault();
        cartDetailBox.style.display = isHidden ? 'block' : 'none';
        isHidden = !isHidden;
        document.body.classList.toggle('blur-effect')
    })

    document.addEventListener('click', (evt) => {
        if (!cartDetailBox.contains(evt.target) && !basketIcon.contains(evt.target)) {
            cartDetailBox.style.display = 'none';
            document.body.classList.remove('blur-effect');
            isHidden = true;
        }
    });
    
    

    


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
        redirectionToAdminDashboard('.list-item.admin', '.fa-solid.fa-angle-down', '.admin-dashboard')


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

        }, 2000)


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
                        
                            const productImgBox = document.createElement('div');
                            productImgBox.classList.add('product-img-box');
                            productImgBox.setAttribute('data-id', `${product.id}`);
                        
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

        // get the product id 
        const productContainer = document.querySelector('.product-list');

        productContainer.addEventListener('click', (event) => {
            const productBox = event.target.closest('.product-img-box');

            if (productBox) {
                const productId = productBox.getAttribute('data-id');
                fetch(`/uni-watch/detail/productDetail?productId=${productId}`)
                window.location.href = `/uni-watch/detail/productDetail?productId=${productId}`;
            }
        });

        
        // redirection to the admin page method 
        redirectionToAdminDashboard('.list-item.admin', '.fa-solid.fa-angle-down', '.admin-dashboard')

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

        document.querySelector('input[type="submit"]').onclick = () => {
            if(usernameErrorMessage.innerHTML === 'Username already exists. Please choose another one.') {
                console.log('yes')
            }
        }
            
    }

    // detail page 
    if (location.pathname == '/uni-watch/detail/productDetail')  {

        // Handles increment, decrement, and manual input for quantity with min/max limits.
        const increaseBtn = document.querySelector('.inc.ctnbutton');
        const decreaseBtn = document.querySelector('.dec.ctnbutton');
        const detailInputQuantity = document.querySelector('#detail-quantity');
    
        decreaseBtn.classList.add('disabled'); 
    
        increaseBtn.onclick = () => {
            let currentValue = parseInt(detailInputQuantity.value);
            detailInputQuantity.value = currentValue + 1;
    
            if (currentValue + 1 >= 100) {
                increaseBtn.classList.add('disabled');
            } else {
                increaseBtn.classList.remove('disabled');
            }
    
            decreaseBtn.classList.remove('disabled');
        };
    
        decreaseBtn.onclick = () => {
            let currentValue = parseInt(detailInputQuantity.value);
            if (currentValue > 0) {
                detailInputQuantity.value = currentValue - 1;
            }
    
            if (currentValue - 1 <= 1) {
                decreaseBtn.classList.add('disabled');
            } else {
                decreaseBtn.classList.remove('disabled');
            }
    
            increaseBtn.classList.remove('disabled');
        };

        detailInputQuantity.onkeyup = () => {
            const quantity = Number(detailInputQuantity.value);
        
            if (quantity >= 100) {
                increaseBtn.classList.add('disabled');
            } else {
                increaseBtn.classList.remove('disabled');
            }
        
            if (quantity <= 1) {
                decreaseBtn.classList.add('disabled');
            } else {
                decreaseBtn.classList.remove('disabled');
            }
        };



        // retrieve the product detail and show them in the box product detail 
    //     const addToCartBtn = document.querySelector('.add-to-cart-btn')
    //     const productContainerElement = document.querySelector('.detail-box')

    //     const productId = productContainerElement.getAttribute('data-id')

    //     addToCartBtn.onclick = () => {
    //         fetch(`/uni-watch/basket/productDetail?productId=${productId}`)
    //             .then(response => response.json())
    //             .then(data => {
    //                 if (data.product) {
    //                     addProductToCartBox(data.product);
    //                 }
    //             })
    //     }

    //     // redirection to the admin page method 
    //     redirectionToAdminDashboard('.list-item.admin', '.fa-solid.fa-angle-down', '.admin-dashboard')

    }

    // Dynamically adds the product details to the cart box
    // function addProductToCartBox(product) {
    //     const cartDetailBox = document.querySelector('.cart-detail-box');
    //     const totalPriceContainer = cartDetailBox.querySelector('.total-price-container');
        
    //     let productDetailContainer = cartDetailBox.querySelector('.product-detail-container');
    
    //     if (!productDetailContainer) {
    //         productDetailContainer = document.createElement('div');
    //         productDetailContainer.classList.add('product-detail-container');
    //         cartDetailBox.appendChild(productDetailContainer); 
    //     }

    
    //     if (totalPriceContainer) {  
    //         cartDetailBox.insertBefore(productDetailContainer, totalPriceContainer);
    //     }
        
    //     const productElement = document.createElement('div');
    //     productElement.classList.add('product-box');
    //     productElement.innerHTML = `
    //         <div class="delete-icon-container">
    //             <i class="fa-regular fa-trash-can"></i>
    //         </div>
    //         <div class="product-details-container">
    //             <p class="product-name">${product.title}</p>
    //             <div class="product-price">$${product.price}</div>
    //         </div>
    //         <div class="product-img-container">
    //             <img src="/uni-watch/public/assets/images/watches/${product.image_path}" alt="${product.title}">
    //         </div>
    //     `;
    
    //     productDetailContainer.appendChild(productElement);
    // }
    
    



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
    
});








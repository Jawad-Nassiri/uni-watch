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


    // redirection to the admin dashboard 
    // const adminElementLink = document.querySelector('.list-item.admin');
    // const angleElement = document.querySelector('.fa-solid.fa-angle-down');
    // let angleUp = false;

    // let adminDashboardLink = document.querySelector('.admin-dashboard');

    // if (!adminDashboardLink) {
    //     adminDashboardLink = document.createElement('a');
    //     adminDashboardLink.classList.add('admin-dashboard');
    //     adminDashboardLink.href = '/uni-watch/Admin_add_product/addProduct';
    //     adminDashboardLink.textContent = 'Admin Dashboard';
    //     adminDashboardLink.style.display = 'none';
    //     adminElementLink.appendChild(adminDashboardLink);
    // }

    // angleElement.onclick = () => {
    //     if (!angleUp) {
    //         angleElement.className = 'fa-solid fa-angle-up';
    //         adminDashboardLink.style.display = 'block'; 
    //         angleUp = true;
    //     } else {
    //         angleElement.className = 'fa-solid fa-angle-down';
    //         adminDashboardLink.style.display = 'none';
    //         angleUp = false;
    //     }
    // };

    // home page 
    if(location.pathname.includes('home')) {
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

    }



    // shop page 
    if (location.pathname.includes('product')) {

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
                            productBox.innerHTML = `
                                <div class="product-img-box">
                                    <img src="/uni-watch/public/assets/images/watches/${product.image_path}" alt="${product.title}">
                                </div>
                                <div class="product-details">
                                    <p class="product-tag">${product.category}</p>
                                    <h4 class="product-name">${product.title}</h4>
                                    <p class="product-price">$${product.price}</p>
                                </div>
                            `;
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

    if (location.pathname.includes('detail'))  {

        const increaseBtn = document.querySelector('.inc.ctnbutton')
        const decreaseBtn = document.querySelector('.dec.ctnbutton')
        const detailInputQuantity = document.querySelector('#detail-quantity')

        decreaseBtn.disabled = true;
        
        increaseBtn.onclick = () => {
            detailInputQuantity.value = parseInt(detailInputQuantity.value) + 1;

            if (parseInt(detailInputQuantity.value) >= 100) {
                increaseBtn.disabled = true;
            }

            decreaseBtn.disabled = false;
        }

        decreaseBtn.onclick = () => {
            detailInputQuantity.value--;
        }


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
});








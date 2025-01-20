document.addEventListener('DOMContentLoaded', () => {
    //open and close the navbar in the tablet and mobile device
    document.querySelector('div#open').onclick = () => {document.querySelector('ul#nav').classList = 'active'}
    document.querySelector('li#close').onclick = () => {document.querySelector('ul#nav').className = ''}
    
    // highlight the active link based on the current URL
    const currentPath = location.pathname;
    let currentPageItem = Array.from(document.querySelectorAll('#nav li a')).find(navItem => navItem.pathname === currentPath);
    currentPageItem.style.cssText = 'background:#b60213; color:white;'


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
    if (location.pathname.includes('shop')) {

        // shop page carousel
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


        // update main product image to the clicked small image
        const productItems = document.querySelectorAll('.product-item');

        productItems.forEach(product => {
            const mainImage = product.querySelector('.main-img');
            const smallImgBoxes = product.querySelectorAll('.img-box');
        
            smallImgBoxes.forEach(smallImgBox => {
                smallImgBox.addEventListener('click', () => {
                    mainImage.style.opacity = mainImage.src !== smallImgBox.querySelector('img').src ? '0' : '1'
                    setTimeout(() => {
                        mainImage.src = smallImgBox.querySelector('img').src;
                        mainImage.style.opacity = '1';
                    }, 300);
                });
            });
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

        
            // email validation
            emailInput.addEventListener('keyup', () => {
                const value = emailInput.value;
                const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                if (!emailPattern.test(value)) {
                    emailInput.style.border = '3px solid #b60213';
                    emailErrorMessage.textContent = 'Please enter a valid email';
                    emailErrorMessage.style.color = '#b60213';
                } else {
                    emailInput.style.border = '3px solid green';
                    emailErrorMessage.textContent = 'Email is valid';
                    emailErrorMessage.style.color = 'green';
                }
            });

            // username validation
            usernameValidation(usernameInput, usernameErrorMessage);
        
            // password validation
            passwordValidation(passwordInput, passwordErrorMessage)

            // function to add show/hide password functionality
            togglePasswordVisibility('.sign-up-password > input[name="password"]', '#eye')

            
    }

    if (location.pathname.includes('sign-in')) {

        
        const signInUsernameInputElement = document.querySelector('.sign-in-username')
        const signInPasswordInputElement = document.querySelector('.sign-in-password-input')

        const signInUsernameErrMessage = document.querySelector('.sign-in-username-error')
        const signInPasswordErrMessage = document.querySelector('.sign-in-password-error')

        // username validation
        usernameValidation(signInUsernameInputElement, signInUsernameErrMessage)

        // password validation
        passwordValidation(signInPasswordInputElement, signInPasswordErrMessage)

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
        inputElement.addEventListener('keyup', () => {
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
        });
    }

    // password validation function
    function passwordValidation(inputElement, errMessageElement) {
        inputElement.addEventListener('keyup', () => {
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
        });
    }
    


        
});
















































// usernameInput.addEventListener('keyup', () => {
//     const value = usernameInput.value;
//     if (value.length < 3) {
//         usernameInput.style.border = '3px solid #b60213';
//         usernameErrorMessage.textContent = 'Username must be at least 3 characters';
//         usernameErrorMessage.style.color = '#b60213';
//     } else {
//         usernameInput.style.border = '3px solid green';
//         usernameErrorMessage.textContent = 'Username is valid';
//         usernameErrorMessage.style.color = 'green';
//     }
// });




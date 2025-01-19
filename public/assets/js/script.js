document.addEventListener('DOMContentLoaded', () => {
    //open and close the navbar in the tablet and mobile device
    document.querySelector('div#open').onclick = () => {document.querySelector('ul#nav').classList = 'active'}
    document.querySelector('li#close').onclick = () => {document.querySelector('ul#nav').className = ''}
    
    // highlight the active link based on the current URL
    const currentPath = location.pathname;
    console.log(currentPath)
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
    }


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
        
});
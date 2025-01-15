document.addEventListener('DOMContentLoaded', () => {
    //open and close the navbar in the tablet and mobile device
    document.querySelector('div#open').onclick = () => {document.querySelector('ul#nav').classList = 'active'}
    document.querySelector('li#close').onclick = () => {document.querySelector('ul#nav').className = ''}
    
    // highlight the active link based on the current URL
    const currentPath = location.pathname;
    let currentPageItem = Array.from(document.querySelectorAll('#nav li a')).find((navItem) => {
        return navItem.pathname === currentPath; 
    });
    currentPageItem.style.cssText = 'background:#b60213; color:white;'


    // home page 
    if(location.pathname.includes('home')) {
        //home page carousel 
        const carousel = document.querySelector('.carousel');
        const prevBtn = document.querySelector('.prev');
        const nextBtn = document.querySelector('.next');
        const items = document.querySelectorAll('.carousel-item');


        const itemWidth = document.querySelector('.carousel-item').offsetWidth + 20;
        const totalItems = items.length;
        const visibleItems = Math.round(carousel.offsetWidth / itemWidth);
        const maxIndex = totalItems - visibleItems;
        let currentIndex = 0;

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
        const shopCarouselItemWidth = document.querySelector('.shop-carousel-item').offsetWidth + 1

        console.log('scroll width => ' , shopCarouselContainer.scrollWidth)
        console.log('offset width => ' , shopCarouselContainer.offsetWidth)

        
        const itemsClone = Array.from(shopCarouselItems).map(item => item.cloneNode(true))
        itemsClone.forEach(item => shopCarouselContainer.append(item))

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
        
        
        
});
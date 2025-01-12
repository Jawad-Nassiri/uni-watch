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

    
})

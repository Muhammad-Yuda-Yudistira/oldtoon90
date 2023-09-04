const navlink = document.querySelectorAll('.nav-link');

navlink.forEach((menu) => {
    menu.addEventListener('click', (e) => {
        e.preventDefault()
        const el = e.target
        const urlTarget = el.getAttribute('href')

        navlink.forEach((otherMenu) => {
            otherMenu.classList.remove('active')
        })
        
        el.classList.toggle('active')

        localStorage.setItem('activeMenu', urlTarget)

        window.location.assign(urlTarget)
    })
})

document.addEventListener('DOMContentLoaded', () => {
    const activeMenu = localStorage.getItem('activeMenu');

    navlink.forEach((otherMenu) => {
        otherMenu.classList.remove('active')
    })
    
    if (activeMenu) {
        const activeLink = document.querySelector(`.nav-link[href="${activeMenu}"]`);
        if (activeLink) {
            activeLink.classList.add('active');
        }
    }
});
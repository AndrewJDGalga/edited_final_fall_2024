const btnMobile = document.getElementById('btn_mobile');
const menuMobile = document.getElementById('nav_mobile');

//Only hide mobile menu + set aria for accessability
const hideMobileMenu = () => {
    if(!menuMobile.classList.contains('mobile-invisible')){
        menuMobile.classList.add('mobile-invisible');
        btnMobile.setAttribute("aria-expanded", !menuMobile.classList.contains('mobile-invisible'));
    }
}

btnMobile.onclick = () => {
    menuMobile.classList.toggle('mobile-invisible');
    btnMobile.setAttribute("aria-expanded", !menuMobile.classList.contains('mobile-invisible'));
}
document.onclick = (e) => {
    if(e.target !== btnMobile && e.target !== btnMobile.firstChild) {
        hideMobileMenu()
    }
}

document.onscroll = () => hideMobileMenu();

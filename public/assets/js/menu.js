const toggle = document.querySelector('.menu-toggle');
const nav    = document.querySelector('#site-nav');

if (toggle && nav) {
    toggle.addEventListener('click', () => {
        const isOpen = nav.classList.toggle('open');     // hint: adds if missing, removes if there; returns true/false
        toggle.setAttribute('aria-expanded', isOpen);
    });
}
document.addEventListener("DOMContentLoaded", function () {
	initBurgerMenu();
});


function initBurgerMenu() {
	const burger = document.querySelector('.header__burger');
	const closeBtn = document.querySelector('.header__mobile-close');
	const mobileMenu = document.querySelector('.header__mobile-menu');
	const overlay = document.querySelector('.header__overlay');

	if (!burger || !mobileMenu) return;

	function openMenu() {
		mobileMenu.classList.add('is-open');
		overlay.classList.add('is-open');
		document.body.style.overflow = 'hidden';
	}

	function closeMenu() {
		mobileMenu.classList.remove('is-open');
		overlay.classList.remove('is-open');
		document.body.style.overflow = '';
	}

	burger.addEventListener('click', openMenu);
	closeBtn.addEventListener('click', closeMenu);
	overlay.addEventListener('click', closeMenu);
}




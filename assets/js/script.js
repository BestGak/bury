document.addEventListener("DOMContentLoaded", function () {
	initBurgerMenu();
	initStickyHeader();
	initFormCounter();
	initFormSuccess();
	initProjectsAjax();
	initSimilarProjectsSwiper();
	initSimilarServicesSwiper();
	initServiceIncludedSwiper();
	initFaqAccordion();
	initProjectTabs();
	initCompanyHistorySwiper();
	initGalleryLightbox();
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

function initFormCounter() {
	document.querySelectorAll('.cform__field--full').forEach(function (wrap) {
		const textarea = wrap.querySelector('textarea');
		const counter  = wrap.querySelector('.cform__counter');

		if (!textarea || !counter) return;

		const max = textarea.getAttribute('maxlength') || 500;

		textarea.addEventListener('input', function () {
			counter.textContent = this.value.length + ' / ' + max + ' characters max.';
		});
	});
}

function initFormSuccess() {
	document.addEventListener('wpcf7mailsent', function (e) {
		const wpcf7El  = document.getElementById( e.detail.unitTag );
		const formWrap = wpcf7El ? wpcf7El.closest('.cform__form-wrap') : null;

		if (!formWrap) return;

		const originalHTML  = formWrap.innerHTML;
		const currentHeight = formWrap.offsetHeight;

		formWrap.style.minHeight = currentHeight + 'px';

		formWrap.innerHTML = `
			<div class="cform__success">
				<svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
					<polyline points="9,12 11,14 15,10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
				<h3 class="cform__success-title">Message sent!</h3>
				<p class="cform__success-text">Thank you for reaching out. We'll get back to you as soon as possible.</p>
				<button class="cform__success-close btn btn--secondary" type="button">Close</button>
			</div>
		`;

		formWrap.querySelector('.cform__success-close').addEventListener('click', function () {
			formWrap.innerHTML = originalHTML;
			formWrap.style.minHeight = '';
			initFormCounter();
		});
	}, false);
}

function initProjectsAjax() {
	const tabsWrap      = document.getElementById('projects-tabs');
	const grid          = document.getElementById('projects-grid');
	const paginationWrap = document.getElementById('projects-pagination');

	if (!tabsWrap || !grid) return;

	let currentCat = 0;

	function setActiveTab(btn) {
		tabsWrap.querySelectorAll('.projects__tab').forEach(function (t) {
			t.classList.remove('is-active');
		});
		btn.classList.add('is-active');
	}

	function fetchProjects(cat, paged) {
		const data = new FormData();
		data.append('action', 'get_projects');
		data.append('nonce',  script_js.nonce);
		data.append('cat',    cat);
		data.append('paged',  paged);

		fetch(script_js.ajax_url, { method: 'POST', body: data })
			.then(function (r) { return r.json(); })
			.then(function (res) {
				if (!res.success) return;

				grid.innerHTML = res.data.grid;

				if (paginationWrap) {
					if (res.data.pages > 1) {
						paginationWrap.innerHTML = res.data.pagination;
						paginationWrap.style.display = '';
						bindPagination();
					} else {
						paginationWrap.innerHTML = '';
					}
				}

				currentCat = cat;
			});
	}

	function bindPagination() {
		if (!paginationWrap) return;
		paginationWrap.querySelectorAll('.projects__page-btn').forEach(function (btn) {
			btn.addEventListener('click', function () {
				const page = parseInt(btn.dataset.page, 10);
				fetchProjects(currentCat, page);
				grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
			});
		});
	}

	tabsWrap.querySelectorAll('.projects__tab').forEach(function (btn) {
		btn.addEventListener('click', function () {
			const cat = parseInt(btn.dataset.cat, 10);
			setActiveTab(btn);
			fetchProjects(cat, 1);
		});
	});

	bindPagination();
}

function initProjectTabs() {
	const tabs = document.querySelectorAll('.project-tabs__tab');
	const body = document.querySelector('.project-tabs__body');

	if (!tabs.length) return;

	function setTabBg(bgUrl) {
		if (!body || !bgUrl) return;
		body.style.backgroundImage =
			'linear-gradient(0deg, rgba(16,35,49,0.40) 0%, rgba(16,35,49,0.40) 100%), url("' + bgUrl + '")';
	}

	tabs.forEach(function (tab) {
		tab.addEventListener('click', function () {
			if (tab.classList.contains('is-active')) return;

			const target      = tab.dataset.tab;
			const nextPanel   = document.querySelector('.project-tabs__panel[data-panel="' + target + '"]');
			const activePanel = document.querySelector('.project-tabs__panel.is-active');

			tabs.forEach(function (t) { t.classList.remove('is-active'); });
			tab.classList.add('is-active');

			if (activePanel) activePanel.classList.remove('is-active');
			nextPanel.classList.add('is-active');

			setTabBg(tab.dataset.bg);
		});
	});
}

function initFaqAccordion() {
	document.querySelectorAll('.faq-item__trigger').forEach(function (trigger) {
		trigger.addEventListener('click', function () {
			const item = trigger.closest('.faq-item');
			const isOpen = item.classList.contains('is-open');

			document.querySelectorAll('.faq-item.is-open').forEach(function (openItem) {
				openItem.classList.remove('is-open');
				openItem.querySelector('.faq-item__trigger').setAttribute('aria-expanded', 'false');
			});

			if (!isOpen) {
				item.classList.add('is-open');
				trigger.setAttribute('aria-expanded', 'true');
			}
		});
	});
}

function initServiceIncludedSwiper() {
	const el = document.querySelector('.service-included__swiper');
	if (!el) return;

	new Swiper(el, {
		slidesPerView: 3,
		spaceBetween: 20,
		watchSlidesProgress: true,
		pagination: {
			el: '.service-included__dots',
			clickable: true,
		},
		navigation: {
			prevEl: '.service-included__btn--prev',
			nextEl: '.service-included__btn--next',
		},
		breakpoints: {
			0: {
				slidesPerView: 1,
				spaceBetween: 16,
			},
			768: {
				slidesPerView: 2,
				spaceBetween: 20,
			},
			1024: {
				slidesPerView: 3,
				spaceBetween: 20,
			},
		},
	});
}

function initSimilarServicesSwiper() {
	const el = document.querySelector('.similar-services__swiper');
	if (!el) return;

	new Swiper(el, {
		slidesPerView: 2,
		spaceBetween: 20,
		pagination: {
			el: '.similar-services__dots',
			clickable: true,
		},
		navigation: {
			prevEl: '.similar-services__btn--prev',
			nextEl: '.similar-services__btn--next',
		},
		breakpoints: {
			0: {
				slidesPerView: 1,
				spaceBetween: 16,
			},
			768: {
				slidesPerView: 2,
				spaceBetween: 20,
			},
		},
	});
}

function initStickyHeader() {
	var topbar = document.querySelector('.header__topbar');
	var mainNav = document.querySelector('.header__main');
	if (!topbar || !mainNav) return;

	var isSticky = false;
	var placeholder = document.createElement('div');
	placeholder.style.display = 'none';
	mainNav.parentNode.insertBefore(placeholder, mainNav);

	window.addEventListener('scroll', function() {
		var threshold = topbar.offsetHeight;
		var shouldStick = window.scrollY > threshold;

		if (shouldStick && !isSticky) {
			isSticky = true;
			placeholder.style.display = 'block';
			placeholder.style.height = mainNav.offsetHeight + 'px';
			mainNav.classList.add('header__main--sticky');
		} else if (!shouldStick && isSticky) {
			isSticky = false;
			placeholder.style.display = 'none';
			mainNav.classList.remove('header__main--sticky');
		}
	}, { passive: true });
}

function initGalleryLightbox() {
	if (typeof GLightbox === 'undefined') return;
	if (!document.querySelector('.glightbox')) return;

	GLightbox({
		selector: '.glightbox',
		touchNavigation: true,
		loop: true,
		autoplayVideos: false,
	});
}

function initCompanyHistorySwiper() {
	const el = document.querySelector('.company-history__swiper');
	if (!el) return;

	new Swiper(el, {
		slidesPerView: 1,
		spaceBetween: 0,
		pagination: {
			el: '.company-history__dots',
			clickable: true,
		},
		navigation: {
			prevEl: '.company-history__btn--prev',
			nextEl: '.company-history__btn--next',
		},
	});
}

function initSimilarProjectsSwiper() {
	const el = document.querySelector('.similar-projects__swiper');
	if (!el) return;

	new Swiper(el, {
		slidesPerView: 3,
		spaceBetween: 20,
		pagination: {
			el: '.similar-projects__dots',
			clickable: true,
		},
		navigation: {
			prevEl: '.similar-projects__btn--prev',
			nextEl: '.similar-projects__btn--next',
		},
		breakpoints: {
			0: {
				slidesPerView: 1,
				spaceBetween: 16,
			},
			768: {
				slidesPerView: 2,
				spaceBetween: 20,
			},
			1024: {
				slidesPerView: 3,
				spaceBetween: 20,
			},
		},
	});
}


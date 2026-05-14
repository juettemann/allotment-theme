(function () {
	'use strict';

	function initMobileMenu() {
		var toggle = document.querySelector('[data-at-nav-toggle]');
		var panel  = document.querySelector('[data-at-nav-mobile]');
		if (!toggle || !panel) {
			return;
		}

		toggle.setAttribute('aria-expanded', 'false');
		toggle.setAttribute('aria-controls', panel.id || 'at-nav-mobile');
		if (!panel.id) {
			panel.id = 'at-nav-mobile';
		}

		toggle.addEventListener('click', function () {
			var isOpen = panel.classList.toggle('is-open');
			toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
		});

		document.addEventListener('keydown', function (event) {
			if (event.key === 'Escape' && panel.classList.contains('is-open')) {
				panel.classList.remove('is-open');
				toggle.setAttribute('aria-expanded', 'false');
				toggle.focus();
			}
		});
	}

	function initSkipLink() {
		var link = document.querySelector('.skip-link');
		if (!link) {
			return;
		}
		link.addEventListener('click', function (event) {
			var target = document.querySelector(link.getAttribute('href'));
			if (target) {
				event.preventDefault();
				if (!target.hasAttribute('tabindex')) {
					target.setAttribute('tabindex', '-1');
				}
				target.focus();
				target.scrollIntoView();
			}
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', function () {
			initMobileMenu();
			initSkipLink();
		});
	} else {
		initMobileMenu();
		initSkipLink();
	}
})();

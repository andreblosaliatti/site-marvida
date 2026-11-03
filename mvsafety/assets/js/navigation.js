(function () {
	'use strict';

	var toggle = document.querySelector('.mv-menu-toggle');
	var navigation = document.querySelector('.mv-primary-nav');

	if (!toggle || !navigation) {
		return;
	}

	toggle.addEventListener('click', function () {
		var isExpanded = toggle.getAttribute('aria-expanded') === 'true';
		toggle.setAttribute('aria-expanded', String(!isExpanded));
		navigation.classList.toggle('is-open', !isExpanded);
	});

	document.addEventListener('keydown', function (event) {
		if (event.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
			toggle.setAttribute('aria-expanded', 'false');
			navigation.classList.remove('is-open');
			toggle.focus();
		}
	});
}());

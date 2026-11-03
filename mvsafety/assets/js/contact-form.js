(function () {
	'use strict';

	var form = document.querySelector('[data-static-contact-form]');
	if (!form) {
		return;
	}

	var english = document.documentElement.lang.toLowerCase().indexOf('en') === 0;
	var messages = english
		? {
			config: 'The enquiry form is not set up yet. Please contact the site administrator.',
			sending: 'Sending your enquiry…',
			success: 'Your enquiry has been sent. Thank you.',
			error: 'Your enquiry could not be sent. Please try again later or contact us directly.'
		}
		: {
			config: 'O formulário ainda não está configurado. Entre em contato com o administrador do site.',
			sending: 'Enviando sua solicitação…',
			success: 'Sua solicitação foi enviada. Obrigado.',
			error: 'Não foi possível enviar sua solicitação. Tente novamente ou entre em contato diretamente.'
		};
	var submitButton = form.querySelector('button[type="submit"]');
	var endpoint = window.MVSAFETY_CONFIG && window.MVSAFETY_CONFIG.formEndpoint;
	var note = document.createElement('p');
	note.className = 'mv-form-message mv-form-message--error';
	note.setAttribute('role', 'status');
	note.textContent = messages.config;
	form.parentNode.insertBefore(note, form);

	if (submitButton) {
		submitButton.disabled = true;
	}
	if (typeof endpoint !== 'string' || !endpoint.trim()) {
		return;
	}

	var parsedEndpoint;
	try {
		parsedEndpoint = new URL(endpoint, window.location.href);
	} catch (error) {
		return;
	}
	if (parsedEndpoint.protocol !== 'https:') {
		return;
	}
	note.remove();
	if (submitButton) {
		submitButton.disabled = false;
	}
	form.addEventListener('submit', function (event) {
		event.preventDefault();
		if (!form.reportValidity()) {
			return;
		}

		var values = new FormData(form);
		if (values.get('website')) {
			form.reset();
			note.className = 'mv-form-message mv-form-message--success';
			note.textContent = messages.success;
			form.parentNode.insertBefore(note, form);
			return;
		}

		if (submitButton) {
			submitButton.disabled = true;
		}
		note.className = 'mv-form-message';
		note.setAttribute('role', 'status');
		note.textContent = messages.sending;
		form.parentNode.insertBefore(note, form);

		fetch(parsedEndpoint.href, {
			method: 'POST',
			body: values,
			headers: { Accept: 'application/json' }
		}).then(function (response) {
			if (!response.ok) {
				throw new Error('Form endpoint rejected the enquiry.');
			}
			form.reset();
			note.className = 'mv-form-message mv-form-message--success';
			note.textContent = messages.success;
		}).catch(function () {
			note.className = 'mv-form-message mv-form-message--error';
			note.setAttribute('role', 'alert');
			note.textContent = messages.error;
		}).finally(function () {
			if (submitButton) {
				submitButton.disabled = false;
			}
		});
	});
}());

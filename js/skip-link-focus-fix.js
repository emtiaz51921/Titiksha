/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */

( function() {




	/*
	// Mobile menu focus trapping
	// add all the elements inside modal which you want to make focusable
	*/
	if (Modernizr.mq('(max-width: 980px)')) {

		const focusableElements = 'button, [href], input, a';
		const modal = document.querySelector('.menu_holder'); // select the modal by it's class

		const firstFocusableElement = modal.querySelectorAll(focusableElements)[0]; // get first element to be focused inside modal
		const focusableContent = modal.querySelectorAll(focusableElements);
		const lastFocusableElement = focusableContent[focusableContent.length - 1]; // get last element to be focused inside modal


		document.addEventListener('keydown', function (e) {
			let isTabPressed = e.key === 'Tab' || e.keyCode === 9;

			if (!isTabPressed) {
				return;
			}

			if (e.shiftKey) { // if shift key pressed for shift + tab combination
				if (document.activeElement === firstFocusableElement) {
					lastFocusableElement.focus(); // add focus for the last focusable element
					e.preventDefault();
				}
			} else { // if tab key is pressed
				if (document.activeElement === lastFocusableElement) { // if focused has reached to last focusable element then focus first focusable element after pressing tab
					firstFocusableElement.focus(); // add focus for the first focusable element
					e.preventDefault();
				}
			}
		});

	}




	var isIe = /(trident|msie)/i.test( navigator.userAgent );

	if ( isIe && document.getElementById && window.addEventListener ) {
		window.addEventListener(
			'hashchange',
			function() {
				var id = location.hash.substring( 1 ),
				element;

				if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
					return;
				}

				element = document.getElementById( id );

				if ( element ) {
					if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
						element.tabIndex = -1;
					}

					element.focus();
				}
			},
			false
		);
	}
} )();

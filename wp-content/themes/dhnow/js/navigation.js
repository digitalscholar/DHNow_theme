/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	const siteNavigation = document.getElementById( 'site-navigation' );
	const siteHeader     = document.querySelector( '.site-header' );

	// Return early if the navigation doesn't exist.
	if ( ! siteNavigation ) {
		return;
	}

	const button = document.getElementById( 'menu-toggle' );

	// Return early if the button doesn't exist.
	if ( 'undefined' === typeof button ) {
		return;
	}

	const menu = siteNavigation.getElementsByTagName( 'ul' )[ 0 ];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	if ( ! menu.classList.contains( 'nav-menu' ) ) {
		menu.classList.add( 'nav-menu' );
	}

	// Toggle the .toggled class and the aria-expanded value each time the button is clicked.
	button.addEventListener( 'click', function() {
		siteNavigation.classList.toggle( 'toggled' );

		if ( button.getAttribute( 'aria-expanded' ) === 'true' ) {
			button.setAttribute( 'aria-expanded', 'false' );
		} else {
			button.setAttribute( 'aria-expanded', 'true' );
		}
	} );

	// Remove the .toggled class and set aria-expanded to false when the user clicks outside the navigation.
	document.addEventListener( 'click', function( event ) {
		if ( button === event.target || button.contains( event.target ) ) {
			return;
		}

		const isClickInside = siteNavigation.contains( event.target );

		if ( ! isClickInside ) {
			siteNavigation.classList.remove( 'toggled' );
			button.setAttribute( 'aria-expanded', 'false' );
		}
	} );

	// Get all the li elements within the menu.
	const lis = menu.getElementsByTagName( 'li' );

	// Get all the link elements within the menu.
	const links = menu.getElementsByTagName( 'a' );

	// Get all the link elements with children within the menu.
	const linksWithChildren = menu.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

	// Toggle focus each time a menu link is focused or blurred.
	for ( const link of links ) {
		link.addEventListener( 'focus', toggleFocus, true );
		link.addEventListener( 'blur', toggleFocus, true );
	}

	// Toggle focus each time a menu link with children receive a touch event.
	for ( const link of linksWithChildren ) {
		link.addEventListener( 'touchstart', toggleFocus, false );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus( event ) {
		if ( window.innerWidth >= 1200 ) {
			return;
		}

		if ( event.type === 'focus' || event.type === 'blur' ) {
			let self = this;
			// Move up through the ancestors of the current link until we hit .nav-menu.
			while ( ! self.classList.contains( 'nav-menu' ) ) {
				// On li elements toggle the class .focus.
				if ( 'li' === self.tagName.toLowerCase() ) {
					self.classList.toggle( 'focus' );
				}
				self = self.parentNode;
			}
		}

		/*if ( event.type === 'touchstart' ) {
			const menuItem = this.parentNode;
			event.preventDefault();
			for ( const link of menuItem.parentNode.children ) {
				if ( menuItem !== link ) {
					//link.classList.remove( 'focus' );
				}
			}
			menuItem.classList.toggle( 'focus' );
		}*/
	}

	// On Resize event logic.

	const topBarRight = document.querySelector( '.top-bar-right' );

	onResize();
	window.addEventListener( 'resize', onResize );

	function onResize() {
		if ( window.innerWidth < 1200 ) {
			siteNavigation.appendChild( topBarRight );
		} else {
			siteHeader.appendChild( topBarRight );

			for ( const li of lis ) {
				li.classList.remove( 'focus' );
			}
		}
	}

	// Scrolling Events

	let lastKnownScrollPosition = 0;
	let ticking = false;
	let scrollDirection = 'up';
	const scrollPos = window.scrollY;

	onScroll( scrollPos );

	function onScroll( scrollPos ) {
		if ( scrollPos > 60 ) {
			siteHeader.style.backgroundColor = '#000';

			if ( scrollDirection === 'down' ) {
				siteHeader.classList.add( 'site-header__small' );
			} else {
				siteHeader.classList.remove( 'site-header__small' );
			}
		} else {
			siteHeader.style.backgroundColor = 'transparent';
			siteHeader.classList.remove( 'site-header__small' );
		}
	}

	document.addEventListener('scroll', ( event ) => {
		scrollDirection = Math.max( lastKnownScrollPosition, window.scrollY ) == lastKnownScrollPosition ? 'up': 'down';
		lastKnownScrollPosition = window.scrollY;

		if ( !ticking ) {
			window.requestAnimationFrame(() => {
				onScroll( lastKnownScrollPosition );
				ticking = false;
			});

			ticking = true;
		}
	});
}() );

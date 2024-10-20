document.addEventListener( 'DOMContentLoaded', function() {
	const widgetEditorsCorner = document.querySelector( '.widget_editors-corner' );
	const accordionButton = widgetEditorsCorner.querySelector( '.widget-header' );
	const accordionContent = widgetEditorsCorner.querySelector( '.menu-editors-corner-menu-container' );

	if ( accordionButton && accordionContent ) {
		let resizeTimeout;

		window.addEventListener( 'resize', function() {
			clearTimeout( resizeTimeout );
			resizeTimeout = setTimeout( getWindowWidth, 200 );
		} );

		getWindowWidth();
	}

	function getWindowWidth() {
		if ( window.innerWidth < 1200 ) {
			widgetEditorsCorner.classList.add( 'collapsed' );
			accordionButton.addEventListener( 'click', toggleCollapsedClass );
		} else {
			widgetEditorsCorner.classList.remove( 'collapsed' );
			accordionButton.removeEventListener( 'click', toggleCollapsedClass );
		}
	}

	function toggleCollapsedClass() {
		widgetEditorsCorner.classList.toggle( 'collapsed' );
	}
} );

document.addEventListener( 'DOMContentLoaded', function() {
	const verticalTabsContainers = document.querySelectorAll( '.vertical-tabs' );
	let resizeTimeout;

	window.addEventListener( 'resize', function() {
		clearTimeout( resizeTimeout );
		resizeTimeout = setTimeout( onWindowResize, 200 );
	});

	// Set verticalTabsContents visibility and events.
	verticalTabsContainers.forEach( verticalTabsContainer => {
		const verticalTabsButtons = verticalTabsContainer.querySelectorAll( '.tab-button a' );
		const verticalTabsContents = verticalTabsContainer.querySelectorAll( '.tab-content' );

		// Indicator element.
		const indicator = document.createElement( 'div' );
		indicator.className = 'tab-indicator';
		verticalTabsContainer.appendChild( indicator );

		let currentVerticalTabsButton = 0;
		verticalTabsButtons.forEach( verticalTabsButton => {
			verticalTabsButton.addEventListener( 'click', ( event ) => {
				event.preventDefault();

				const verticalTabsContentID = event.currentTarget.getAttribute( 'href' );
				const verticalTabsContentToShow = document.querySelector( verticalTabsContentID );

				if ( verticalTabsContentToShow ) {
					// Hide all verticalTabsContent elements.
					verticalTabsContents.forEach( verticalTabsContent => {
						verticalTabsContent.style.visibility = 'hidden';
						verticalTabsContent.style.opacity = 0;
					} );

					// Show the selected verticalTabsContent element.
					verticalTabsContentToShow.style.visibility = 'visible';
					verticalTabsContentToShow.style.opacity = 1;
				}

				// Assign active class.
				const currentActiveButton = verticalTabsContainer.querySelector( '.active' );
				if ( currentActiveButton && currentActiveButton !== event.currentTarget.closest( '.tab-button' ) ) {
					console.log('is different')
					currentActiveButton.classList.remove( 'active' );
				}
				event.currentTarget.closest( '.tab-button' ).classList.add( 'active' );

				// Animate the indicator.
				const referenceRect = verticalTabsContainer.getBoundingClientRect();
				const targetRect = event.currentTarget.getBoundingClientRect();
				const verticalPosition = targetRect.top - referenceRect.top;
				indicator.style.top = ( verticalPosition - 10 ) + 'px';
			} );

			if ( 0 === currentVerticalTabsButton ) {
				verticalTabsButton.click();
			}

			currentVerticalTabsButton++;
		} );

		let currentVerticalTabsContent = 0;
		verticalTabsContents.forEach( verticalTabsContent => {
			if ( 0 === currentVerticalTabsContent ) {
				verticalTabsContent.style.visibility = 'visible';
				verticalTabsContent.style.opacity = 1;
			}

			currentVerticalTabsContent++;
		} );

	} );

	onWindowResize();

	function onWindowResize() {
		verticalTabsContainers.forEach( verticalTabsContainer => {
			const verticalTabsContents = verticalTabsContainer.querySelectorAll( '.tab-content' );
			//const verticalTabsButtons = verticalTabsContainer.querySelector( '.wp-block-group__inner-container' );
			const verticalTabsButtons = Array.from(verticalTabsContainer.children).find(
				(child) => child.classList.contains('wp-block-group__inner-container')
			);

			// Set verticalTabsContainers height.
			let verticalTabsContentHeight = 0;
			verticalTabsContents.forEach( verticalTabsContent => {
				if ( verticalTabsContent.offsetHeight > verticalTabsContentHeight ) {
					verticalTabsContentHeight = verticalTabsContent.offsetHeight;
				}

				if ( window.innerWidth < 1024 ) {
					verticalTabsContent.style.top = ( verticalTabsButtons.offsetHeight + 20 ) + 'px';
				} else {
					verticalTabsContent.style.top = 0;
				}
			} );

			if ( window.innerWidth < 1024 ) {
				verticalTabsContentHeight += verticalTabsButtons.offsetHeight;
			}

			verticalTabsContainer.style.minHeight = verticalTabsContentHeight + 'px';

			// Animate the indicator.
			const referenceRect = verticalTabsContainer.getBoundingClientRect();
			const indicator = verticalTabsContainer.querySelector( '.tab-indicator' );
			const currentTab = verticalTabsContainer.querySelector( '.tab-button.active a' );
			const targetRect = currentTab.getBoundingClientRect();
			const verticalPosition = targetRect.top - referenceRect.top;
			indicator.style.top = ( verticalPosition - 10 ) + 'px';
		} );
	}

	// Set tab buttons click event handler.
	function onVerticalTabsButtonClick( e ) {
		e.preventDefault();

		const verticalTabsContentID = e.currentTarget.getAttribute( 'href' );
		const verticalTabsContent = document.querySelector( verticalTabsContentID );
		verticalTabsContent.style.visibility = 'visible';
		verticalTabsContent.style.opacity = 1;
	}
} );

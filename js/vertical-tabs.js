document.addEventListener( 'DOMContentLoaded', function() {
	const verticalTabsContainers = document.querySelectorAll( '.vertical-tabs' );
	let resizeTimeout;

	window.addEventListener( 'resize', function() {
		clearTimeout( resizeTimeout );
		resizeTimeout = setTimeout( setVerticalTabsContainersHeight, 200 );
	});

	setVerticalTabsContainersHeight();

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
				console.log('verticalPosition=', verticalPosition)
				indicator.style.top = verticalPosition + 'px';
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

	// Set verticalTabsContainers height.
	function setVerticalTabsContainersHeight() {
		verticalTabsContainers.forEach( verticalTabsContainer => {
			const verticalTabsContents = verticalTabsContainer.querySelectorAll( '.tab-content' );

			let verticalTabsContentHeight = 0;
			verticalTabsContents.forEach( verticalTabsContent => {
				if ( verticalTabsContent.offsetHeight > verticalTabsContentHeight ) {
					verticalTabsContentHeight = verticalTabsContent.offsetHeight;
				}
			} );

			const verticalTabsContainerStyle = window.getComputedStyle( verticalTabsContainer );
			console.log('verticalTabsContainerStyle.paddingTop=', verticalTabsContainerStyle.paddingTop)

			verticalTabsContainer.style.height = (
				parseFloat( verticalTabsContainerStyle.paddingBottom ) +
				verticalTabsContentHeight ) + 'px';
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

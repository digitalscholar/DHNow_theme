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
						verticalTabsContent.style.opacity = 0;
						verticalTabsContent.style.display = 'none';
					} );

					// Show the selected verticalTabsContent element.
					verticalTabsContentToShow.style.display = 'block';
					setTimeout( () => {
						verticalTabsContentToShow.style.opacity = '1';
					}, 0 );
				}

				// Assign active class.
				const currentActiveButton = verticalTabsContainer.querySelector( '.active' );
				if ( currentActiveButton && currentActiveButton !== event.currentTarget.closest( '.tab-button' ) ) {
					currentActiveButton.classList.remove( 'active' );
				}
				event.currentTarget.closest( '.tab-button' ).classList.add( 'active' );

				// Set verticalTabsContainers height.
				setVerticalTabsContainersHeight( verticalTabsContainer );

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
				verticalTabsContent.style.display = 'block';
				setTimeout( () => {
					verticalTabsContent.style.opacity = '1';
				}, 0 );
			}

			currentVerticalTabsContent++;
		} );

	} );

	onWindowResize();

	function onWindowResize() {
		verticalTabsContainers.forEach( verticalTabsContainer => {
			setVerticalTabsContainersHeight( verticalTabsContainer );

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
		verticalTabsContent.style.display = 'block';
		setTimeout( () => {
			verticalTabsContent.style.opacity = '1';
		}, 0 );
	}

	// Set verticalTabsContainers height.
	function setVerticalTabsContainersHeight( verticalTabsContainer ) {
		const activeLink = verticalTabsContainer.querySelector( '.active a' );
		const activeLinkAnchor = activeLink.href.split( '#' )[1];
		const verticalTabsContentActive = document.getElementById( activeLinkAnchor );
		const verticalTabsContents = verticalTabsContainer.querySelectorAll( '.tab-content' );
		const verticalTabsButtons = Array.from( verticalTabsContainer.children ).find(
			( child ) => child.classList.contains( 'wp-block-group__inner-container' )
		);

		verticalTabsContents.forEach( verticalTabsContent => {
			if ( window.innerWidth < 1024 ) {
				verticalTabsContent.style.top = ( verticalTabsButtons.offsetHeight + 20 ) + 'px';
			} else {
				verticalTabsContent.style.top = 0;
			}
		});

		let verticalTabsContentHeight = verticalTabsContentActive.offsetHeight;

		if ( window.innerWidth < 1024 ) {
			verticalTabsContentHeight += verticalTabsButtons.offsetHeight;
		}

		verticalTabsContainer.style.minHeight = verticalTabsContentHeight + 'px';
	}
} );

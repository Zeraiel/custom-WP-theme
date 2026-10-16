( function () {
	var nav = document.getElementById( 'site-navigation' );
	var toggle = nav ? nav.querySelector( '.menu-toggle' ) : null;

	if ( ! nav || ! toggle ) {
		return;
	}

	// Mark the menu as script-driven, so without JavaScript it stays visible.
	nav.classList.add( 'js-enabled' );

	function setOpen( isOpen ) {
		nav.classList.toggle( 'is-open', isOpen );
		toggle.setAttribute( 'aria-expanded', isOpen ? 'true' : 'false' );
	}

	toggle.addEventListener( 'click', function () {
		setOpen( ! nav.classList.contains( 'is-open' ) );
	} );

	// Escape closes the menu and returns focus to the button.
	nav.addEventListener( 'keydown', function ( event ) {
		if ( 'Escape' === event.key && nav.classList.contains( 'is-open' ) ) {
			setOpen( false );
			toggle.focus();
		}
	} );
}() );

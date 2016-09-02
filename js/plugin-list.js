(function($){
	$( ".toggle-plugin-global" ).on( "click", function() {
		var toggler = $( ".toggle-plugin-global" );
		var toggle_text = toggler.text();

		$( ".wsuwp-plugin-global" ).toggle();

		if ( 'Hide globally active plugins' === toggle_text ) {
			toggler.text( "Show globally active plugins" );
		} else {
			toggler.text( "Hide globally active plugins" );
		}

	} );

	$( ".toggle-plugin-single" ).on( "click", function() {
		var toggler = $( ".toggle-plugin-single" );
		var toggle_text = toggler.text();

		$( ".wsuwp-plugin-single" ).not( ".wsuwp-plugin-global" ).toggle();

		if ( 'Hide non-globally active plugins' === toggle_text ) {
			toggler.text( "Show non-globally active plugins" );
		} else {
			toggler.text( "Hide non-globally active plugins" );
		}

	} );

}(jQuery));

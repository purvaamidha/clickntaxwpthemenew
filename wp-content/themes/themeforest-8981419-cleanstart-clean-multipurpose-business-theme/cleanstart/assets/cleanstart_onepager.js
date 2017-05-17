/*
 * Smooth Scroller for One Page Settings
 **/
jQuery(function(){

	 jQuery(window).bind( 'hashchange', function(e) {
	 	console.log(parseInt(window.location.hash.replace("#", ""))); 
	 });

	var one_pager_speed = ( one_pager["one_pager_speed"] !== undefined ) ? parseInt(one_pager["one_pager_speed"],10) : 300;

	jQuery("#mainmenu ul li a[href^='#']").on('click', function(e) {

		e.preventDefault();  					// PREVENT DEFAULT ANCHOR CLICK BEHAVIOR
		var hash        = this.hash;  			// STORE HASH
		var hashElement = jQuery(this.hash);	// CACHE $.SELECTOR

	   if ( hashElement.length > 0 ){

		   jQuery('html, body').animate({
		       scrollTop: hashElement.offset().top - 100 
		     }, one_pager_speed, function(){

				/*** ADD HASH TO URL WHEN FINISHED [v1.3] | Thank you @LeaVerou! ***/
				if( history.pushState ) {
				    history.pushState( null, null, hash );
				}
		       // window.location.hash = hash; // OLD METHOD

		     });

	   }


	});

});


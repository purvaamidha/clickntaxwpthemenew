    /*!
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M                    (c) 2014
                        
Theme Name: CleanStart
THEME JS v.1.2
This file contains necessary Javascript for the theme to function properly.

*/

//=============== Plethora Helper Functions =========================================================

var plethoraUtils = plethoraUtils || {};

plethoraUtils.checkBool = function(val){
    return ({1:1,true:1,on:1,yes:1}[(((typeof val !=="number")?val:(val>0))+"").toLowerCase()])?true:false;
};

//===============Jquery to perform on DOM Ready=========================================================

jQuery(document).ready(function($){

"use strict";

    triangleSetup();

    // Sticky Header

    var header_height          = $('header.nav_header').outerHeight();
    var window_height          = $(window).outerHeight();
    var full_page_photo_height = $('.full_page_photo').outerHeight();
    var sticky_appear_height   = full_page_photo_height - 100;
    var sticky_nav             = $('.sticky_header header.nav_header');

        $(window).scroll(function () {
        if ($(this).scrollTop() > 4) {
          $('.sticky_header .full_page_photo .flexslider .flex-control-nav').removeClass("show").addClass("disappear");
          $('.sticky_header #big-video-control-container').removeClass("show").addClass("disappear");
          $('.sticky_header .full_page_photo .flexslider .flex-direction-nav').hide();
           
            } else {
                $('.full_page_photo .flexslider .flex-control-nav').removeClass("disappear").addClass("show");
                $('#big-video-control-container').removeClass("disappear").addClass("show");
                $('.full_page_photo .flexslider .flex-direction-nav').show();
            }
        });
        
        $(window).scroll(function () {
            if ($(this).scrollTop() > sticky_appear_height) {
                sticky_nav.addClass("stuck");
            } else {
                sticky_nav.removeClass("stuck");
            }
        });
        
    var window_top = $(window).scrollTop();

            if (window_top > full_page_photo_height) {
          sticky_nav.addClass("stuck");
            } else {
          sticky_nav.removeClass("stuck");
            }
       
       
    $('.sticky_header .main').css( "top", header_height - 1 );

    // UI to Top Button---------------------------------

    if ($.isFunction($().UItoTop)) {
        $().UItoTop({ easingType: 'easeOutQuart' });
    }

    // Refrain animations untill the photos load--------

    //Refrain the full_page_photo call_to_action elements from performing their animation untill the photo loads 
    jQuery(".full_page_photo .hgroup .hgroup_title").addClass("wait_for_photo_load").hide();
    jQuery(".full_page_photo .hgroup .hgroup_subtitle").addClass("wait_for_photo_load").hide();

    /*** ENABLE GOOGLEPLUS SHARE BUTTON [1.2] ***/
    if ( jQuery('.wpb_googleplus').length > 0 ) {
      (function () {
        var po = document.createElement('script');
            po.type = 'text/javascript';
            po.async = true;
            po.src = 'https://apis.google.com/js/platform.js';
        var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(po, s);
      })();
    }

});
//END==================Jquery to perform on DOM Ready=============================================================





//=====================Jquery to perform on Window Load===========================================================

jQuery(window).load(function(){
			
    "use strict";

    window.cleanstartSlider = function slideWindow(){

        var header_height = jQuery('header.nav_header').outerHeight();
        var full_page_photo_height = jQuery('.full_page_photo').outerHeight();             

        var videoContainer = document.getElementById("big-video-vid_html5_api");

        // Revolution Slider Support (added on Cleanstart Version 1.4.1)
        if (jQuery('.full_page_photo .rev_slider_wrapper').length) {
            var rev_slider_height = jQuery('.rev_slider_wrapper').outerHeight();
            jQuery('.sticky_header .main').css( "top", rev_slider_height );
            jQuery('.sticky_header .full_page_photo').attr( 'style' , 'height: ' + rev_slider_height + 'px !important' );
            var full_page_photo_height = rev_slider_height;
        }

        if ( videoContainer === null ){

            jQuery('.sticky_header .main').css( "top", full_page_photo_height );

        } 

        if (jQuery('.admin-bar').length) {
            var adminbar_height = jQuery('#wpadminbar').outerHeight();
            jQuery('.sticky_header .main').css( "top", full_page_photo_height - adminbar_height );
        }

        if (jQuery('.sticky_header #lang_sel_footer').length) {
            jQuery('.sticky_header #lang_sel_footer').css( "top", full_page_photo_height );
        }

        jQuery('.touch .sticky_header .overflow_wrapper').css( "padding-bottom", full_page_photo_height );
        jQuery('.flex-active-slide .container .carousel-caption').addClass('show');

        var window_top = jQuery(window).scrollTop();

        if (window_top < 4) {
            jQuery(".full_page_photo .flexslider .flex-control-nav").addClass("show");
            jQuery("#big-video-control-container").addClass("show");
                }       


        //Starting the full_page_photo call_to_action elements animations now that the photo is loaded   
        jQuery(".full_page_photo .hgroup .hgroup_title").removeClass("wait_for_photo_load").show();
        jQuery(".full_page_photo .hgroup .hgroup_subtitle").removeClass("wait_for_photo_load").show();   
        jQuery(".flexslider .carousel-caption.show").removeClass("wait_for_photo_load").show();

    };

    cleanstartSlider(); 

    // PARALLAX ------------------------------------------

       var $window = jQuery(window);
     
       jQuery('.parallax').each(function(){

         var $scroll = jQuery(this);
                         
          $window.scroll(function() {
            
            if($window.scrollTop() + $window.outerHeight() >= $scroll.offset().top) {
            
                var yPos = ($window.scrollTop() + $window.outerHeight() - $scroll.offset().top) / 10;        
                var coords = '50% '+ (100-yPos/1.2) + '%';
            
            }  

            $scroll.css({ backgroundPosition: coords });    

          }); // end window scroll
       });  // end section function

    //------WOW Reveal on scroll initialization only for no-touch devices------------------

    if (jQuery('.no-touch').length) {

        var wow = new WOW({
            animateClass: 'animated',
            offset:       100
        });
        wow.init();

    }

    //END---WOW-----------------------------------------

    	
    //------Lightbox with ALL its settings--------------

    var activityIndicatorOn = function()
    	{
    		jQuery( '<div id="imagelightbox-loading"><div></div></div>' ).appendTo( 'body' );
    	},
    	activityIndicatorOff = function()
    	{
    		jQuery( '#imagelightbox-loading' ).remove();
    	},

    	overlayOn = function()
    	{
    		jQuery( '<div id="imagelightbox-overlay"></div>' ).appendTo( 'body' );
    	},
    	overlayOff = function()
    	{
    		jQuery( '#imagelightbox-overlay' ).remove();
    	},

    	closeButtonOn = function( instance )
    	{
    		jQuery( '<a href="#" id="imagelightbox-close">Close</a>' ).appendTo( 'body' ).on( 'click', function(){ jQuery( this ).remove(); instance.quitImageLightbox(); return false; });
    	},
    	closeButtonOff = function()
    	{
    		jQuery( '#imagelightbox-close' ).remove();
    	},

    	captionOn = function()
    	{
            var description = jQuery( 'a[href="' + jQuery( '#imagelightbox' ).attr( 'src' ) + '"] img' ).attr( 'alt' ) || "";
    		if( description.length > 0 )
    			jQuery( '<div id="imagelightbox-caption">' + description + '</div>' ).appendTo( 'body' );
    	},

        // DISPLAY CAPTION ON SINGLE POST VIEW
        captionOnSingle = function()
        {
            var description = jQuery( 'a[href="' + jQuery( '#imagelightbox' ).attr( 'src' ) + '"]' ).attr( 'title' ) || "";
            if( description.length > 0 )
                jQuery( '<div id="imagelightbox-caption">' + description + '</div>' ).appendTo( 'body' );
        },

        // DISPLAY CAPTION ON GALLERY GRID CLASSIC MODE. CAPTION IS BASED ON ALT ATTRIBUTE.
        captionOnGallery = function()
        {
            var description = jQuery( 'a[href="' + jQuery( '#imagelightbox' ).attr( 'src' ) + '"]' ) || "";
            if ( description.attr('data-description') !== "undefined" && description.attr('data-description') !== "" ){
                description = description.attr('data-description');
            } else if ( description.attr('datas-caption') !== "undefined" && description.attr('datas-caption') !== "" ) {
                description = description.attr('data-caption');
            }
            if( description.length > 0 )
                jQuery( '<div id="imagelightbox-caption">' + description + '</div>' ).appendTo( 'body' );
        },

        captionOff = function()
        {
            jQuery( '#imagelightbox-caption' ).remove();
        };

        // ARROWS

        var arrowsOn = function( instance, selector )
        {
            if ( instance.count > 3 ){
                var $arrows = jQuery( '<button type="button" class="imagelightbox-arrow imagelightbox-arrow-left"></button><button type="button" class="imagelightbox-arrow imagelightbox-arrow-right"></button>' );
                    $arrows.appendTo( 'body' );

                $arrows.on( 'click touchend', function( e ){
                    e.preventDefault();
                    var $this   = jQuery( this ),
                        $target = jQuery( selector + '[href="' + jQuery( '#imagelightbox' ).attr( 'src' ) + '"]' ),
                        index   = $target.index( selector );

                    if( $this.hasClass( 'imagelightbox-arrow-left' ) )
                    {
                        index = index - 1;
                        if( !jQuery( selector ).eq( index ).length )
                            index = jQuery( selector ).length;
                    }
                    else
                    {
                        index = index + 1;
                        if( !jQuery( selector ).eq( index ).length )
                            index = 0;
                    }
                    instance.switchImageLightbox( index );
                    return false;
                });
            }
        },
        arrowsOff = function()
        {
            jQuery( '.imagelightbox-arrow' ).remove();
        };

    //	Init for Masonry Gallery
    if ( jQuery().imageLightbox ) {

        // ADDING LIGHTBOX FOR GALLERY GRID / CLASSIC "PORTFOLIO STRICT" & MASONRY
        var selectorGG = 'a[data-imagelightbox="gallery"]'; // ENABLE ARROWS
        var instanceGG = jQuery( 'a.lightbox_gallery' ).imageLightbox(
        {
            /* WITH ARROWS */
            onStart:        function() { arrowsOn( instanceGG, selectorGG ); overlayOn(); closeButtonOn( instanceGG ); }, 
            onEnd:          function() { arrowsOff(); overlayOff(); captionOff(); closeButtonOff(); activityIndicatorOff(); }, 
            onLoadEnd:      function() { jQuery( '.imagelightbox-arrow' ).css( 'display', 'block' ); captionOnGallery(); activityIndicatorOff(); },

            onLoadStart:    function() { captionOff(); activityIndicatorOn(); }
        });

        var selectorS = 'a[data-imagelightbox="gallery"]'; // ENABLE ARROWS
        var instanceS = jQuery( 'a.lightbox_single' ).imageLightbox(
        {
            /* WITH ARROWS */
            onStart:        function() { arrowsOn( instanceS, selectorS ); overlayOn(); closeButtonOn( instanceS ); },
            onEnd:          function() { arrowsOff(); overlayOff(); captionOff(); closeButtonOff(); activityIndicatorOff(); },
            onLoadEnd:      function() { jQuery( '.imagelightbox-arrow' ).css( 'display', 'block' ); captionOnSingle(); activityIndicatorOff(); },

            onLoadStart:    function() { captionOff(); activityIndicatorOn(); }
        });

    }
    //END---Lightbox with ALL its settings--------------



});
//END=============================Jquery to perform on Window Load=======================================


//================================Jquery to perform on Window Resize=====================================

jQuery(window).resize(function() {
             
    "use strict";  

    cleanstartSlider();



    // SETUP TRIANGLES PLACING
    waitForFinalEvent(function(){
      triangleSetup();
    }, 50, "setup triangles placing");

});

//END=============================Jquery to perform on Window Resize=====================================


//------Text Rotator flip animations unfortunately don't work well on Safari / IE so we replace flip-up animation with the default dissolve animation on those browsers -------------------------------------

(function(){
    
    "use strict";   

    var animationSettting    = "flipUp"; // ANIMATION TYPE FOR THE ROTATION EFFECT: dissolve, fade, flip, flipUp, flipCube, flipCubeUp and spin.
    var textRotatorSpeed     = 6000;      // HOW MANY MILLISECONDS UNTIL THE NEXT WORD SHOW.
    var textRotatorSeparator = ",";      // DEFINE A NEW SEPARATOR HERE: |, &, * etc.

    // SET TEXT ROTATOR SPEED FROM SHORTCODE PARAMETER
    if ( typeof textRotatorOptions !== "undefined" ){
        textRotatorSpeed = ( textRotatorOptions.speed !== undefined ) ? textRotatorOptions.speed : textRotatorSpeed;
    }

    if ( navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1 ) {
        animationSettting = "dissolve";
        jQuery(".rotate").textrotator({
              animation: animationSettting, 
              separator: textRotatorSeparator, 
              speed: textRotatorSpeed 
            });
    } else {
        if ( jQuery().textrotator ){
            // IE doesn't play well with 3d transforms...
            if ( navigator.appName == 'Microsoft Internet Explorer'
                || window.navigator.userAgent.indexOf("MSIE ") > 0
                || !!navigator.userAgent.match(/Trident.*rv\:11\./)
                || !!/rv:11.0/i.test(navigator.userAgent)
            ) {
                animationSettting = "dissolve";
            } else {
                animationSettting = "flipUp";
            }
        // Nope, it's another browser =(
            jQuery(".rotate").textrotator({
              animation: animationSettting, 
              separator: textRotatorSeparator, 
              speed: textRotatorSpeed 
            });
        }
    }

}());

//END---Text Rotator-------------------------------------

//------ OSX TOUCHPAD FIX: Prevent horizontal scrolling using the trackpad. Added: v.1.0.1 ------

function triangleSetup(){

    "use strict";   

    var squareRight = document.querySelectorAll(".square-right");
    if ( squareRight.length > 0 ){
        var bodyWidth = jQuery(window).outerWidth();
        var containerWidth = jQuery(".main .container").outerWidth();
        var squareWidth = (bodyWidth - (containerWidth + 200))/2;
            squareWidth = squareWidth <= 0 ? 0 : squareWidth;
        var squareRightTriangles = document.querySelectorAll(".main .triangle-up-right");

        if ( (containerWidth + 200) > bodyWidth ){
            var squareTriangleWidth = (bodyWidth - containerWidth)/2;
            [].forEach.call(squareRightTriangles,function(el,index){
                    el.setAttribute('style', 
                        "width: " + (squareTriangleWidth) + "px;" + 
                        "right: " + "-" + (squareTriangleWidth) + "px; "
                    );
            });
            [].forEach.call(squareRight,function(el){
            el.style.width  = "0px";
            el.style.right  = "0px";
            });
        } else {
            [].forEach.call(squareRightTriangles,function(el,index){
                    el.setAttribute('style', 
                        "width: 100px;" + 
                        "right: -100px;"
                    );
            }); 
            [].forEach.call(squareRight,function(el){
            el.style.width  = squareWidth + "px";
            el.style.right  = "-" + ( squareWidth + 100 ) + "px";
            });           
        }        
    }

}

var waitForFinalEvent = (function () {
  var timers = {};
  return function (callback, ms, uniqueId) {
    if (!uniqueId) {
      uniqueId = "Don't call this twice without a uniqueId";
    }
    if (timers[uniqueId]) {
      clearTimeout (timers[uniqueId]);
    }
    timers[uniqueId] = setTimeout(callback, ms);
  };
})();


//END--- OSX TOUCHPAD FIX: Prevent horizontal scrolling using the trackpad. Added: v.1.0.1 ------
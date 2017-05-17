/*!
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M 				     (c) 2014
                        
Theme Name: CleanStart
Version: 1.0.2
This file contains necessary Javascript for the theme to function properly.

*/

//===============Jquery to perform on DOM Ready=========================================================

jQuery(document).ready(function() {
			  
	"use strict";

	triangleSetup();

	jQuery('.sitemap_toggle').click(function(){ 
			
		jQuery('.sitemap').toggle();

	});
	
	var $htmlBody;

	jQuery('.sitemap a').click(function(){ 
			
		jQuery('.sitemap').toggle();
		var href = $.attr(this, 'href');
        $htmlBody = $htmlBody || jQuery('html, body');
        $htmlBody.animate({
            scrollTop: jQuery(href).offset().top
        }, 500, function () {
            window.location.hash = href;
	  window.location.hash = href;
        });
        return false;

	});
	
//Smooth scrolling on documentation page

jQuery('.bs-docs-sidenav a').click(function(e) {
				    
    jQuery('div.bs-docs-section h2').css('position' , '');
    jQuery('div.bs-docs-section').css('padding-top' , '');
    
    var href = $.attr(this, 'href');
    jQuery('html, body').animate({
        scrollTop: jQuery(href).offset().top
    }, 500, function () {
        window.location.hash = href;
    });
    return false;
});
        
        
// UI to Top Button---------------------------------

    jQuery().UItoTop({ easingType: 'easeOutQuart' });

//setupStickyHeaders();


function setupStickyHeaders() {
    //get initial offset positions of the headers
    var headers = [];
    $.each($('div.bs-docs-section h2'), function(i, headerDiv) {
        var header = $(headerDiv);
        headers.push({element:header, orgOffset: header.offset().top});
    });
    
    //if no headers on this page then stop
    if(headers.length == 0)
        return;

    //get the original css for the 
    var orgCSS = {width:headers[0].element.css('width'), position:headers[0].element.css('position'), height:headers[0].element.css('height')};

    //handle scrolling
    $(window).scroll(function(){
        var scrollTop = $(this).scrollTop();


        //unstick headers
        for(i in headers) {
            var header = headers[i];
            if(!isStuck(header)) break;

            if(scrollTop < header.orgOffset) {
                header.element.css('position', '').css('top','').css('background-color' , 'transparent');
	      header.element.parent().css('padding-top' , '0px');
                if(i > 0)
                    headers[i-1].element.css('z-index', 1).css('opacity' , 1);
            }
        }

        //stick headers
        for(i in headers) {
            var header = headers[i];
            //make sure any stuck headers are stuck in the right place(fast scrolling sometimes messes this up)
            if(isStuck(header))
                header.element.css('top','0px')

            //skip this header if its bellow the top of the window
            if(scrollTop < header.orgOffset - 30)
                break;

            //if the header is already stuck then ignore it            
            if(!isStuck(header)) {
                if(scrollTop > header.orgOffset) {
                    //stick the header
                    header.element.css('width', orgCSS.width).css('position', 'fixed').css('top','0px').css('background-color' , '#EFEFEF');
		header.element.parent().css('padding-top' , '75px');
                    if(i > 0)
                        headers[i-1].element.css('z-index', -1).css('opacity' , 0);
                }else if(i > 0)
                    //hide the element since it should be off the screen now
                    headers[i-1].element.css('top', header.orgOffset - scrollTop - 65);
            }
        }
    });
}

function isStuck(header) {return header.element.css('position') === 'fixed'}
    
});
//END==================Jquery to perform on DOM Ready=============================================================





//=====================Jquery to perform on Window Load===========================================================
 
jQuery(window).load(function(){ 
			
"use strict";			

  


});
//END=============================Jquery to perform on Window Load=======================================


//================================Jquery to perform on Window Resize=====================================

jQuery(window).resize(function() {
			 
    "use strict";			 

   
    // SETUP TRIANGLES PLACING
    waitForFinalEvent(function(){
      triangleSetup();
    }, 50, "setup triangles placing");

});

//END=============================Jquery to perform on Window Resize=====================================






//------ OSX TOUCHPAD FIX: Prevent horizontal scrolling using the trackpad. Added: v.1.0.1 ------

function triangleSetup(){

    var squareRight = document.querySelectorAll(".square-right");
    if ( squareRight.length > 0 ){
        var bodyWidth = jQuery(window).outerWidth();
        var containerWidth = jQuery(".main > .container").outerWidth();
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
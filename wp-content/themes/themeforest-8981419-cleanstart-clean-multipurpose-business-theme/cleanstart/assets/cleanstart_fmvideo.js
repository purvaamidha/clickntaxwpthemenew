// BACKGROUND VIDEO INIT

jQuery(function($) {	   
	      
	'use strict';	

    var video_options = $.parseJSON(plethora_video.video_options);

    var BV = new $.BigVideo({

		useFlashForFirefox: false,
		controls: 			video_options['video_controls'],
		doLoop: 			video_options['video_loop'],
		forceAutoplay: 		video_options['video_autoplay'],
    	ambient: 			!video_options['video_sound'],
    	defaultVolume: 		(!video_options['video_sound'])? 0 : 0.8	

    });


   	BV.init();

	var videoContainer = document.getElementById("big-video-vid_html5_api");
    	videoContainer.addEventListener("playing", function(){
    		console.log("playing...");
	  		var interval = setInterval(function(){
	  			if ( BV.getPlayer().currentTime() > 0.5 ){
					// jQuery('.sticky_header .main').css( "top", "580px" );
					jQuery('.sticky_header .main').css( "top", jQuery('.full_page_photo').outerHeight() )
					clearInterval(interval);
	  			}
	  		}, 75 );

	    });

   	// PARSE VIDEO URI [FIXING CROSS BROWSER VIDEO SUPPORT]
	var videoURI    	= $('#video').attr('data-video');
		videoURI        = videoURI.split("/");
	var videofile   	= videoURI[videoURI.length-1].split(".")[0];
		videoURI.length = videoURI.length-1;
		videoURI       	= videoURI.join("/") + "/" + videofile;

	// 1.2: Using Modernizr.touchevents instead of Modernizr.touch because Chrome 
	// includes Desktop touch enabled devices
    if ( Modernizr.touch ) {	
	    BV.show($('#video').attr('data-imagefallback'));
	} else {
	    BV.show([
	    	// Safari does not fallback correctly for webm, so include mp4 first
	        { type: "video/mp4",  src: videoURI + ".mp4" },
	        { type: "video/webm", src: videoURI + ".webm" }
	        ,{ type: "video/ogg", src: videoURI + ".ogg" } 
	    ]);
	}

	// To initially mute the volume
	/*
	if ( video_options['video_sound'] === false ) { 
	 	BV.getPlayer().volume(0); // .loop(video_options['video_loop']);
	 	jQuery('.mute').html( '<i class="fa fa-volume-off"></i>' );
	} else { 
	 	BV.getPlayer().volume(1); // .loop(video_options['video_loop']);
	 	jQuery('.mute').html( '<i class="fa fa-volume-up"></i>' );
	}
	*/

	jQuery.fn.toggleClick=function(){
		var functions=arguments;
		return this.click(function(){
			var iteration=$(this).data('iteration')||0
			//console.log(iteration)
			functions[iteration].apply(this,arguments)
			iteration= (iteration+1) %functions.length
			$(this).data('iteration',iteration)
		})
	}

	// MUTE BUTTON

	$(function(){
		$('#big-video-control-sound').toggleClick(function(){
			BV.getPlayer().volume(1);
			$(this).find("i").addClass("fa-volume-up").removeClass("fa-volume-off"); 
		},function(){
			BV.getPlayer().volume(0);
			$(this).find("i").addClass("fa-volume-off").removeClass("fa-volume-up"); 
		});
	})   
    
}(jQuery));
jQuery(document).ready(function($){

	"use strict";
 
    if( typeof jQuery.wp === 'object' && typeof jQuery.wp.wpColorPicker === 'function' ){

	    jQuery('#cleanstart_settings_full_width_featured_image_title_color').wpColorPicker({ defaultColor: "rgb(255,0,0)" });
	    jQuery('#cleanstart_settings_full_width_featured_image_subtitle_color').wpColorPicker();

    }

});
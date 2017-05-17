(function(){
	
"use strict";

	// GET OPTIONS
    var map_options = jQuery.parseJSON(plethora_map.map_options);
	// ON WINDOW LOAD CREATE GOOGLE MAP
    google.maps.event.addDomListener(window, 'load', init);
    function init() {

        // The latitude and longitude to center the map (always required). You can find it easily at http://universimmedia.pagesperso-orange.fr/geo/loc.htm
        var myLatlng = new google.maps.LatLng( Number(map_options['map_lat']), Number(map_options['map_lng']) ); // London
        var myMapType = ( map_options['map_type'] === 'ROADMAP' )? google.maps.MapTypeId.ROADMAP : google.maps.MapTypeId.SATELLITE;
        // BASIC MAP OPTIONS. FOR MORE: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
        var mapOptions = {
            disableDefaultUI: ( map_options['map_controls'] === 'true' )? false : true,
            zoom: parseInt(map_options['map_zoom'],10), // How zoomed in you want the map to start at (always required)
            scrollwheel: false,                         // Disable scrollwheel zooming on the map                  
            center: myLatlng,
            mapTypeId: myMapType,
            // MAP STYLING. FOR MORE STYLES CHECK OUT: Snazzy Maps
            // styles: [{'featureType':'water','stylers':[{'visibility':'on'},{'color':'#428BCA'}]},{'featureType':'landscape','stylers':[{'color':'#f2e5d4'}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'color':'#c5c6c6'}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'color':'#e4d7c6'}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#fbfaf7'}]},{'featureType':'poi.park','elementType':'geometry','stylers':[{'color':'#c5dac6'}]},{'featureType':'administrative','stylers':[{'visibility':'on'},{'lightness':33}]},{'featureType':'road'},{'featureType':'poi.park','elementType':'labels','stylers':[{'visibility':'on'},{'lightness':20}]},{},{'featureType':'road','stylers':[{'lightness':20}]}]
            styles: ( map_options['map_snazzy'] )? map_options['map_snazzy'] : [{'featureType':'water','stylers':[{'visibility':'on'},{'color':'#428BCA'}]},{'featureType':'landscape','stylers':[{'color':'#f2e5d4'}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'color':'#c5c6c6'}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'color':'#e4d7c6'}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#fbfaf7'}]},{'featureType':'poi.park','elementType':'geometry','stylers':[{'color':'#c5dac6'}]},{'featureType':'administrative','stylers':[{'visibility':'on'},{'lightness':33}]},{'featureType':'road'},{'featureType':'poi.park','elementType':'labels','stylers':[{'visibility':'on'},{'lightness':20}]},{},{'featureType':'road','stylers':[{'lightness':20}]}]
        };

        // GET DIV WITH ID map THAT WILL HOLD OUR MAP
        var mapElement = document.getElementById('map');
  
        // CREATE MAP 
        var map = new google.maps.Map(mapElement, mapOptions);
        var panoramaOptions = {
            position: myLatlng,
        };

        var panorama = new google.maps.StreetViewPanorama(mapElement, panoramaOptions);
        map.setStreetView(panorama);
  
        if ( map_options['map_mark'] == 'true') {
            // MAP MARKER
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: 'We are right here!'
            });
        }
    }
}());
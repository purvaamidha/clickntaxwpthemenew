//==================== GOOGLE MAPS ===========================================

(function(globals){

  "use strict";

  var themeConfig = globals.themeConfig || {};

  // themeConfig["GOOGLE_MAPS"] = { REQUIRED SETTINGS }

  var map_options = jQuery.parseJSON( plethora_map.map_options );   // WP INTEGRATION

    themeConfig["GOOGLE_MAPS"] = 
    {
      maps : [{
        id                    : "map",
        lat                   : Number(map_options['map_lat']) || 51.50852,
        lon                   : Number(map_options['map_lon']) || 0.1254,
        type                  : map_options['map_type'],                             // "SATELLITE", ROADMAP", "HYBRID", "TERRAIN"
        type_switch           : plethoraUtils.checkBool(map_options["map_type_switch"]),
        type_switch_style     : map_options["map_type_switch_style"],
        type_switch_position  : map_options["map_type_switch_position"],
        pan_control           : plethoraUtils.checkBool(map_options["map_pan_control"]),
        pan_control_position  : map_options["map_pan_control_position"],
        zoom                  : parseInt(map_options['map_zoom'],10),
        zoom_control          : plethoraUtils.checkBool(map_options["map_zoom_control"]),
        zoom_control_style    : map_options["map_zoom_control_style"],
        zoom_control_position : map_options["map_zoom_control_position"],
        scrollWheel           : false,
        disableDefaultUI      : ( map_options['map_controls'] === 'true' )? false : true,
        marker                : plethoraUtils.checkBool(map_options['map_mark']),       
        infoWindow            : map_options['info_window'],
        draggable             : false,
        markerImageSrc        : map_options["map_icon"].url || "",  
        markerTitle           : map_options["map_title"],
        markerImageWidth      : parseInt(map_options["map_icon"].width,10),
        markerImageHeight     : parseInt(map_options["map_icon"].height,10),
        markerAnchorX         : parseInt(map_options["map_icon_x"],10) || 0,
        markerAnchorY         : parseInt(map_options["map_icon_y"],10) || 0,
        styles                : ( map_options['map_snazzy'] )? map_options['map_snazzy'] : [{'featureType':'water','stylers':[{'visibility':'on'},{'color':'#428BCA'}]},{'featureType':'landscape','stylers':[{'color':'#f2e5d4'}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'color':'#c5c6c6'}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'color':'#e4d7c6'}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#fbfaf7'}]},{'featureType':'poi.park','elementType':'geometry','stylers':[{'color':'#c5dac6'}]},{'featureType':'administrative','stylers':[{'visibility':'on'},{'lightness':33}]},{'featureType':'road'},{'featureType':'poi.park','elementType':'labels','stylers':[{'visibility':'on'},{'lightness':20}]},{},{'featureType':'road','stylers':[{'lightness':20}]}],
        streetView            : plethoraUtils.checkBool(map_options['map_streetview']),
        streetView_position   : map_options['map_streetview_position'],
        scale_control         : plethoraUtils.checkBool(map_options['map_scale_control'])
      }]
    };

    function mapsInit() {

      themeConfig["GOOGLE_MAPS"].maps.forEach(function(map){

        var mapElement = document.getElementById( map.id );

        if ( mapElement !== null ){

          var myLatlng   = new google.maps.LatLng( map.lat, map.lon );       
          var mapOptions = {
            zoom                     : map.zoom,
            scrollwheel              : map.scrollWheel,                    
            disableDefaultUI         : map.disableDefaultUI,
            center                   : myLatlng,
            mapTypeId                : google.maps.MapTypeId[map.type],
            styles                   : map.styles,
            mapTypeControl           : map.type_switch,            
            mapTypeControlOptions    : {
              style                    : google.maps.MapTypeControlStyle[map.type_switch_style],   
              position                 : google.maps.ControlPosition[map.type_switch_position]
            },
            panControl               : map.pan_control,
            panControlOptions        : {
              position                 : google.maps.ControlPosition[map.pan_control_position]  
            },
            zoomControl              : map.zoom_control,
            zoomControlOptions       : {
              style                    : google.maps.ZoomControlStyle[map.zoom_control_style],                
              position                 : google.maps.ControlPosition[map.zoom_control_position]
            },
            scaleControl             : map.scale_control,  
            streetViewControlOptions : {
              position                 : google.maps.ControlPosition[map.streetView_position]
            }
          };

          /* DISABLE MAP SCROLLING / ENABLE UI ON MOBILE DEVICES */
          if ( window.innerWidth <= 990 ) {  
            mapOptions.draggable        = false;
            mapOptions.disableDefaultUI = false;
          }

          var gmap        = new google.maps.Map( mapElement, mapOptions );

          /*----[ STREETVIEW ]------------------------------------*/

          if ( map.streetView ) {
     
            var panorama = new google.maps.StreetViewPanorama( mapElement, { position: myLatlng } );
            gmap.setStreetView(panorama);

          }

          /*------------------------------------[ STREETVIEW ]----*/

          /*----[ MAP MARKER ]------------------------------------*/

          if ( map.marker ){

            var image = "";

            if ( map.markerImageSrc !== "" ){
              var image = {
                url    : map.markerImageSrc,
                origin : new google.maps.Point(0,0),
                size   : new google.maps.Size( map.markerImageWidth, map.markerImageHeight ),
                anchor : new google.maps.Point( map.markerAnchorX, map.markerAnchorY )
              };
            } 

            var marker     = new google.maps.Marker({
              position : myLatlng,
              map      : gmap,
              icon     : image,
              draggable: map.draggable,
              title    : map.markerTitle
            });

          }

          /*------------------------------------[ MAP MARKER ]----*/

          /*----[ INFO WINDOWS ]----------------------------------*/

          if ( map.infoWindow !== "" ){

            var infowindow = new google.maps.InfoWindow({ content: map.infoWindow });          

            google.maps.event.addListener( marker, 'click', function(){ infowindow.open( gmap, marker ); });

          }

          /*----------------------------------[ INFO WINDOWS ]----*/

        }

      });

    }

    if ( 
      typeof google !== "undefined" && google.maps 
      && ( typeof themeConfig["GOOGLE_MAPS"] !== "undefined" )
      && ( themeConfig["GOOGLE_MAPS"].maps.length > 0 )
    ) google.maps.event.addDomListener( window, 'load', mapsInit );

}(this));

//END================= GOOGLE MAPS ===========================================
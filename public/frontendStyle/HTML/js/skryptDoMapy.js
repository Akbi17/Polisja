var mapMarkers = [{
    address: "54 East 41st Street, New York, NY 10017",
    html: "<strong>New York Office</strong><br>New York, NY 10017",
    icon: {
        image: "frontendStyle/HTML/img/pin-logo.png",
        iconsize: [154, 65],
        iconanchor: [77, 65]
        }}];

    // Map Initial Location
    var initLatitude = 40.75213;
    var initLongitude = -73.98200;

    // Map Extended Settings
    var mapSettings = {
        controls: {
            panControl: true,
            zoomControl: true,
            mapTypeControl: true,
            scaleControl: true,
            streetViewControl: true,
            overviewMapControl: true
        },
        scrollwheel: false,
        markers: mapMarkers,
        latitude: initLatitude,
        longitude: initLongitude,
        zoom: 17
    };

    var map = $("#googlemaps").gMap(mapSettings),
        mapRef = $("#googlemaps").data('gMap.reference');

    // Map Center At
    var mapCenterAt = function(options, e) {
        e.preventDefault();
        $("#googlemaps").gMap("centerAt", options);
    }

    // Create an array of styles.
    var mapColor = "#E36159";

    var styles = [{
        stylers: [{
            hue: mapColor
        }]
    }, {
        featureType: "road",
        elementType: "geometry",
        stylers: [{
            lightness: 0
        }, {
            visibility: "simplified"
        }]
    }, {
        featureType: "road",
        elementType: "labels",
        stylers: [{
            visibility: "off"
        }]
    }];

    var styledMap = new google.maps.StyledMapType(styles, {
        name: "Styled Map"
    });

    mapRef.mapTypes.set('map_style', styledMap);
    mapRef.setMapTypeId('map_style');

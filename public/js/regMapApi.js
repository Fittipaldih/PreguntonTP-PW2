function loadMap() {
    var mapOptions = {
        center: new google.maps.LatLng(-34.6686986, -58.5614947),
        zoom: 8,
        mapTypeControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        styles: [
            {
                featureType: "all",
                elementType: "labels.text.fill",
                stylers: [{ saturation: -100 }, { color: "#ffffff" }],
            },
            {
                featureType: "all",
                elementType: "labels.text.stroke",
                stylers: [{ visibility: "off" }],
            },
            {
                featureType: "all",
                elementType: "labels.icon",
                stylers: [{ color: "#0000ff" }],
            },
            {
                featureType: "landscape",
                elementType: "geometry",
                stylers: [{ color: "#212121" }],
            },
            {
                featureType: "poi",
                elementType: "geometry",
                stylers: [{ color: "#212121" }],
            },
            {
                featureType: "poi",
                elementType: "labels",
                stylers: [{ visibility: "off" }],
            },
            {
                featureType: "road",
                elementType: "geometry",
                stylers: [{ color: "#878787" }],
            },
            {
                featureType: "road",
                elementType: "labels",
                stylers: [{ visibility: "off" }],
            },
            {
                featureType: "transit",
                elementType: "geometry",
                stylers: [{ color: "#212121" }],
            },
            {
                featureType: "transit.station",
                elementType: "labels",
                stylers: [{ visibility: "off" }],
            },
            {
                featureType: "water",
                elementType: "geometry",
                stylers: [{ color: "#3B67A1" }],
            },
            {
                featureType: "water",
                elementType: "labels",
                stylers: [{ visibility: "off" }],
            },
        ],
    };

    var map = new google.maps.Map(document.getElementById("mapReg"), mapOptions);

    var iconSize = new google.maps.Size(80, 80);
    var icon = {
        url: '/public/imagenes/logo3.png',
        scaledSize: iconSize
    };

    var marker = new google.maps.Marker({
        map: map,
        animation: google.maps.Animation.BOUNCE,
        icon: icon
    });

    google.maps.event.addListener(map, "click", function (event) {
        var lat = event.latLng.lat();
        var lng = event.latLng.lng();
        marker.setPosition(new google.maps.LatLng(lat, lng));
        document.getElementById("lat").value = lat;
        document.getElementById("lng").value = lng;
    });
}

function loadMap() {
    var lat = document.getElementById('lati').value;
    var lon = document.getElementById('long').value;
    var userNameElement = document.getElementById('userName');
    var userName = userNameElement.textContent; // o userNameElement.innerText

    console.log('Latitud:', lat);
    console.log('Longitud:', lon);

    var mapOptions = {
        center:new google.maps.LatLng(lat,lon),
        zoom:11,
        zoomControl: false,
        mapTypeControl:false,
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
                featureType: "road",
                elementType: "geometry",
                stylers: [{ color: "#A1A1A1" }],
            },
            {
                featureType: "transit",
                elementType: "geometry",
                stylers: [{ color: "#212121" }],
            },
            {
                featureType: "water",
                elementType: "geometry",
                stylers: [{ color: "#3B67A1" }],
            },
        ],
    };

    var map = new google.maps.Map(document.getElementById("mapUser"),mapOptions);

    var iconSize = new google.maps.Size(80, 80);
    var icon = {
        url: '/public/imagenes/logo3.png',
        scaledSize: iconSize
    };

    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(lat, lon),
        map: map,
        animation: google.maps.Animation.BOUNCE,
        icon: icon
    });

    var info = new google.maps.InfoWindow({
        content: '<p>' + userName + ' esta en la zona!</p>'
    });

    google.maps.event.addListener(marker, 'click', function() {
        info.open(map,marker);
    });
}
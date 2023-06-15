function loadMap() {
    var mapOptions = {
        center: new google.maps.LatLng(-34.6686986, -58.5614947),
        zoom: 8,
        mapTypeControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById("mapReg"), mapOptions);

    var marker = new google.maps.Marker({
        map: map,
        icon: '/public/imagenes/logoMapa.png',
        animation: google.maps.Animation.BOUNCE,
    });

    google.maps.event.addListener(map, "click", function (event) {
        var lat = event.latLng.lat();
        var lng = event.latLng.lng();
        marker.setPosition(new google.maps.LatLng(lat, lng));
        document.getElementById("lat").value = lat;
        document.getElementById("lng").value = lng;
    });
}
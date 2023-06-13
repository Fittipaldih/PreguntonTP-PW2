function loadMap() {

    var mapOptions = {
        center:new google.maps.LatLng(-34.6686986,-58.5614947),
        zoom:11,
        zoomControl: false,
        mapTypeControl:false,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById("mapa"),mapOptions);

    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(-34.6686986,-58.5614947),
        map: map,
       // icon:'/public/imagenes/logoMapa.png',
        animation:google.maps.Animation.BOUNCE
    });

    var info = new google.maps.InfoWindow({
        content:"Florencio Varela 1903, San Justo, Buenos Aires, Argentina"
    });

    google.maps.event.addListener(marker, 'click', function() {
        info.open(map,marker);
    });
}
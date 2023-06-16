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
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById("mapUser"),mapOptions);

    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(lat,lon),
        map: map,
        animation:google.maps.Animation.BOUNCE
    });

    var info = new google.maps.InfoWindow({
        content: '<p>' + userName + ' esta en la zona!</p>'
    });

    google.maps.event.addListener(marker, 'click', function() {
        info.open(map,marker);
    });
}
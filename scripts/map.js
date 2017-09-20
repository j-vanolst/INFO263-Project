function initMap() {
    var auckland = {lat: -36.849, lng: 174.763};
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: auckland
    });
};

function addMarker(latitude, longitude) {
    var coordinates = {lat: latitude, lng: longitude};
    var marker = new google.maps.Marker({
        position: coordinates,
        map: map
    });
};
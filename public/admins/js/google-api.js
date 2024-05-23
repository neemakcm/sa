function initMap() {
    var lat;
    var input1 = document.getElementById('location');
    autocomplete = new google.maps.places.Autocomplete(input1);
    var searchBox1 = new google.maps.places.SearchBox(autocomplete);

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();
        lat = document.getElementById('lat').value = place.geometry.location.lat();
        document.getElementById('lng').value = place.geometry.location.lng();
    });
}
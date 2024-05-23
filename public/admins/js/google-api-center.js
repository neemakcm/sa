var drop_lat = $('#lat').val();
var drop_lng = $('#lng').val();
var center_id = $('#center_ids').val();
var latMap = parseFloat(drop_lat);
var lngMap = parseFloat(drop_lng);
var marker_color = "d61b18";
var marker_text_color = "FFFFFF";
var haightAshbury = {
    lat: latMap,
    lng: lngMap
};
var map;
var map_popup = 0;
var markers = [];
var current_lat = 0;
var current_long = 0;
var bounds;
if ("geolocation" in navigator) { //check geolocation available 
    //try to get user current location using getCurrentPosition() method
    navigator.geolocation.getCurrentPosition(function(position) {
        current_lat = position.coords.latitude;
        current_long = position.coords.longitude;
    });
} else {
    console.log("Browser doesn't support geolocation!");
}

function initMap() {
    bounds = new google.maps.LatLngBounds();
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        // center: haightAshbury,
    });
    var loc = new google.maps.LatLng(parseFloat(latMap), parseFloat(lngMap));
    getServiceCenter(center_id);
}

function addMarker(location, title, character) {
    map.panTo(location);
    map.setZoom(10);

    var marker = new google.maps.Marker({
        position: location,
        map,
        icon: "https://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=" + character + "|" + marker_color + "|" + marker_text_color,
        title: "",
    });
    bounds.extend(marker.position);
    // bounds.extend(marker.getPosition());
    var infowindow = new google.maps.InfoWindow();
    google.maps.event.addListener(marker, 'mouseover', function() {
        infowindow.setContent(title);
        infowindow.open(map, this);
        map_popup = 0;
    });
    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(title);
        infowindow.open(map, this);
        if (map_popup == 1) {
            map_popup = 0;
        } else {
            map_popup = 1;
        }
    });
    google.maps.event.addListener(marker, 'mouseout', function() {
        if (map_popup == 0) {
            infowindow.close(map, this);
        }
    });
    markers.push(marker);
}

function centerDetail(id) {
    getServiceCenter(id);
}

function getServiceCenter(store_id) {
    var id = store_id;

    var title;

    $.ajax({
        type: 'get',
        url: base_url + "/service/map-content",
        data: { id: id },
        success: function(res) {
            result = $.parseJSON(res);

            if ("geolocation" in navigator) { //check geolocation available 
                //try to get user current location using getCurrentPosition() method
                navigator.geolocation.getCurrentPosition(function(position) {
                    current_lat = position.coords.latitude;
                    current_long = position.coords.longitude;
                });
            } else {
                console.log("Browser doesn't support geolocation!");
            }

            clearOverlays();
            var start_letter_code = 1;

            $.each(result, function(index, res) {
                if (current_lat != 0 && current_long != 0) {
                    var p1 = new google.maps.LatLng(current_lat, current_long);
                    var p2 = new google.maps.LatLng(res.latitude, res.longitude);

                    distance = (google.maps.geometry.spherical.computeDistanceBetween(p1, p2) / 1000).toFixed(2);
                } else
                    distance = 0;

                $('#location_' + res.id).html(distance + ' km');

                title = '<div class="result-body__content store_wrapper"  onClick="centerDetail(' + res.id + ')">' +
                    '<div class="media">' +
                    '<div class="item-icon">' +
                    '</div>' +
                    '<div class="media-body">' +
                    '<ul class="mb-3">' +
                    '<li>' +
                    '<div class="d-flex jusitfy-content-between flex-wrap">' +
                    '<h5 class="item-title flex-grow-1 pr-2">' + res.title + '</h5>' +
                    '<div class="distance">' + distance + ' km</div>' +
                    '</div>' +
                    '</li>' +
                    '</ul>' +
                    '<div class="item-content mb-2">' +
                    '<ul class="mb-3">' +
                    '<li>' + res.description +
                    ' </li>' +
                    '</ul>' +
                    ' </div>' +
                    '<ul class="mb-3">' +
                    ' <li>' +
                    '<span><img src="' + base_url + '/front/images/icons/icon-call.svg" class="img-fluid" alt="call">' +
                    '</span><a href="tel:' + res.mobile + '">' + res.mobile + '</a>' +
                    '</li>' +
                    '<li>' +
                    ' <span><img src="' + base_url + '/front/images/icons/icon-mail.svg" class="img-fluid" alt="call">' +
                    '</span><a href="mailto:' + res.email + '">' + res.email + '</a>' +
                    '</li>' +
                    '</ul>' +
                    '<ul class="mb-3">' +
                    '<li class="title-small">Open Hour</li>' +
                    '<li>' + res.open_hour + '</li>' +
                    '</ul>' +
                    '<ul class="mb-3">' +
                    '<li class="title-small"><a target="_blank" href="https://maps.google.com/?q=' + res.latitude + ',' + res.longitude + '"><img src="' + base_url + '/front/images/icons/icon-direction.svg" class="img-fluid" >&nbsp;&nbsp;&nbsp; Direction</a></li>' +
                    '</ul>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                var character = start_letter_code;
                loc = new google.maps.LatLng(parseFloat(res.latitude), parseFloat(res.longitude));
                addMarker(loc, title, character)

                start_letter_code++;

            });

            loc = new google.maps.LatLng(parseFloat(result[0].latitude), parseFloat(result[0].longitude));
            // console.log(loc);

            map.panTo(loc);
            // var bounds = new google.maps.LatLngBounds();
            map.setCenter(bounds.getCenter());
            map.fitBounds(bounds);
        }
    });
}


function clearOverlays() {
    // console.log(markers.length);

    // var bounds = new google.maps.LatLngBounds();
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
        // bounds.extend(markers[i]);
    }
    markers = [];
    // map.fitBounds(bounds);
}
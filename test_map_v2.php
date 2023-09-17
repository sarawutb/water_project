<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Marker Labels</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <!-- <link rel="stylesheet" type="text/css" href="./style.css" /> -->
    <!-- <script src="./index.js"></script> -->
  </head>
  <style>
  /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
#map {
  height: 100%;
}

/* Optional: Makes the sample page fill the window. */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}
  </style>
<body>
<div id="map"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-p02gu1dCpusmkrGn6u4Oz3OTRCeqZ8k&callback=initMap&v=weekly"async></script>
<script type="text/javascript">
var lat_arr = [];
var lng_arr = [];
var poly;
var map;
var markers = new Array();
var path = [];

var centerCords = {
    lat: 15.2434614,
    lng: 104.8593945
};

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: centerCords // Center the map on Pakistan.
    });

    poly = new google.maps.Polyline({
        strokeColor: '#000000',
        strokeOpacity: 1.0,
        strokeWeight: 3
    });
    poly.setMap(map);

    // Add a listener for the click event
    map.addListener('click', addLatLng);
}

// Handles click events on a map, and adds a new point to the Polyline.
function addLatLng(event, path = false) {
    // console.log("event", event);
    path = poly.getPath();
    // path.push(event.latLng);

    var marker = new google.maps.Marker({
        position: event.latLng,
        title: '#' + path.getLength(),
        map: map,
        id: new Date()
    });

    markers.push(marker);

    var location = event.latLng;
    var lat_val = lat_arr.push(location.lat());
    var lng_val = lng_arr.push(location.lng());
    // console.log(path);
      console.log(lat_arr);
      console.log(lng_arr);
// console.log(path.length);
      poly.getPath().setAt(markers.length - 1, event.latLng);
    google.maps.event.addListener(marker, 'click', function(event) {
      if(markers[0].id == marker.id && path.length > 2){
        poly.getPath().setAt(markers.length , event.latLng);
        // path.splice(markers.length - 1, 1);
        // if () {
        //
          // console.log(event.latLng);

        // }
      }else{
        removePoint(marker);
      }
    });
}

function removePoint(marker) {
      for (var i = 0; i < markers.length; i++) {
          if(markers[i].id === marker.id) {
                markers[i].setMap(null);
                markers.splice(i, 1);

                lat_arr.splice(i, 1);
                lng_arr.splice(i, 1);

                poly.getPath().removeAt(i);
            }
      }

}
</script>
</head>
<body>
<!-- <div id="dvMap" style="width: 100%; height: 500px"> -->
</div>
</body>
</html>

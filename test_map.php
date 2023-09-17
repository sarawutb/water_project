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

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-p02gu1dCpusmkrGn6u4Oz3OTRCeqZ8k&callback=initMap&v=weekly"
        async
      ></script>
    <!-- <script
      src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap&v=weekly"
      async
    ></script> -->
  </body>
</html>

<script type="text/javascript">
let poly;
let map;

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    zoom: 7,
    center: { lat: 41.879, lng: -87.624 }, // Center the map on Chicago, USA.
  });
  poly = new google.maps.Polyline({
    strokeColor: "#000000",
    strokeOpacity: 1.0,
    strokeWeight: 3,
  });
  poly.setMap(map);
  // Add a listener for the click event
  map.addListener("click", addLatLng);
}

// Handles click events on a map, and adds a new point to the Polyline.
function addLatLng(event) {

  // Because path is an MVCArray, we can simply append a new coordinate
  // and it will automatically appear.

  const path = poly.getPath();
  path.push(event.latLng);
  // Add a new marker at the new plotted point on the polyline.
  // new google.maps.Marker({
  //   position: event.latLng,
  //   title: "#" + path.getLength(),
  //   map: map,
  // });
}
</script>

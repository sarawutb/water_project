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

  <div>
    <label id ="colorVal">Select color</label>
<input type="color" id ='color'>Value</input>
</div>
<script type="text/javascript">
let colorInput = document.getElementById('color');


colorInput.addEventListener('input', () =>{
document.getElementById('colorVal').innerHTML = colorInput.value;
});
</script>

    <div id="map" style="height: 100%;"/>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-p02gu1dCpusmkrGn6u4Oz3OTRCeqZ8k&callback=initMap&v=weekly"async></script>

    <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script> -->
    <script type="text/javascript">
    // This example creates draggable triangles on the map.
// Note also that the red triangle is geodesic, so its shape changes
// as you drag it north or south.
function initMap() {
  <?php
  $test = "{lat:15.254441843827616,lng:104.86393494289655},{lat:15.24856249228037,lng:104.85642475765485},{lat:15.252620090514537,lng:104.85595268886823}^{lat:15.255849551477576,lng:104.869599768336},{lat:15.253945003581476,lng:104.8710588900401},{lat:15.25419342385141,lng:104.86753983181256}";
  $test2 = explode("^",$test);
  $count = count($test2);
  ?>
  let val = "<?=$test?>";
  // let myArray = val.split("^");
  // let text = myArray[0].split("},");
  // const blueCoords1 = [
  //   {lat:15.255849551477576,lng:104.869599768336},{lat:15.253945003581476,lng:104.8710588900401},{lat:15.25419342385141,lng:104.86753983181256}
  // ];
  // console.log(blueCoords);
  // console.log(blueCoords1);
  var centerCords = {
      lat: 15.2434614,
      lng: 104.8593945
  };
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 15,
    center: centerCords,
    mapTypeId: "terrain",
  });

  <?php
  for($i=0;$i<$count;$i++){
    // $test = $test2[$i];
  ?>
  // const blueCoords<?=$i?> = [<?=$test2[$i]?>];
  new google.maps.Polygon({
    map,
    paths: [<?=$test2[$i]?>],
    strokeColor: "#0000FF",
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: "#0000FF",
    fillOpacity: 0.35,
    draggable: true,
    geodesic: false,
  });
  <?php
    }
  ?>
}
</script>
</head>
<body>
<!-- <div id="dvMap" style="width: 100%; height: 500px"> -->
</div>
</body>
</html>

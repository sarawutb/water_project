const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
let labelIndex = 0;
var centerCords = {
    lat: 15.2434614,
    lng: 104.8593945
};
function initMap() {
const bangalore =  centerCords;
const map = new google.maps.Map(document.getElementById("map"), {
  zoom: 15,
  center: bangalore,
});

// This event listener calls addMarker() when the map is clicked.
google.maps.event.addListener(map, "click", (event) => {
  addMarker(event.latLng, map);
  //รรับตำแหน่ง
});
// Add a marker at the center of the map.
// addMarker(bangalore, map);
}

// Adds a marker to the map.
function addMarker(location, map) {
new google.maps.Marker({
  position: location,
  label: labels[labelIndex++ % labels.length],
  map: map,
});
}

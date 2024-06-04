<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
    <title>pruebas en mapa</title>
</head>

<style>
    #map { height: 280px;
        width: 800px;
     }
</style>

<body>
    <h1>este es un mapa usando leaflet</h1>


<label for="">cordenadas lat</label>
<input type="text" name="lat" id="lat">
<br>
<label for="">cordenadas lon</label>
<input type="text" name="lon" id="lon">
<br>
<hr>
<h2>cambio de cordenadas</h2>

<label for="">cordenadas x</label>
<input type="text" name="x" id="x">
<br>
<label for="">cordenadas y</label>
<input type="text" name="x" id="x">
<br>
<hr>

<div id="map"></div>
    
 <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
     <script>
        var map = L.map('map').setView([22.22662, -102.32547], 18);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    var popup = L.popup();

function onMapClick(e) {
    popup
        .setLatLng(e.latlng)
        .setContent("Las cordenadas son:  " + e.latlng.toString())
        .openOn(map);
}

map.on('click', onMapClick);
     </script>
</body>
</html>
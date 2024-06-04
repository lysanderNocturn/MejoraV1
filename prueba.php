<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
    <title>Pruebas en mapa</title>
</head>

<style>
    #map { 
        height: 280px;
        width: 800px;
    }
</style>

<body>
    <h1>Este es un mapa usando Leaflet</h1>

    <h2>Coordenadas</h2>


    <label for="utm">Coordenadas UTM</label>
    <input type="text" name="utm" id="utm" readonly>
    <br>
    <hr>

    <div id="map"></div>
    
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.7.5/proj4.js"></script>
    <script>
        // Definir la proyección UTM para la zona 13 Norte
        proj4.defs('EPSG:32613', '+proj=utm +zone=13 +datum=WGS84 +units=m +no_defs');

        var map = L.map('map').setView([22.22662, -102.32547], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var popup = L.popup();

        function onMapClick(e) {
            var lat = e.latlng.lat.toFixed(5);
            var lon = e.latlng.lng.toFixed(5);
            
            // Convertir a UTM (Zona 13 Norte)
            var utmCoords = proj4('EPSG:4326', 'EPSG:32613', [parseFloat(lon), parseFloat(lat)]);
            var utmX = utmCoords[0].toFixed(2);
            var utmY = utmCoords[1].toFixed(2);

            var utmInput = document.getElementById('utm');
            utmInput.value = utmX + ", " + utmY;

            // Mostrar en consola
            console.log("Coordenadas UTM: " + utmInput.value);
        }

        map.on('click', onMapClick);
    </script>
</body>
</html>

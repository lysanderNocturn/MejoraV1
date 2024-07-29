<?php
include('usuario.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar dirección</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <link rel="stylesheet" href="../../css/globals.css">
            <link rel="stylesheet" href="../../css/ventanilla.css">
    <style>
        #map {
            height: 550px;
            width: 100%;
            border-radius: 20px;
            border: 15px;
        }
        .leaflet-popup-content-wrapper {
            padding: 10px;
        }
        .leaflet-popup-content {
            max-height: 300px;
            overflow-y: auto;
        }
    </style>
</head>
<body>

        <?php
        include('sidenav.php')
        ?>

    <div class="content">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10">
                <h2 class="text-center mb-4">Ubicaciones de solicitudes</h2>
                <div id="map"></div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.7.5/proj4.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Definir la proyección UTM para la zona 13 Norte
        proj4.defs('EPSG:32613', '+proj=utm +zone=13 +datum=WGS84 +units=m +no_defs');

        var map = L.map('map').setView([22.22662, -102.32547], 13);

        // Añadir capas base y de satélite
        var baseLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var streetLayer = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: '&copy; <a href="https://maps.google.com">Google Maps</a>'
        });

        var hybridLayer = L.tileLayer('https://{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: '&copy; <a href="https://maps.google.com">Google Maps</a>'
        });

        L.control.layers({
            'Mapa Base': baseLayer,
            'Callejero': streetLayer,
            'Híbrido': hybridLayer
        }).addTo(map);

        // Función para convertir coordenadas UTM a lat/lng
        function utmToLatLng(easting, northing) {
            var latLng = proj4('EPSG:32613', 'EPSG:4326', [easting, northing]);
            return [latLng[1], latLng[0]]; // [lat, lng]
        }

        // Función para añadir un marcador al mapa
        function addMarker(easting, northing, label) {
            var latLng = utmToLatLng(easting, northing);
            L.marker(latLng)
                .addTo(map)
                .bindPopup(label);
        }

        // Obtener datos de la base de datos y añadir los marcadores
        $.ajax({
            url: 'get_locations.php', // Archivo PHP para obtener los datos
            method: 'GET',
            success: function(response) {
                var locations = JSON.parse(response);
                locations.forEach(function(location) {
                    if (location.estatus === 'verificador') {
                        var coords = location.coordenadas.split(', ');
                        addMarker(parseFloat(coords[0]), parseFloat(coords[1]), location.nombre_propietario + '<br>' + location.direccion);
                    }
                });
            },
            error: function(error) {
                console.error('Error fetching locations:', error);
            }
        });
    </script>
</body>
</html>
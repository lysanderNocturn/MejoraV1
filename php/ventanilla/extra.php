<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de actividades</title>
  <!-- Cargar hojas de estilo -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="../../css/globals.css">
  <link rel="stylesheet" href="../../css/ventanilla.css">
  <style>
    #map {
      height: 400px;
      width: 100%;
    }

    #imagen-preview {
      max-width: 100%;
      margin-top: 10px;
      display: none;
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
  <?php include('navVentana.php'); ?>

  <div class="container p-3 mt-3">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5>Completar Información</h5>
          </div>
          <div class="card-body">
            <form id="formulario" action="agregarExtra.php" method="post" enctype="multipart/form-data">
              <!-- Campo de selección de folio -->
              <div class="mb-3">
                <label for="folio" class="form-label">Folio</label>
                <select class="form-select" id="folio" name="folio" required>
                  <option value="" selected disabled>Selecciona un folio</option>
                  <?php
                  include('../conection.php');
                  while($row = $result->fetch_assoc()) {
                      echo "<option value='" . $row["folio"] . "'>" . $row["folio"] . "</option>";
                  }
                  ?>
                </select>
              </div>

              <!-- Campo de ubicación geográfica -->
              <div class="mb-3">
                <label for="ubicacion" class="form-label">Ubicación Geográfica</label>
                <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Escribe la ubicación o selecciona en el mapa" required readonly>
              </div>

              <!-- Campos para subir archivos -->
              <div class="mb-3">
                <label for="escrituras" class="form-label">Escrituras del Inmueble</label>
                <input type="file" class="form-control" id="escrituras" name="escrituras" accept="image/*">
              </div>

              <div class="mb-3">
                <label for="boleta-predial" class="form-label">Boleta del Predial</label>
                <input type="file" class="form-control" id="boleta-predial" name="boleta-predial" accept="image/*">
              </div>

              <div class="mb-3">
                <label for="identificacion" class="form-label">Identificación Oficial</label>
                <input type="file" class="form-control" id="identificacion" name="identificacion" accept="image/*">
              </div>

              <button type="submit" class="btn btn-primary">Enviar a verificar</button>
              <div id="mensaje-envio" style="margin-top: 10px; display: none;"></div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Sección del mapa interactivo -->
    <div class="row justify-content-center mt-4">
      <div class="col-md-10">
        <h2 class="text-center mb-4">Mapa Interactivo</h2>
        <div id="map"></div>
      </div>
    </div>
  </div>

  <!-- Cargar scripts -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.7.5/proj4.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Definir la proyección UTM para la zona 13 Norte
    proj4.defs('EPSG:32613', '+proj=utm +zone=13 +datum=WGS84 +units=m +no_defs');

    var map = L.map('map').setView([22.22662, -102.32547], 13);

    // Añadir capas base y de satélite
    var baseLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });

    var hybridLayer = L.tileLayer('https://{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
      maxZoom: 20,
      subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
      attribution: '&copy; <a href="https://maps.google.com">Google Maps</a>'
    });

    var layerControl = L.control.layers({
      'Mapa Base': baseLayer,
      'Satélite': satelliteLayer,
      'Callejero': streetLayer,
      'Híbrido': hybridLayer
    }).addTo(map);

    baseLayer.addTo(map);

    // Añadir una barra de escala
    L.control.scale().addTo(map);

    var marker;

    function onMapClick(e) {
      if (marker) {
        map.removeLayer(marker);
      }

      var lat = e.latlng.lat.toFixed(5);
      var lon = e.latlng.lng.toFixed(5);

      // Convertir a UTM (Zona 13 Norte)
      var utmCoords = proj4('EPSG:4326', 'EPSG:32613', [parseFloat(lon), parseFloat(lat)]);
      var utmX = utmCoords[0].toFixed(2);
      var utmY = utmCoords[1].toFixed(2);

      // Actualizar el campo de ubicación
      var ubicacionInput = document.getElementById('ubicacion');
      ubicacionInput.value = `${utmX}, ${utmY}`;

      // Obtener la dirección usando Nominatim
      fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`)
        .then(response => response.json())
        .then(data => {
          var direccion = data.display_name;
          var carretera = data.address.road || "N/A";
          var ciudad = data.address.city || data.address.town || data.address.village || "N/A";
          var estado = data.address.state || "N/A";
          var pais = data.address.country || "N/A";
          var codigoPostal = data.address.postcode || "N/A";

          var popupContent = `
            <b>Coordenadas:</b> ${lat}, ${lon}<br>
            <b>Coordenadas UTM:</b> ${utmX}, ${utmY}<br>
            <b>Dirección:</b> ${direccion}<br>
            <b>Carretera:</b> ${carretera}<br>
            <b>Ciudad:</b> ${ciudad}<br>
            <b>Estado:</b> ${estado}<br>
            <b>País:</b> ${pais}<br>
            <b>Código Postal:</b> ${codigoPostal}<br>
          `;
          marker = L.marker(e.latlng).addTo(map)
            .bindPopup(popupContent).openPopup();
        })
        .catch(error => {
          console.error('Error fetching data:', error);
        });
    }

    map.on('click', onMapClick);

    // Función para añadir marcadores personalizados
    function addCustomMarker(lat, lon, title, description) {
      var customMarker = L.marker([lat, lon]).addTo(map);
      if (title || description) {
        var popupContent = '';
        if (title) popupContent += `<h5>${title}</h5>`;
        if (description) popupContent += `<p>${description}</p>`;
        customMarker.bindPopup(popupContent);
      }
    }

    // Ejemplo de añadir un marcador personalizado
    addCustomMarker(22.22662, -102.32547, 'Mi marcador personalizado', 'Este es un marcador añadido manualmente.');

    // Función para medir distancias entre puntos
    var measureControl = L.control.measure({
      position: 'topleft',
      primaryLengthUnit: 'meters',
      secondaryLengthUnit: 'kilometers',
      primaryAreaUnit: 'sqmeters',
      activeColor: '#db4a29',
      completedColor: '#9b2d14'
    });
    measureControl.addTo(map);

    // Función para geolocalizar al usuario si el navegador lo permite
    map.locate({ setView: true, maxZoom: 16 });

    function onLocationFound(e) {
      var radius = e.accuracy / 2;
      L.circle(e.latlng, radius).addTo(map)
        .bindPopup("Estás dentro de aproximadamente " + radius + " metros de este punto").openPopup();
    }

    map.on('locationfound', onLocationFound);

    function onLocationError(e) {
      alert(e.message);
    }

    map.on('locationerror', onLocationError);
  </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de actividades</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin="" />
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
  </style>
</head>

<body>
  <?php include ('navVentana.php'); ?>

  <div class="container p-3 mt-3">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5>Completar Información</h5>
          </div>
          <div class="card-body">
            <form id="formulario" action="agregarExtra.php" method="post" enctype="multipart/form-data">
              <!-- Contenido del formulario -->

              <div class="mb-3">
                <label for="folio" class="form-label">Folio</label>
                <select class="form-select" id="folio" name="folio" required>
                  <option value="" selected disabled>Selecciona un folio</option>
                  <?php
                  include ('../conection.php');
                  while($row = $result->fetch_assoc()) {
                      echo "<option value='" . $row["folio"] . "'>" . $row["folio"] . "</option>";
                  }
                  ?>
                </select>
              </div>

              <div class="mb-3">
                <label for="ubicacion" class="form-label">Ubicación Geográfica</label>
                <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Escribe la ubicación o selecciona en el mapa" required readonly>
              </div>

              <!-- Agrega campos para escanear y agregar imágenes -->
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

              <!-- Fin del formulario -->
              <button type="submit" class="btn btn-primary">Enviar averificar</button>
              <div id="mensaje-envio" style="margin-top: 10px; display: none;"></div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center mt-4">
      <div class="col-md-10">
        <h2 class="text-center mb-4">Mapa Interactivo</h2>
        <div id="map"></div>
      </div>
    </div>
  </div>

  <!-- Make sure you put this AFTER Leaflet's CSS -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.7.5/proj4.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Definir la proyección UTM para la zona 13 Norte
    proj4.defs('EPSG:32613', '+proj=utm +zone=13 +datum=WGS84 +units=m +no_defs');

    var map = L.map('map').setView([22.22662, -102.32547], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var popup = L.popup();

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

      var utmInput = document.getElementById('ubicacion');
      utmInput.value = utmX + ", " + utmY;

      // Obtener la dirección usando Nominatim
      var url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`;
      fetch(url)
        .then(response => response.json())
        .then(data => {
          var direccion = data.display_name;
          var popupContent = `
            <b>Coordenadas:</b> ${lat}, ${lon}<br>
            <b>Coordenadas UTM:</b> ${utmX}, ${utmY}<br>
            <b>Dirección:</b> ${direccion}<br>
          `;
          // Agregar marcador al mapa con popup
          marker = L.marker(e.latlng).addTo(map)
            .bindPopup(popupContent).openPopup();

          // Deshabilitar eventos de clic en el mapa después de la primera selección
          map.clean('click');
        })
        .catch(error => {
          console.error('Error fetching data:', error);
        });
    }

    map.on('click', onMapClick);

  </script>
</body>

</html>

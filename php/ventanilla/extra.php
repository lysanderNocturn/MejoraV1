<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>Registro de actividades</title>
  <link rel="stylesheet" href="../../css/globals.css">
  <link rel="stylesheet" href="../../css/ventanilla.css">
</head>

<style>
    #map { height: 280px;
        width: 800px;
     }
</style>

<body>
  <?php include ('navVentana.php'); ?>

  <div class="container p-1 mt-12">
    <div class="row justify-content-center">
      <div class="col-md-12 row-12">
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
                <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Escribe la ubicación o selecciona en el mapa" required>
              </div>

              <div class="mb-3">
                <label for="imagen" class="form-label">Imagen de Referencia</label>
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
                <img id="imagen-preview" style="max-width: 100%; margin-top: 10px; display: none;">
              </div>

              <button type="submit" class="btn btn-primary">Guardar</button>
              <div id="mensaje-envio" style="margin-top: 10px; display: none;"></div>

              <!-- Fin del formulario -->
            </form>
          </div>
        </div>
      </div>
    
    <h1>este es un mapa usando leaflet</h1>

    <div id="map"></div>
 
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

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
                
</body>
</html>

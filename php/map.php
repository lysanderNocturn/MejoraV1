<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>ArcGIS Maps SDK for JavaScript Tutorials: Add a feature layer</title>
  <style>
    html, body, #viewDiv {
      padding: 3;
      margin: 3;
      height: 100%;
      width: 100%;
    }
  </style>
  <link rel="stylesheet" href="https://js.arcgis.com/4.29/esri/themes/light/main.css">
  <script src="https://js.arcgis.com/4.29/"></script>

  <script>
    require([
      "esri/config",
      "esri/Map",
      "esri/views/MapView",
      "esri/layers/FeatureLayer",
      "esri/widgets/Legend",
      "esri/widgets/Expand"
    ], function(esriConfig, Map, MapView, FeatureLayer, Legend, Expand) {

      esriConfig.apiKey = "AAPKce52763d91ac47219c75a801f12e2dc9kHf7jBzugOnb-vbA71329XzL6gPAUKToCq6PvM1njm3_nV9SN9Sjaf-2U2Y0kcDI";

      const map = new Map({
        basemap: "arcgis-topographic"
      });

      const view = new MapView({
        container: "viewDiv",
        map: map,
        center: [-102.3051289, 22.2289523],
        zoom: 13
      });

      // Trails feature layer (lines)
      const trailsLayer = new FeatureLayer({
        url: "https://services3.arcgis.com/we8ufmHPXrhFekUr/arcgis/rest/services/POLIGONOS/FeatureServer/0",
        outFields: ["CVE_CAT_OR", "shape__area", "shape__length"],
        popupTemplate: {
          title: "Usuo",
          content: "<b>CVE_CAT_OR:</b> {CVE_CAT_OR}<br><b>Shape__Area:</b> {shape__area} <br><b>Shape__Length:</b> {shape__length} <br><a onclick='printData()'>Imprimir</a>",
          actions: [{
            id: "printAction",
            title: "Imprimir",
            className: "esri-icon-printer",
            disabled: false,
            type: "button"
          }]
        }
      });

      map.add(trailsLayer);


      view.popup.on("trigger-action", function(event) {
        if (event.action.id === "printAction") {
          printData();
        }
      });

    });

    function printData() {
      // Obtener los datos del popup
      const cve_cat_or = document.querySelector(".esri-popup .esri-title").innerText;
      const shape_area = document.querySelector(".esri-popup .esri-field-CVE_CAT_OR").innerText;
      const shape_length = document.querySelector(".esri-popup .esri-field-shape__length").innerText;

      // Crear una ventana emergente con los datos
      const printWindow = window.open("", "_blank", "width=600,height=400");
      printWindow.document.write(`<h2>Datos del Popup:</h2><p><b>CVE_CAT_OR:</b> {cve_cat_or}</p><p><b>Shape__Area:</b> {shape_area}</p><p><b>Shape__Length:</b> {shape_length}</p>`);

   
    }
  </script>

</head>
<body>
  <div id="viewDiv"></div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
</body>
</html>

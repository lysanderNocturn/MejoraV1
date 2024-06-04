<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de actividades</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/globals.css">
  <link rel="stylesheet" href="../css/tables.css">
</head>
<style>
    body {
      background-color: #f0f8ff;
    }

    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 10px 20px rgba(100, 205, 255, 1);
      background-color: rgba(255, 255, 255, 0.4);
      margin: auto;
      margin-top: 30px;
      padding: 15px;
      transition: all 0.3s ease-in-out;
    }

    .card:hover {
      transform: scale(1.006);
    }

    .form-group label {
      font-weight: bold;
    }

    .btn-primary {
      background-color: #0d47a1;
      border-color: #0d47a1;
      transition: all 0.3s ease-in-out;
    }

    .btn-primary:hover {
      background-color: #2962ff;
      border-color: #2962ff;
    }
  </style>

<body>
  <!-- nav bar -->
  <?php include ('navVentana.php')?>

  <form action="documentacion.php" method="post" enctype="multipart/form-data">
    <div class="container py-5 card p-3">
      <h2 class="text-center mb-4">Subir archivos</h2>

        <div class="col-md-6">
            <div class="form-group">
                <label for="predial">Nuemro Predial</label>
                <input type="tel" class="form-control" id="predial" name="predial" required>
            <div class="invalid-feedback">Por favor ingresa su Nuemro Predial.</div>
        </div>
    </div>

      <div class="mb-3">
        <label for="documento" class="form-label">Escrituras o acreditacion del inmueble</label>
        <input type="file" class="form-control" id="escrituras" name="documento" accept=".pdf,.docx,.doc,.png,.jpg,.jpeg" required>
        <div class="invalid-feedback">Por favor selecciona un archivo.</div>
      </div>
      <div class="mb-3">
        <label for="documento" class="form-label">Voleta predial</label>
        <input type="file" class="form-control" id="voletaPredio" name="documento" accept=".pdf,.docx,.doc,.png,.jpg,.jpeg" required>
        <div class="invalid-feedback">Por favor selecciona un archivo.</div>
      </div>
      <div class="mb-3">
        <label for="documento" class="form-label">Identificacion Oficial</label>
        <input type="file" class="form-control" id="identificacion" name="documento" accept=".pdf,.docx,.doc,.png,.jpg,.jpeg" required>
        <div class="invalid-feedback">Por favor selecciona un archivo.</div>
      </div>
      <div class="mb-3">
        <label for="documento" class="form-label">Vista del inmueble</label>
        <input type="file" class="form-control" id="documento" name="documento" accept=".pdf,.docx,.doc,.png,.jpg,.jpeg" required>
        <div class="invalid-feedback">Por favor selecciona un archivo.</div>
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-primary">Subir documentos</button>
      </div>
    </div>
  </form>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

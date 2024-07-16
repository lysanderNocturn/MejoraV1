<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de actividades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/globals.css">
    <link rel="stylesheet" href="../../css/ventanilla.css">
    <style>
        body {
            background-color: #f0f8ff;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(100, 205, 255, 1);
            background-color: rgba(255, 255, 255, 0.5);
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
</head>
<body>
    <?php include ('navVentana.php')?>

    <div class="container p-1 mt-12">
        <div class="row justify-content-center">
            <div class="col-md-12 row-12">
                <div class="card">
                    <div class="card-header">
                        <br>
                        <input type="text" id="searchInput" placeholder="Buscar..." class="form-control">
                        <button id="searchButton" class="btn btn-primary mt-2">Buscar</button>
                        <button id="downloadButton" class="btn btn-secondary mt-2">Descargar</button>
                        <br><br>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Folio</th>
                                    <th>Nombre del propietario</th>
                                    <th>Dirección</th>
                                    <th>Localidad</th>
                                    <th>Ubicación</th>
                                    <th>Tipo de trámite</th>
                                    <th>Fecha de ingreso</th>
                                    <th>Nombre del solicitante</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th>Usuario que recibe</th>
                                    <th>Comentarios</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include('../conection.php');
                                    $conexion = connection();
                                    $sql = "SELECT * FROM formulario";
                                    $result = mysqli_query($conexion, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($mostrar = mysqli_fetch_array($result)) { ?>
                                            <tr>
                                                <td><?php echo $mostrar['folio'] ?></td>
                                                <td><?php echo $mostrar['nombre_propietario'] ?></td>
                                                <td><?php echo $mostrar['direccion'] ?></td>
                                                <td><?php echo $mostrar['localidad'] ?></td>
                                                <td><?php echo $mostrar['ubicacion'] ?></td>
                                                <td><?php echo $mostrar['tipo_tramite'] ?></td>
                                                <td><?php echo $mostrar['fecha_ingreso'] ?></td>
                                                <td><?php echo $mostrar['nombre_solicitante'] ?></td>
                                                <td><?php echo $mostrar['telefono'] ?></td>
                                                <td><?php echo $mostrar['correo'] ?></td>
                                                <td><?php echo $mostrar['usuario_recibe'] ?></td>
                                                <td><?php echo $mostrar['observaciones'] ?></td>
                                            </tr>
                                <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='13'>No hay registros</td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>   
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchButton').click(function() {
                var searchText = $('#searchInput').val().toLowerCase();
                $('table tbody tr').each(function() {
                    var found = false;
                    $(this).each(function() {
                        if ($(this).text().toLowerCase().indexOf(searchText) !== -1) {
                            found = true;
                            return false;
                        }
                    });
                    if (found) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            $('#downloadButton').click(function() {
                var wb = XLSX.utils.book_new();
                var ws_data = [];
                var rows = $('table tr:visible');

                rows.each(function(index) {
                    var row = [];
                    $(this).find('th, td').each(function() {
                        row.push($(this).text().trim());
                    });
                    ws_data.push(row);
                });

                var ws = XLSX.utils.aoa_to_sheet(ws_data);
                XLSX.utils.book_append_sheet(wb, ws, "Datos Filtrados");

                var date = new Date();
                var formattedDate = date.getFullYear() + "-" +
                    ("0" + (date.getMonth() + 1)).slice(-2) + "-" +
                    ("0" + date.getDate()).slice(-2);

                var filename = "reporte_" + formattedDate + ".xlsx";
                XLSX.writeFile(wb, filename);
            });
        });
    </script>
</body>
</html>

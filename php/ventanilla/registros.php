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
            animation: backgroundFade 3s infinite alternate;
            margin-left: 250px; /* Margen para el contenido principal */
        }

        @keyframes backgroundFade {
            0% { background-color: #f0f8ff; }
            100% { background-color: #e0f7fa; }
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
            transform: scale(1.01);
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
            transform: scale(1.05);
        }

        .btn-secondary:hover {
            transform: scale(1.05);
        }

        .form-control {
            animation: inputPulse 2s infinite alternate;
        }

        @keyframes inputPulse {
            0% { border-color: #0d47a1; }
            100% { border-color: #2962ff; }
        }

        th.sortable:hover {
            cursor: pointer;
            text-decoration: underline;
            color: #2962ff;
            transition: color 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideDown {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        .slide-down {
            animation: slideDown 0.5s ease-in-out;
        }

        .table {
            font-size: 0.85rem; /* Ajusta el tamaño de la fuente */
        }

        .table td, .table th {
            padding: 0.5rem; /* Reduce el padding */
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
            transform: scale(1.02);
            transition: all 0.3s ease-in-out;
        }

        .loading-spinner {
            display: none;
            margin: 50px auto;
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .tooltip-inner {
            background-color: #0d47a1;
            color: #fff;
        }

        .tooltip-arrow {
            border-top-color: #0d47a1 !important;
        }

        .feedback-message {
            display: none;
            margin-top: 10px;
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php include ('navVentana.php') ?>

    <div class="container p-1 mt-12">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card slide-down">
                    <div class="card-header">
                        <input type="text" id="searchInput" placeholder="Buscar..." class="form-control fade-in" data-bs-toggle="tooltip" data-bs-placement="top" title="Buscar en la tabla">
                        <button id="searchButton" class="btn btn-primary mt-2 fade-in" data-bs-toggle="tooltip" data-bs-placement="top" title="Realizar búsqueda">Buscar</button>
                        <button id="resetButton" class="btn btn-warning mt-2 fade-in" data-bs-toggle="tooltip" data-bs-placement="top" title="Restablecer búsqueda">Restablecer</button>
                        <button id="downloadButton" class="btn btn-secondary mt-2 fade-in" data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar datos filtrados">Descargar</button>
                        <div class="feedback-message" id="feedbackMessage"></div>
                        <table class="table table-hover fade-in">
                            <thead>
                                <tr>
                                    <th class="sortable" data-bs-toggle="tooltip" data-bs-placement="top" title="Ordenar por Folio">Folio</th>
                                    <th class="sortable" data-bs-toggle="tooltip" data-bs-placement="top" title="Ordenar por Nombre del propietario">Nombre del propietario</th>
                                    <th class="sortable" data-bs-toggle="tooltip" data-bs-placement="top" title="Ordenar por Dirección">Dirección</th>
                                    <th class="sortable" data-bs-toggle="tooltip" data-bs-placement="top" title="Ordenar por Localidad">Localidad</th>
                                    <th class="sortable" data-bs-toggle="tooltip" data-bs-placement="top" title="Ordenar por Ubicación">Ubicación</th>
                                    <th class="sortable" data-bs-toggle="tooltip" data-bs-placement="top" title="Ordenar por Tipo de trámite">Tipo de trámite</th>
                                    <th class="sortable" data-bs-toggle="tooltip" data-bs-placement="top" title="Ordenar por Fecha de ingreso">Fecha de ingreso</th>
                                    <th class="sortable" data-bs-toggle="tooltip" data-bs-placement="top" title="Ordenar por Nombre del solicitante">Nombre del solicitante</th>
                                    <th class="sortable" data-bs-toggle="tooltip" data-bs-placement="top" title="Ordenar por Teléfono">Teléfono</th>
                                    <th class="sortable" data-bs-toggle="tooltip" data-bs-placement="top" title="Ordenar por Correo">Correo</th>
                                    <th class="sortable" data-bs-toggle="tooltip" data-bs-placement="top" title="Ordenar por Usuario que recibe">Usuario que recibe</th>
                                    <th class="sortable" data-bs-toggle="tooltip" data-bs-placement="top" title="Ordenar por Comentarios">Comentarios</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include('../conection.php');
                                    $conexion = connection();
                                    $sql = "SELECT * FROM `formulario` ORDER BY `formulario`.`folio` DESC";
                                    $result = mysqli_query($conexion, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($mostrar = mysqli_fetch_array($result)) { ?>
                                            <tr class="fade-in">
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
            $('[data-bs-toggle="tooltip"]').tooltip();

            $('#searchButton').click(function() {
                var searchText = $('#searchInput').val().toLowerCase();
                $('table tbody tr').each(function() {
                    var found = $(this).text().toLowerCase().indexOf(searchText) !== -1;
                    $(this).toggle(found);
                });
                $('#feedbackMessage').text('Búsqueda completada').fadeIn().delay(2000).fadeOut();
            });

            $('#resetButton').click(function() {
                $('#searchInput').val('');
                $('table tbody tr').show();
                $('#feedbackMessage').text('Búsqueda restablecida').fadeIn().delay(2000).fadeOut();
            });

            $('#downloadButton').click(function() {
                var wb = XLSX.utils.book_new();
                var ws_data = [];
                $('table tr:visible').each(function() {
                    var row = [];
                    $(this).find('th, td').each(function() {
                        row.push($(this).text().trim() || "NULL");
                    });
                    ws_data.push(row);
                });

                var ws = XLSX.utils.aoa_to_sheet(ws_data);
                XLSX.utils.book_append_sheet(wb, ws, "Datos Filtrados");

                var date = new Date();
                var formattedDate = `${date.getFullYear()}-${("0" + (date.getMonth() + 1)).slice(-2)}-${("0" + date.getDate()).slice(-2)}`;
                var filename = `reporte_${formattedDate}.xlsx`;

                XLSX.writeFile(wb, filename);
                $('#feedbackMessage').text('Descarga completada').fadeIn().delay(2000).fadeOut();
            });

            $('.sortable').click(function() {
                var index = $(this).index();
                var table = $(this).closest('table');
                var rows = table.find('tbody tr').get();

                rows.sort(function(a, b) {
                    var valA = $(a).children('td').eq(index).text().toLowerCase();
                    var valB = $(b).children('td').eq(index).text().toLowerCase();
                    return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB);
                });

                if ($(this).hasClass('asc')) {
                    rows.reverse();
                    $(this).removeClass('asc').addClass('desc');
                } else {
                    $(this).removeClass('desc').addClass('asc');
                }

                $.each(rows, function(index, row) {
                    table.children('tbody').append(row);
                });
            });
        });
    </script>
</body>
</html>
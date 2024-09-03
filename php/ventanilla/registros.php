<?php include ('navVentana.php') ?>
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
            animation: backgroundFade 5s infinite alternate;
            font-size: 16px;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        @keyframes backgroundFade {
            0% { background-color: #f0f8ff; }
            100% { background-color: #e0f7fa; }
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(100, 205, 255, 0.5);
            background-color: rgba(255, 255, 255, 0.9);
            margin-top: 20px;
            padding: 16px;
        }

        .form-group label {
            font-weight: bold;
            font-size: 16px;
        }

        .btn {
            font-size: 16px;
            padding: 8px 16px;
        }

        .btn-primary {
            background-color: #0d47a1;
            border-color: #0d47a1;
        }

        .btn-primary:hover {
            background-color: #2962ff;
            border-color: #2962ff;
        }

        .btn-warning {
            background-color: #f57f17;
            border-color: #f57f17;
        }

        .btn-warning:hover {
            background-color: #ffb300;
            border-color: #ffb300;
        }

        .form-control {
            animation: inputPulse 2s infinite alternate;
            font-size: 16px;
        }

        @keyframes inputPulse {
            0% { border-color: #0d47a1; }
            100% { border-color: #2962ff; }
        }

        .table-responsive {
            padding: 16px;
        }

        .table {
            margin: 16px 0;
            width: 100%;
            font-size: 16px;
        }

        .table td, .table th {
            padding: .5rem;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .loading-spinner {
            display: none;
            margin: 40px auto;
            border: 8px solid #f3f3f3;
            border-radius: 50%;
            border-top: 8px solid #3498db;
            width: 80px;
            height: 80px;
            animation: spin 1.5s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .tooltip-inner {
            background-color: #0d47a1;
            color: #fff;
            font-size: 14px;
        }

        .tooltip-arrow {
            border-top-color: #0d47a1 !important;
        }

        .feedback-message {
            display: none;
            margin-top: 10px;
            color: green;
            font-weight: bold;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .card {
                margin: 8px;
            }
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="input-group mb-3">
                        <input type="text" id="searchInput" placeholder="Buscar..." aria-label="Buscar" class="form-control" data-bs-toggle="tooltip" data-bs-placement="top" title="Buscar en la tabla">
                        <button id="searchButton" class="btn btn-primary" aria-label="Buscar" data-bs-toggle="tooltip" data-bs-placement="top" title="Realizar búsqueda">Buscar</button>
                        <button id="resetButton" class="btn btn-warning" aria-label="Restablecer búsqueda" data-bs-toggle="tooltip" data-bs-placement="top" title="Restablecer búsqueda">Restablecer</button>
                        <button id="downloadButton" class="btn btn-secondary" aria-label="Descargar datos filtrados" data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar datos filtrados">Descargar</button>
                    </div>
                    <div class="feedback-message" id="feedbackMessage"></div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="sortable" scope="col" aria-sort="none" data-bs-toggle="tooltip" data-bs-placement="top" title="Ordenar por Folio">Folio</th>
                                    <th class="sortable" scope="col" aria-sort="none" data-bs-toggle="tooltip" data-bs-placement="top" title="Ordenar por Nombre del propietario">Nombre del propietario</th>
                                    <th class="sortable" scope="col" aria-sort="none" data-bs-toggle="tooltip" data-bs-placement="top" title="Ordenar por Dirección">Dirección</th>
                                    <th class="sortable" scope="col" aria-sort="none" data-bs-toggle="tooltip" data-bs-placement="top" title="Ordenar por Localidad">Localidad</th>
                                    <th class="sortable" scope="col" aria-sort="none" data-bs-toggle="tooltip" data-bs-placement="top" title="Ordenar por Ubicación">Ubicación</th>
                                    <th class="sortable" scope="col" aria-sort="none" data-bs-toggle="tooltip" data-bs-placement="top" title="Ordenar por Tipo de trámite">Tipo de trámite</th>
                                    <th class="sortable" scope="col" aria-sort="none" data-bs-toggle="tooltip" data-bs-placement="top" title="Ordenar por Fecha de ingreso">Fecha de ingreso</th>
                                    <th class="sortable" scope="col" aria-sort="none" data-bs-toggle="tooltip" data-bs-placement="top" title="Ordenar por Nombre del solicitante">Nombre del solicitante</th>
                                    <th class="sortable" scope="col" aria-sort="none" data-bs-toggle="tooltip" data-bs-placement="top" title="Ordenar por Teléfono">Teléfono</th>
                                    <th class="sortable" scope="col" aria-sort="none" data-bs-toggle="tooltip" data-bs-placement="top" title="Ordenar por Correo">Correo</th>
                                    <th class="sortable" scope="col" aria-sort="none" data-bs-toggle="tooltip" data-bs-placement="top" title="Ordenar por Usuario que recibe">Usuario que recibe</th>
                                    <th class="sortable" scope="col" aria-sort="none" data-bs-toggle="tooltip" data-bs-placement="top" title="Ordenar por Comentarios">Comentarios</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include('../conection.php');
                                $conexion = connection();
                                $sql = "SELECT * FROM formulario ORDER BY folio DESC";
                                $result = mysqli_query($conexion, $sql);
                                if ($result && mysqli_num_rows($result) > 0) {
                                    while ($mostrar = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($mostrar['folio'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><?php echo htmlspecialchars($mostrar['nombre_propietario'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><?php echo htmlspecialchars($mostrar['direccion'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><?php echo htmlspecialchars($mostrar['localidad'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><?php echo htmlspecialchars($mostrar['ubicacion'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><?php echo htmlspecialchars($mostrar['tipo_tramite'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><?php echo htmlspecialchars($mostrar['fecha_ingreso'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><?php echo htmlspecialchars($mostrar['nombre_solicitante'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><?php echo htmlspecialchars($mostrar['telefono'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><?php echo htmlspecialchars($mostrar['correo'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><?php echo htmlspecialchars($mostrar['usuario_recibe'], ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><?php echo htmlspecialchars($mostrar['observaciones'], ENT_QUOTES, 'UTF-8') ?></td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='13' class='text-center'>No hay registros</td></tr>";
                                }
                                mysqli_close($conexion);
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
            // Tooltip Initialization
            $('[data-bs-toggle="tooltip"]').tooltip();

            // Search Button Functionality
            $('#searchButton').on('click', function() {
                var searchText = $('#searchInput').val().toLowerCase();
                $('table tbody tr').each(function() {
                    var rowText = $(this).text().toLowerCase();
                    $(this).toggle(rowText.includes(searchText));
                });
                $('#feedbackMessage').text('Búsqueda completada').fadeIn().delay(2000).fadeOut();
            });

            // Reset Button Functionality
            $('#resetButton').on('click', function() {
                $('#searchInput').val('');
                $('table tbody tr').show();
                $('#feedbackMessage').text('Búsqueda restablecida').fadeIn().delay(2000).fadeOut();
            });

            // Download Button Functionality
            $('#downloadButton').on('click', function() {
                var wb = XLSX.utils.book_new();
                var ws_data = [['Folio', 'Nombre del propietario', 'Dirección', 'Localidad', 'Ubicación', 'Tipo de trámite', 'Fecha de ingreso', 'Nombre del solicitante', 'Teléfono', 'Correo', 'Usuario que recibe', 'Comentarios']];

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

            // Table Sorting Functionality
            $('.sortable').on('click', function() {
                var $this = $(this);
                var index = $this.index();
                var table = $this.closest('table');
                var rows = table.find('tbody tr').get();
                var sortAsc = $this.hasClass('asc');

                rows.sort(function(a, b) {
                    var valA = $(a).children('td').eq(index).text().toLowerCase();
                    var valB = $(b).children('td').eq(index).text().toLowerCase();
                    if ($.isNumeric(valA) && $.isNumeric(valB)) {
                        return sortAsc ? valA - valB : valB - valA;
                    }
                    return sortAsc ? valA.localeCompare(valB) : valB.localeCompare(valA);
                });

                $this.toggleClass('asc desc');

                $.each(rows, function(index, row) {
                    table.children('tbody').append(row);
                });
            });
        });
    </script>
</body>
</html>

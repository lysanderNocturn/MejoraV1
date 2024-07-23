<?php
include('../conection.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Actividades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .spinner-border {
            display: none;
        }
        .collapse-toggle {
            cursor: pointer;
        }
        .details-row {
            padding: 15px 0;
        }
        .btn-primary {
            background-color: #0056b3;
            border-color: #004494;
        }
        .btn-primary:hover {
            background-color: #004494;
            border-color: #003366;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .modal-content {
            border-radius: 10px;
        }
        .alert {
            display: none;
        }
    </style>
</head>

<body>

    <?php include ('navbar.php')?>

    <div class="container mt-5">
        <h2>Registros en Estatus de Verificador</h2>
        <div id="alert-message" class="alert"></div>
        <table class="table table-bordered table-hover">
            <thead class="table-info">
                <tr>
                    <th>Folio</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                    <th>Detalles</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['folio']; ?></td>
                        <td><?php echo $row['nombre_propietario']; ?></td>
                        <td><?php echo $row['direccion']; ?></td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $row['folio']; ?>">
                                Agregar Observaciones
                            </button>
                        </td>
                        <td>
                            <span class="collapse-toggle" data-bs-toggle="collapse" data-bs-target="#details-<?php echo $row['folio']; ?>" aria-expanded="false" aria-controls="details-<?php echo $row['folio']; ?>">
                                &#9660; <!-- Flecha hacia abajo -->
                            </span>
                        </td>
                    </tr>
                    <tr class="collapse details-row" id="details-<?php echo $row['folio']; ?>">
                        <td colspan="5">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Detalles adicionales:</strong>
                                        <p>Folio: <?php echo $row['folio']; ?></p>
                                        <p>Nombre Propietario: <?php echo $row['nombre_propietario']; ?></p>
                                        <p>Dirección: <?php echo $row['direccion']; ?></p>
                                        <p>Localidad: <?php echo $row['localidad']; ?></p>
                                        <p>Tipo de Trámite: <?php echo $row['tipo_tramite']; ?></p>
                                        <p>Fecha de Ingreso: <?php echo $row['fecha_ingreso']; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Nombre del Solicitante: <?php echo $row['nombre_solicitante']; ?></p>
                                        <p>Teléfono: <?php echo $row['telefono']; ?></p>
                                        <p>Correo: <?php echo $row['correo']; ?></p>
                                        <p>Usuario que Recibe: <?php echo $row['usuario_recibe']; ?></p>
                                        <p>Observaciones: <?php echo $row['observaciones']; ?></p>
                                        <p>Fecha de Entrega Estimada: <?php echo $row['fecha_entrega_estimada']; ?></p>
                                        <p>Estatus: <?php echo $row['estatus']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="modal-<?php echo $row['folio']; ?>" tabindex="-1" aria-labelledby="modalLabel-<?php echo $row['folio']; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel-<?php echo $row['folio']; ?>">Agregar Observaciones</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="observaciones-form" data-folio="<?php echo $row['folio']; ?>" enctype="multipart/form-data">
                                        <input type="hidden" name="folio" value="<?php echo $row['folio']; ?>">
                                        <div class="mb-3">
                                            <label for="comentarios-<?php echo $row['folio']; ?>" class="form-label">Comentarios</label>
                                            <textarea class="form-control" id="comentarios-<?php echo $row['folio']; ?>" name="comentarios" rows="3" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="imagen-<?php echo $row['folio']; ?>" class="form-label">Subir Imagen</label>
                                            <input class="form-control" type="file" id="imagen-<?php echo $row['folio']; ?>" name="imagen" accept="image/*" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.observaciones-form').on('submit', function(e){
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(this);
                var spinner = form.find('.spinner-border');
                var alertMessage = $('#alert-message');
                
                spinner.show();
                
                $.ajax({
                    url: 'procesar_observaciones.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response){
                        spinner.hide();
                        alertMessage.removeClass('d-none alert-danger').addClass('alert-success').text('Observaciones guardadas exitosamente.');
                        setTimeout(function(){
                            alertMessage.addClass('d-none');
                        }, 3000);
                        form.closest('.modal').modal('hide');
                    },
                    error: function(){
                        spinner.hide();
                        alertMessage.removeClass('d-none alert-success').addClass('alert-danger').text('Error al guardar observaciones.');
                        setTimeout(function(){
                            alertMessage.addClass('d-none');
                        }, 3000);
                    }
                });
            });

            // Cambia el ícono de la flecha cuando se colapsa o se expande
            $('.collapse-toggle').on('click', function() {
                $(this).html($(this).html() == '&#9660;' ? '&#9650;' : '&#9660;');
            });
        });
    </script>

</body>

</html>

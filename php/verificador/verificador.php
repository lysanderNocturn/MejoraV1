<?php
 include('usuario.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Actividades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/globals.css">
    
    <style>
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            top: 0;
            left: 0;
            width: 100%;
            background-color: #0d47a1;
            color: white;
            padding: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .content {
            margin-top: 80px; /* Ajusta según la altura del encabezado */
            padding: 2rem;
            width: 100%;
            max-width: calc(100% - 250px);
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(100, 205, 255, 1);
            background-color: rgba(255, 255, 255, 0.4);
           
            margin-top: 30px;
            padding: 15px;
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #0d47a1;
            border-color: #0d47a1;
            transition: none; /* Elimina la transición de hover */
        }

        .btn-primary:hover {
            background-color: #0d47a1;
            border-color: #0d47a1;
            box-shadow: none; /* Elimina la sombra del botón al pasar el cursor */
        }

        .collapse-toggle {
            cursor: pointer; /* Muestra el cursor como puntero */
        }
    </style>
</head>

<body>
    <?php include('sidenav.php'); ?>

    <div class="content">
        <div class="card">
            <div class="card-header">
                <h2>Registros en Estatus de Verificador</h2>
            </div>
            <div class="card-body">
                <div id="alert-message" class="alert d-none"></div>
                <table class="table table-bordered table">
                    <thead class="table-info">
                        <tr>
                            <th>Folio</th>
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>Acciones</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['folio']); ?></td>
                                    <td><?php echo htmlspecialchars($row['nombre_propietario']); ?></td>
                                    <td><?php echo htmlspecialchars($row['direccion']); ?></td>
                                    <td>
                                        <?php if ($row['estatus'] !== 'ventanilla'): ?>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-<?php echo htmlspecialchars($row['folio']); ?>">
                                                <i class="bi bi-pencil"></i> Agregar Observaciones
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="collapse-toggle" data-bs-toggle="collapse" data-bs-target="#details-<?php echo htmlspecialchars($row['folio']); ?>" aria-expanded="false" aria-controls="details-<?php echo htmlspecialchars($row['folio']); ?>">
                                            &#9650; <!-- Flecha hacia arriba -->
                                        </span>
                                    </td>
                                </tr>
                                <tr class="collapse details-row" id="details-<?php echo htmlspecialchars($row['folio']); ?>">
                                    <td colspan="5">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <strong>Detalles adicionales:</strong>
                                                    <p>Folio: <?php echo htmlspecialchars($row['folio']); ?></p>
                                                    <p>Nombre Propietario: <?php echo htmlspecialchars($row['nombre_propietario']); ?></p>
                                                    <p>Dirección: <?php echo htmlspecialchars($row['direccion']); ?></p>
                                                    <p>Localidad: <?php echo htmlspecialchars($row['localidad']); ?></p>
                                                    <p>Tipo de Trámite: <?php echo htmlspecialchars($row['tipo_tramite']); ?></p>
                                                    <p>Fecha de Ingreso: <?php echo htmlspecialchars($row['fecha_ingreso']); ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>Nombre del Solicitante: <?php echo htmlspecialchars($row['nombre_solicitante']); ?></p>
                                                    <p>Teléfono: <?php echo htmlspecialchars($row['telefono']); ?></p>
                                                    <p>Correo: <?php echo htmlspecialchars($row['correo']); ?></p>
                                                    <p>Usuario que Recibe: <?php echo htmlspecialchars($row['usuario_recibe']); ?></p>
                                                    <p>Observaciones: <?php echo htmlspecialchars($row['observaciones']); ?></p>
                                                    <p>Fecha de Entrega Estimada: <?php echo htmlspecialchars($row['fecha_entrega_estimada']); ?></p>
                                                    <p>Estatus: <?php echo htmlspecialchars($row['estatus']); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal" id="modal-<?php echo htmlspecialchars($row['folio']); ?>" tabindex="-1" aria-labelledby="modalLabel-<?php echo htmlspecialchars($row['folio']); ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabel-<?php echo htmlspecialchars($row['folio']); ?>">Agregar Observaciones</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="observaciones-form" data-folio="<?php echo htmlspecialchars($row['folio']); ?>" enctype="multipart/form-data">
                                                    <input type="hidden" name="folio" value="<?php echo htmlspecialchars($row['folio']); ?>">
                                                    <div class="mb-3">
                                                        <label for="comentarios-<?php echo htmlspecialchars($row['folio']); ?>" class="form-label">Comentarios</label>
                                                        <textarea class="form-control" id="comentarios-<?php echo htmlspecialchars($row['folio']); ?>" name="comentarios" rows="3" required></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="lote-<?php echo htmlspecialchars($row['folio']); ?>" class="form-label">Lote</label>
                                                        <textarea class="form-control" id="lote-<?php echo htmlspecialchars($row['folio']); ?>" name="lote" rows="1" required></textarea>
                                                        <label for="manzana-<?php echo htmlspecialchars($row['folio']); ?>" class="form-label">Manzana</label>
                                                        <textarea class="form-control" id="manzana-<?php echo htmlspecialchars($row['folio']); ?>" name="manzana" rows="1" required></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="imagen-<?php echo htmlspecialchars($row['folio']); ?>" class="form-label">Subir Imagen</label>
                                                        <input class="form-control" type="file" id="imagen-<?php echo htmlspecialchars($row['folio']); ?>" name="imagen" accept="image/*" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">
                                                        Guardar
                                                    </button>
                                                    <div class="text-primary" role="status"></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">No se encontraron registros.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.observaciones-form').on('submit', function(e){
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(this);
                var alertMessage = $('#alert-message');
                
                $.ajax({
                    url: 'procesar_observaciones.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response){
                        alertMessage.removeClass('d-none alert-danger').addClass('alert-success').text('Observaciones guardadas exitosamente.');
                        setTimeout(function(){
                            alertMessage.addClass('d-none');
                        }, 5000);
                        form.closest('.modal').modal('hide');
                        // Aquí puedes actualizar la tabla si es necesario
                    },
                    error: function(){
                        alertMessage.removeClass('d-none alert-success').addClass('alert-danger').text('Error al guardar observaciones.');
                        setTimeout(function(){
                            alertMessage.addClass('d-none');
                        }, 5000);
                    }
                });
            });

            // Cambia el ícono de flecha en el colapso de detalles
            $('.collapse-toggle').on('click', function() {
                var icon = $(this);
                icon.html(icon.html() === '▼' ? '▲' : '▼');
            });
        });
    </script>
</body>
</html>

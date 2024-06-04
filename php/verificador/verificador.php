<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Actividades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-color: #f0f8ff;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(100, 205, 255, 0.5);
            background-color: rgba(255, 255, 255, 0.8);
            padding: 15px;
        }

        .card-header {
            background-color: #0d47a1;
            color: #fff;
            border-radius: 15px 15px 0 0;
            padding: 10px 15px;
        }

        .modal-header {
            background-color: #0d47a1;
            color: #fff;
            border-radius: 15px 15px 0 0;
            padding: 10px 15px;
        }

        .btn-primary {
            background-color: #0d47a1;
            border-color: #0d47a1;
        }

        .btn-primary:hover {
            background-color: #2962ff;
            border-color: #2962ff;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>

    <?php include ('navbar.php')?>

    <div class="container p-1 mt-12">
        <div class="row justify-content-center">
            <div class="col-md-12 row-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Registro de Actividades</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Folio</th>
                                    <th>Nombre del Propietario</th>
                                    <th>Dirección</th>
                                    <th>Localidad</th>
                                    <th>Tipo de Trámite</th>
                                    <th>Fecha de Ingreso</th>
                                    <th>Teléfono</th>
                                    <th>Comentarios</th>
                                    <th>Verificar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    // Consultar registros en la tabla formulario
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
                                                <td><?php echo $mostrar['tipo_tramite'] ?></td>
                                                <td><?php echo $mostrar['fecha_ingreso'] ?></td>
                                                <td><?php echo $mostrar['telefono'] ?></td>
                                                <td><?php echo $mostrar['observaciones'] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verificarModal<?php echo $mostrar['folio'] ?>">Verificar</button>
                                                </td>
                                            </tr>
                                            <!-- Modal -->
                                            <div class="modal fade" id="verificarModal<?php echo $mostrar['folio'] ?>" tabindex="-1" aria-labelledby="verificarModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="verificarModalLabel">Verificar</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="verificar.php" method="post">
                                                                <div class="mb-3">
                                                                    <label for="verificarInput" class="form-label">Campo de Verificación</label>
                                                                    <input type="text" class="form-control" id="verificarInput" name="verificarInput" placeholder="Ingrese el dato">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="coordenadas" class="form-label">Coordenadas</label>
                                                                    <input type="text" class="form-control" id="coordenadas" name="coordenadas" placeholder="Ingrese las coordenadas">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="ubicacion_geologica" class="form-label">Ubicación Geológica</label>
                                                                    <input type="text" class="form-control" id="ubicacion_geologica" name="ubicacion_geologica" placeholder="Ingrese la ubicación geológica">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="imagenReferencia" class="form-label">Imagen de Referencia</label>
                                                                    <input type="text" class="form-control" id="imagenReferencia" name="imagenReferencia" placeholder="Ingrese la URL de la imagen de referencia">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="estatus" class="form-label">Estatus</label>
                                                                    <input type="text" class="form-control" id="estatus" name="estatus" placeholder="Ingrese el estatus">
                                                                </div>
                                                                <input type="hidden" name="folio" value="<?php echo $mostrar['folio'] ?>">
                                                                <button type="submit" class="btn btn-primary">Verificar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                    } else {
                                        echo "<tr><td colspan='9'>No hay registros</td></tr>";
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
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de actividades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/globals.css">
   
    
    <style>
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(100, 205, 255, 1);
            background-color: rgba(255, 255, 255, 0.9);
            margin: 10px;
            padding: 10px;
            width: 100%;
            max-width: 600px;
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
        .invalid-feedback {
            display: none;
            color: red;
        }
    </style>
</head>
<body>
    <!-- Nav bar -->
    <?php include ('navVentana.php')?>

    <div class="content">
        <form action="procesar_formulario.php" method="post" onsubmit="return validarFormulario()">
            <div class="container card">
                <h2 class="text-center mb-12">Recepción en ventanilla</h2>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre">Nombre del propietario:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                            <div class="invalid-feedback">Por favor ingresa su nombre.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre_solicitante">Nombre del solicitante:</label>
                            <input type="text" class="form-control" id="nombre_solicitante" name="nombre_solicitante" required>
                            <div class="invalid-feedback">Por favor ingresa el nombre del solicitante.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="direccion">Dirección:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                            <div class="invalid-feedback">Por favor ingresa su dirección.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="localidad">Localidad:</label>
                            <input type="text" class="form-control" id="localidad" name="localidad" required>
                            <div class="invalid-feedback">Por favor ingresa su localidad.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipoTramite">Tipo de trámite:</label>
                            <select class="form-control" id="tipoTramite" name="tipoTramite" required>
                                <option value="" selected disabled>Seleccionar</option>
                                <option value="CONSTANCIA">CONSTANCIA</option>
                                <option value="USO DE SUELO">USO DE SUELO</option>
                                <option value="SUBDIVICION">SUBDIVICION</option>
                                <option value="NUMERO OFICIAL">NUMERO OFICIAL</option>
                            </select>
                            <div class="invalid-feedback">Por favor selecciona el tipo de trámite.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="correo">Correo:</label>
                            <input type="email" class="form-control" id="correo" name="correo">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" required>
                            <div class="invalid-feedback">Por favor ingresa su número de teléfono.</div>
                        </div>
                    </div>
                    <?php
                    // Verifica si el usuario está autenticado
                    if(isset($_SESSION['username'])) {
                        $usuario = $_SESSION['username']; // Obtiene el nombre de usuario de la sesión
                    }
                    ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="usuario">Recibió:</label>
                            <input type="text" class="form-control" name="usuario" id="usuario" value="<?php echo htmlspecialchars($usuario); ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="observaciones">Observaciones:</label>
                            <textarea class="form-control" id="observaciones" name="observaciones" rows="2" required></textarea>
                            <div class="invalid-feedback">Por favor ingresa alguna observación.</div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function transformarDatos() {
            var inputs = document.querySelectorAll('input, textarea');
            var accentMap = {
                'á': 'a', 'é': 'e', 'í': 'i', 'ó': 'o', 'ú': 'u',
                'Á': 'A', 'É': 'E', 'Í': 'I', 'Ó': 'O', 'Ú': 'U'
            };

            inputs.forEach(function(input) {
                var value = input.value.toUpperCase().replace(/[áéíóúÁÉÍÓÚ]/g, function(match) {
                    return accentMap[match];
                }).replace(/[.,]/g, ''); // Remover puntos y comas
                input.value = value;
            });
        }

        function validarFormulario() {
            // Transformar datos antes de validarlos
            transformarDatos();

            var nombre = document.getElementById('nombre').value;
            if (nombre === '') {
                alert('Por favor ingresa su nombre.');
                return false;
            }

            var telefono = document.getElementById('telefono').value;
            var telefonoPattern = /^\d{10}$/; 
            if (telefono === '' || !telefonoPattern.test(telefono)) {
                alert('Por favor ingresa un número de teléfono válido.');
                return false;
            }

            return true; 
        }
    </script>
</body>
</html>


<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de usuario</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include ("navVentana.php") ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Perfil de Usuario
                    </div>
                    <div class="card-body">
                        <h1 class="card-title">Bienvenido, <?php echo $username; ?></h1>
                        <p class="card-text">Aquí están los detalles de tu perfil:</p>
                        <ul class="list-group">
                            <li class="list-group-item">ID: <?php echo $id; ?></li>
                            <li class="list-group-item">Nombre de usuario: <?php echo $username; ?></li>
                            <li class="list-group-item">Nivel de acceso: <?php echo $nivel; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="recursos/css/bootstrap.min.css">
    <link rel="stylesheet" href="recursos/css/bootstrap.css">
    <title>Inicio</title>
    <style>
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <?php include ('nav.php')?>
    <div class="container p-2">
        <div class="jumbotron">
            <h1 class="display-4">Bienvenido a la página de trámites</h1>
            <p class="lead">En esta página podrás encontrar los trámites que necesitas para realizar tus gestiones.</p>
            <hr class="my-4">
            <p>Si no encuentras el trámite que necesitas, puedes contactarnos para que te ayudemos a encontrarlo.</p>
            <a href="#contacto" class="btn btn-info">Contactarnos</a>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card m-2 p-2">
                    <img src="imagen_tramite1.jpg" class="card-img-top" alt="Trámite número oficial">
                    <div class="card-body p-2 m-1">
                        <h5 class="card-title">Trámite número oficial</h5>
                        <p class="card-text">Adquiere tu número oficial.</p>
                        <a href="#informacionNu" class="btn btn-warning">Información de documentos</a>
                        <a href="#tramiteNu" class="btn btn-info btn-lg">Solicitar trámite</a>
                    </div>
                </div>
            </div>
            <!-- Otras tarjetas de trámites -->
        </div>
    </div>
    <div id="contacto" class="bg-light p-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Contacto</h2>
                    <p>Correo electrónico: info@example.com</p>
                    <p>Teléfono: 123-456-7890</p>
                    <p>Dirección: 123 Calle Principal, Ciudad</p>
                </div>
                <div class="col-md-6">
                    <h2>Envíanos un mensaje</h2>
                    <form action="enviar_mensaje.php" method="post">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="mensaje">Mensaje:</label>
                            <textarea id="mensaje" name="mensaje" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-dark text-white p-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Contacto</h5>
                    <p>Correo electrónico: info@example.com</p>
                    <p>Teléfono: 123-456-7890</p>
                    <p>Dirección: 123 Calle Principal, Ciudad</p>
                </div>
                <div class="col-md-6">
                    <h5>Redes Sociales</h5>
                    <ul class="list-inline">
                        <!-- Agrega enlaces a tus redes sociales si las tienes -->
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

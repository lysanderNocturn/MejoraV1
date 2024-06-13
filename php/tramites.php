<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Página de Trámites</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-file-alt mr-2"></i>Página de Trámites</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-home mr-2"></i>Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacto"><i class="fas fa-envelope mr-2"></i>Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary" href="#" id="login"><i class="fas fa-sign-in-alt mr-2"></i>Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Fin Navbar -->

    <div class="container py-5">
        <div class="jumbotron text-center bg-white">
            <h1 class="display-4">Bienvenido a la página de trámites</h1>
            <p class="lead">Encuentra aquí los trámites necesarios para tus gestiones.</p>
            <hr class="my-4">
            <p>Si no encuentras el trámite que necesitas, contáctanos y te ayudaremos.</p>
            <a class="btn btn-primary btn-lg" href="#contacto" role="button"><i class="fas fa-phone-alt mr-2"></i>Contactarnos</a>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4 shadow">
                    <img src="imagen_tramite1.jpg" class="card-img-top" alt="Trámite número oficial">
                    <div class="card-body">
                        <h5 class="card-title">Trámite número oficial</h5>
                        <p class="card-text">Obtén tu número oficial.</p>
                        <a href="#informacionNu" class="btn btn-warning"><i class="fas fa-info-circle mr-2"></i>Información de documentos</a>
                        <a href="#tramiteNu" id="solicitar-tramite" class="btn btn-primary"><i class="fas fa-file-alt mr-2"></i>Solicitar trámite</a>
                    </div>
                </div>
            </div>
            <!-- Otras tarjetas de trámites -->
        </div>
    </div>

    <div id="contacto" class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4 shadow">
                        <div class="card-body">
                            <h2 class="card-title">Contacto</h2>
                            <p class="card-text"><i class="fas fa-envelope mr-2"></i>Correo electrónico: info@example.com</p>
                            <p class="card-text"><i class="fas fa-phone-alt mr-2"></i>Teléfono: 123-456-7890</p>
                            <p class="card-text"><i class="fas fa-map-marker-alt mr-2"></i>Dirección: 123 Calle Principal, Ciudad</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4 shadow">
                        <div class="card-body">
                            <h2 class="card-title">Envíanos un mensaje</h2>
                            <form action="enviar_mensaje.php" method="post" id="contact-form">
                                <div class="form-group">
                                    <label for="nombre"><i class="fas fa-user mr-2"></i>Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre">
                                </div>
                                <div class="form-group">
                                    <label for="email"><i class="fas fa-envelope mr-2"></i>Email:</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="mensaje"><i class="fas fa-comment mr-2"></i>Mensaje:</label>
                                    <textarea class="form-control" id="mensaje" name="mensaje" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-2"></i>Enviar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Contacto</h5>
                    <p><i class="fas fa-envelope mr-2"></i>Correo electrónico: info@example.com</p>
                    <p><i class="fas fa-phone-alt mr-2"></i>Teléfono: 123-456-7890</p>
                    <p><i class="fas fa-map-marker-alt mr-2"></i>Dirección: 123 Calle Principal, Ciudad</p>
                </div>
                <div class="col-md-6">
                    <h5>Redes Sociales</h5>
                    <!-- Agrega enlaces a tus redes sociales si las tienes -->
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.getElementById('solicitar-tramite').addEventListener('click', function (e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Quieres solicitar este trámite?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, solicitar trámite',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                   axios.post('/solicitar-tramite', { tramiteId: 'ID_DEL_TRAMITE' })
                         .then(response => {
                             if (response.data.success) {
                                 Swal.fire(
                                     '¡Trámite solicitado!',
                                     'Tu solicitud de trámite ha sido enviada correctamente.',
                                     'success'
                                 )
                             }
                         })
                         .catch(error => {
                             console.error(error);
                             Swal.fire(
                                 'Error',
                                 'Hubo un error al procesar tu solicitud. Por favor, intenta nuevamente más tarde.',
                                 'error'
                             )
                         });
                }
            })
        });

        document.getElementById('login').addEventListener('click', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Inicia sesión',
                html:
                    '<input type="email" id="email" class="swal2-input" placeholder="Correo electrónico">' +
                    '<input type="password" id="password" class="swal2-input" placeholder="Contraseña">',
                confirmButtonText: 'Iniciar sesión',
                focusConfirm: false,
                preConfirm: () => {
                    const email = Swal.getPopup().querySelector('#email').value;
                    const password = Swal.getPopup().querySelector('#password').value;
                    if (!email || !password) {
                        Swal.showValidationMessage('Por favor, completa todos los campos');
                    }
                 axios.post('/login', { email, password })
                         .then(response => {
                             if (response.data.success) {
                                 Swal.fire('¡Bienvenido!', 'Has iniciado sesión correctamente', 'success');
                             } else {
                                 Swal.fire('Error', 'Credenciales incorrectas', 'error');
                             }
                        })
                         .catch(error => {
                             console.error(error);
                             Swal.fire('Error', 'Hubo un error al iniciar sesión. Por favor, intenta nuevamente más tarde.', 'error');
                         });
                }
            })
        });
    </script>
</body>

</html>

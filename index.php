<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Página de Trámites</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar-brand i {
            color: #007bff;
        }
        .navbar-nav .nav-link {
            color: #007bff;
        }
        .navbar-nav .nav-link:hover {
            color: #0056b3;
        }
        .jumbotron {
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            padding: 2rem;
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 0.5rem;
        }
        .card-title {
            font-size: 1.25rem;
        }
        .btn-primary, .btn-primary:hover {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
        .btn-info:hover {
            background-color: #138496;
            border-color: #117a8b;
        }
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 1rem;
            text-align: center;
        }
        .modal-header {
            border-bottom: 1px solid #ddd;
        }
        .modal-body {
            padding: 2rem;
        }
        .form-check-label {
            color: #007bff;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
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
        <div class="jumbotron text-center bg-white shadow-sm">
            <h1 class="display-4">Bienvenido a la página de trámites</h1>
            <p class="lead">Encuentra aquí los trámites necesarios para tus gestiones.</p>
            <hr class="my-4">
            <p>Si no encuentras el trámite que necesitas, contáctanos y te ayudaremos.</p>
            <a class="btn btn-primary btn-lg" href="#contacto" role="button"><i class="fas fa-phone-alt mr-2"></i>Contactarnos</a>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="imagen_tramite1.jpg" class="card-img-top" alt="Trámite número oficial">
                    <div class="card-body">
                        <h5 class="card-title">Trámite número oficial</h5>
                        <p class="card-text">Obtén tu número oficial.</p>
                        <a href="#informacionNu" class="btn btn-warning"><i class="fas fa-info-circle mr-2"></i>Información de documentos</a>
                        <a href="#tramiteNu" id="solicitar-tramite" class="btn btn-primary"><i class="fas fa-file-alt mr-2"></i>Solicitar trámite</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="imagen_tramite1.jpg" class="card-img-top" alt="Trámite número oficial">
                    <div class="card-body">
                        <h5 class="card-title">Trámite número oficial</h5>
                        <p class="card-text">Obtén tu número oficial.</p>
                        <a href="#informacionNu" class="btn btn-warning"><i class="fas fa-info-circle mr-2"></i>Información de documentos</a>
                        <a href="#tramiteNu" id="solicitar-tramite" class="btn btn-primary"><i class="fas fa-file-alt mr-2"></i>Solicitar trámite</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
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
        
        <!-- Card para Consultar Trámite -->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Consulta de Trámite</h5>
                        <form id="consultarTramiteForm">
                            <div class="form-group">
                                <label for="folio"><i class="fas fa-file-alt mr-2"></i>Número de Folio:</label>
                                <input type="text" class="form-control" id="folio" name="folio" required>
                            </div>
                            <button type="submit" class="btn btn-info"><i class="fas fa-search mr-2"></i>Consultar</button>
                        </form>
                        <hr>
                        <div id="tramiteStatus" style="display: none;">
                            <h5>Estado del Trámite</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Folio</th>
                                        <th>Nombre Propietario</th>
                                        <th>Tipo de Trámite</th>
                                        <th>Fecha de Ingreso</th>
                                        <th>Estatus</th>
                                    </tr>
                                </thead>
                                <tbody id="tramiteStatusBody">
                                    <!-- Datos del trámite se llenarán aquí -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="contacto" class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h2 class="card-title">Contacto</h2>
                            <p class="card-text"><i class="fas fa-envelope mr-2"></i>Correo electrónico: info@example.com</p>
                            <p class="card-text"><i class="fas fa-phone-alt mr-2"></i>Teléfono: 123-456-7890</p>
                            <p class="card-text"><i class="fas fa-map-marker-alt mr-2"></i>Dirección: 123 Calle Principal, Ciudad</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h2 class="card-title">Envíanos un mensaje</h2>
                            <form action="iniciar.php" method="post" id="contact-form">
                                <div class="form-group">
                                    <label for="nombre"><i class="fas fa-user mr-2"></i>Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre">
                                </div>
                                <div class="form-group">
                                    <label for="usuario"><i class="fas fa-envelope mr-2"></i>Usuario:</label>
                                    <input type="text" class="form-control" id="usuario" name="usuario">
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

    <!-- Modal para Consultar Trámite -->
    <div id="consultarTramiteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="consultarTramiteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="consultarTramiteModalLabel">Consultar Trámite</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="consultarTramiteForm">
                        <div class="form-group">
                            <label for="folio"><i class="fas fa-file-alt mr-2"></i>Número de Folio:</label>
                            <input type="text" class="form-control" placeholder="000-000" id="folio" name="folio" required>
                        </div>
                        <button type="submit" class="btn btn-info"><i class="fas fa-search mr-2"></i>Consultar</button>
                    </form>
                    <hr>
                    <div id="tramiteStatus" style="display: none;">
                        <h5>Estado del Trámite</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Folio</th>
                                    <th>Nombre Propietario</th>
                                    <th>Tipo de Trámite</th>
                                    <th>Fecha de Ingreso</th>
                                    <th>Estatus</th>
                                </tr>
                            </thead>
                            <tbody id="tramiteStatusBody">
                                <!-- Datos del trámite se llenarán aquí -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="loginModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Iniciar sesión</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="loginForm" method="post" action="php/iniciar.php">
                        <div class="form-group">
                            <label for="username"><i class="fas fa-user"></i> Usuario </label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Ingrese su usuario" required>
                        </div>
                        <div class="form-group">
                            <label for="password"><i class="fas fa-key"></i> Contraseña </label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña" required>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                            <label class="form-check-label" for="rememberMe">Recuérdame</label>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Iniciar sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 - 2030 Página de Trámites. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
            $('#loginModal').modal('show');
        });

        document.addEventListener("DOMContentLoaded", function () {
            if (localStorage.getItem("recordarme") === "true") {
                document.getElementById("username").value = localStorage.getItem("usuarioRecordado");
                document.getElementById("rememberMe").checked = true;
            }
        });

        document.getElementById("loginForm").addEventListener("submit", function () {
            if (document.getElementById("rememberMe").checked) {
                localStorage.setItem("recordarme", "true");
                localStorage.setItem("usuarioRecordado", document.getElementById("username").value);
            } else {
                localStorage.removeItem("recordarme");
                localStorage.removeItem("usuarioRecordado");
            }
        });

        $(document).ready(function () {
            $('#consultar-tramite').on('click', function (e) {
                e.preventDefault();
                $('#consultarTramiteModal').modal('show');
            });

            $('#consultarTramiteForm').on('submit', function (e) {
                e.preventDefault();
                const folio = $('#folio').val();
                console.log('Enviando solicitud para consultar trámite con folio:', folio);

                axios.post('./php/consultar_tramite.php', { folio: folio })
                    .then(function (response) {
                        console.log('Respuesta de la consulta:', response.data);
                        if (response.data.success) {
                            const tramite = response.data.tramite;
                            $('#tramiteStatusBody').html(`
                                <tr>
                                    <td>${tramite.folio}</td>
                                    <td>${tramite.nombre_propietario}</td>
                                    <td>${tramite.tipo_tramite}</td>
                                    <td>${tramite.fecha_ingreso}</td>
                                    <td>${tramite.estatus}</td>
                                </tr>
                            `);
                            $('#tramiteStatus').show();
                        } else {
                            $('#tramiteStatusBody').html('<tr><td colspan="5" class="text-center text-danger">' + (response.data.message || 'No se encontró el trámite') + '</td></tr>');
                            $('#tramiteStatus').show();
                        }
                    })
                    .catch(function (error) {
                        console.error('Error al realizar la consulta:', error);
                        $('#tramiteStatusBody').html('<tr><td colspan="5" class="text-center text-danger">Hubo un error al consultar el trámite</td></tr>');
                        $('#tramiteStatus').show();
                    });
            });
        });
    </script>
</body>

</html>

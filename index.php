<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap CSS (con tema Minty) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="..." crossorigin="anonymous">

    <link rel="icon" href="/recursos/img/logo.ico">
    <link rel="stylesheet" href="css/login.css">
    <!-- Íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

 
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow rounded">
                    <div class="card-header bg-primary text-white"><i class="fas fa-tasks"></i> Realizar trámites</div>
                    <div class="card-body text-center">
                        <p class="lead">¿Necesitas realizar trámites? </p>
                        <form action="php/tramites.php">
                            <button type="submit" class="btn btn-danger btn-lg"><i class="fas fa-arrow-circle-right"></i> Ir a Trámites </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow rounded">
                    <div class="card-header bg-info text-white"><i class="fas fa-sign-in-alt"></i> Iniciar sesión</div>
                    <div class="card-body">
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
                                <label class="form-check-label" for="rememberMe">Recordarme</label>
                            </div>
                            <button type="submit" class="btn btn-info btn-block"><i class="fas fa-sign-in-alt"></i> Iniciar sesión </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap y Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.2/js/bootstrap.min.js"></script>
    <script src="/js/login.js"></script>

    <script>
        // Si se establece la cookie de "recordarme", rellenar el campo de usuario
        document.addEventListener("DOMContentLoaded", function () {
            if (localStorage.getItem("recordarme") === "true") {
                document.getElementById("username").value = localStorage.getItem("usuarioRecordado");
                document.getElementById("rememberMe").checked = true;
            }
        });

        // Guardar datos de inicio de sesión en localStorage si se marca la casilla de "recordarme"
        document.getElementById("loginForm").addEventListener("submit", function () {
            if (document.getElementById("rememberMe").checked) {
                localStorage.setItem("recordarme", "true");
                localStorage.setItem("usuarioRecordado", document.getElementById("username").value);
            } else {
                localStorage.removeItem("recordarme");
                localStorage.removeItem("usuarioRecordado");
            }
        });
    </script>
</body>
</html>

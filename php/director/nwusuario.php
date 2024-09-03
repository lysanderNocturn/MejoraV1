<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            margin: 0;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            width: 100%;
        }
    </style>
</head>

<body>
    <?php include('navbar.php'); ?>

    <div class="form-container">
        <h1>Agregar Usuario</h1>
        <form action="add_user.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Usuario:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="level" class="form-label">Nivel:</label>
                <select id="level" name="level" class="form-select" required>
                    <option value="1">Ventanilla</option>
                    <option value="2">Verificador</option>
                    <option value="3">Calificador</option>
                    <option value="4">Catastro</option>
                    <option value="5">Administrador</option>
                    <option value="6">Director</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="admin_password" class="form-label">Contraseña del Administrador:</label>
                <input type="password" id="admin_password" name="admin_password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Agregar Usuario</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>

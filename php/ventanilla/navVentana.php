<?php
// Iniciar la sesión
session_start();

// Verificar si la variable de sesión 'username' está establecida
if (!isset($_SESSION["username"])) {
    // No hay una sesión iniciada, redirigir al usuario a la página de inicio
    header("Location: ../../index.php");
    exit(); // Finalizar el script para evitar que se ejecute más código
}

$username = htmlspecialchars($_SESSION["username"], ENT_QUOTES, 'UTF-8');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Panel de usuario con acceso a diferentes secciones.">
    <meta name="author" content="Tu Nombre">
    <title>Panel de Usuario</title>
    <style>
        :root {
            --primary-color: #6176A6;
            --secondary-color: #333E55;
            --bg-color: #f0f2f5;
            --text-color: #fff;
            --hover-bg-color: #4a5a83;
            --transition-speed: 0.3s;
        }

        body {
            background-color: var(--bg-color);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .sidebar {
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: var(--primary-color);
            padding: 1rem 0;
            color: var(--text-color);
            transition: transform var(--transition-speed) ease, box-shadow var(--transition-speed) ease;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
        }

        .sidebar .user-info {
            text-align: center;
            padding: 1rem;
        }

        .sidebar .user-info img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--text-color);
        }

        .sidebar h3 {
            margin: 0.5rem 0;
            font-size: 1.2rem;
        }

        .sidebar nav {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .sidebar nav a {
            color: var(--text-color);
            padding: 10px 15px;
            text-decoration: none;
            display: block;
            transition: background-color var(--transition-speed) ease, padding-left var(--transition-speed) ease;
            border-radius: 4px;
            margin: 0.5rem 0;
        }

        .sidebar nav a:hover,
        .sidebar nav a:focus {
            background-color: var(--secondary-color);
            padding-left: 25px;
        }

        .content {
            margin-left: 250px;
            padding: 2rem;
            transition: margin-left var(--transition-speed) ease;
            overflow-y: auto;
        }

        .toggle-btn {
            position: fixed;
            top: 1rem;
            left: 1rem;
            background-color: var(--primary-color);
            color: var(--text-color);
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            z-index: 1001;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            font-size: 1.5rem;
            transition: background-color var(--transition-speed) ease;
        }

        .toggle-btn:hover,
        .toggle-btn:focus {
            background-color: var(--hover-bg-color);
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-250px);
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .content {
                margin-left: 0;
            }
            .content.active {
                margin-left: 250px;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-wEmeE3w3rFf5L6JpK8j5U5r0seK5vh4P6qR7y6RsjlvPiPvWqM2RD4x6dBe8H2F6" crossorigin="anonymous">
</head>
<body>
    <aside class="sidebar" role="navigation" aria-label="Menú principal">
        <div class="user-info">
            <img src="../../img/user.png" alt="Imagen de perfil del usuario">
            <h3><?php echo $username; ?></h3>
        </div>
        <hr>
        <nav>
            <a href="ventanilla.php" aria-current="page">Inicio</a>
            <a href="registros.php">Registros</a>
            <a href="extra.php">Añadir datos</a>
            <a href="#" aria-disabled="true">Notificaciones</a>
            <a href="../cerrar_sesion.php">Cerrar sesión</a>
        </nav>
    </aside>

    <main class="content" role="main">
        <!-- Aquí va el contenido principal de la página -->
    </main>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-oP7E7XNQRaPbD9xZw6tB6m7XytZ5xnE4vIv9+f3x1v4x7zEowjWp/j9DW/vAB0VB" crossorigin="anonymous" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+I8P6vY2W8g4/2F4z/xLq8JXxQ0dQR8v/g5k0zM" crossorigin="anonymous" defer></script>
    <script>
        $(document).ready(function() {
            $('.toggle-btn').on('click', function() {
                $('.sidebar').toggleClass('active');
                $('.content').toggleClass('active');
            });
        });
    </script>
</body>
</html>

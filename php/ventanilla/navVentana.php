<?php
// Iniciar la sesión
session_start();

$username = $_SESSION["username"];



// Verificar si la variable de sesión 'username' está establecida
if (!isset($_SESSION["username"])) {
    // No hay una sesión iniciada, redirigir al usuario a la página de inicio
    header("Location: ../../index.php");
    exit(); // Finalizar el script para evitar que se ejecute más código
}
?>

<div class="sidebar">
        <div class="user-info">
            <h3>Usuario: <?php echo htmlspecialchars($username); ?></h3>
        </div>
        <hr>
        <a href="ventanilla.php">Inicio</a>
        <a href="registros.php">Registros</a>
        <a href="extra.php">Añadir datos</a>
        <a href="#">Notificaciones</a>
        <a href="../cerrar_sesion.php">Cerrar sesion</a>      
</div>

<style>
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #6176A6;
            padding-top: 1rem;
            color: #fff;
        }
        .sidebar h3 {
            padding-left: 1rem;
        }
        .sidebar a {
            color: #fff;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
        }
        .sidebar a:hover {
            background-color: #333E55;
        }
        .content {
            margin-left: 250px;
            padding: 2rem;
        }
        .card {
            margin-bottom: 1.5rem;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .modal-content {
            border-radius: 10px;
        }
        .alert {
            display: none;
        }
    </style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


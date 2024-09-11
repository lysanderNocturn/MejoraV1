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
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="ventanilla.php">Planeación</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto"> 
        <li class="nav-item">
          <a class="nav-link" href="ventanilla.php">Realizar trámite</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="registros.php">Registros realizados</a>
    
        <li class="nav-item">
          <a class="nav-link" href="extra.php">Añadir datos</a>
        </li>
        </li>
          <a class="nav-link" href="PerfilV.php">usuario: <?php echo $username; ?></a>
        </li>
      </ul>
      <ul class="navbar-nav"> <!-- Lista separada para "Cerrar sesión" -->
      
        <li class="nav-item">
          <a class="nav-link" href="../cerrar_sesion.php">Cerrar sesión</a>
        </li>
      </ul>
    </div>
  </div>
</nav>



<style>
  /* Estilos personalizados para la barra de navegación */
.navbar-brand {
  font-size: 1.3rem;
  font-weight: bold;
  color: #f0f8ff; /* Color blanco */
}

.navbar-toggler {
  border-color: #f0f8ff; /* Color blanco */
} 

.navbar-toggler-icon {
  background-color: #f018ff; /* Color blanco */
}

.navbar-nav .nav-link {
  font-size: 1.1rem;
  color: #f0f8ff; /* Color blanco */
}

.navbar-nav .nav-link:hover {
  background-color: rgba(185, 25, 255, 0.3); /* Color de fondo ligeramente transparente al pasar el cursor */
}

</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


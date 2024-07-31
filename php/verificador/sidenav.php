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
            overflow-y: auto; /* Permite el desplazamiento si el contenido es largo */
        }

        .sidebar h3 {
            padding-left: 1rem;
            margin-bottom: 1rem;
        }

        .sidebar a {
            color: #fff;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
            transition: none; /* Elimina la transición */
            border-radius: 5px; /* Opcional: para esquinas redondeadas */
        }

        .sidebar a:hover {
            background-color: #4a5c8b; /* Color de fondo al pasar el cursor, si es necesario */
            color: #fff; /* Mantiene el color del texto */
        }

        .content {
            margin-left: 250px;
            padding: 2rem;
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

        .user-info {
            text-align: center;
            padding: 0 1rem;
        }

        .user-info img {
            width: 100px;
            border-radius: 50%;
        }
    </style>


<div class="sidebar">
    <div class="user-info">
        <img src="../../img/user.png" alt="User Image">
        <h3><?php echo htmlspecialchars($username); ?></h3>
    </div>
    <hr>
        <a href="verificador.php">Inicio</a>
        <a href="direccion.php">Direcciones</a>
        <a href="#">Notificaciones</a>
        <a href="../cerrar_sesion.php">Cerrar sesion</a>      
</div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
</head>
<body>
    <?php include('navbar.php'); ?>

    <h1>Agregar Usuario</h1>
    <form action="add_user.php" method="POST">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="level">Nivel:</label>
        <select id="level" name="level" required>
            <option value="1">Ventanilla</option>
            <option value="2">Verificador</option>
            <option value="3">Calificador</option>
            <option value="4">Catastro</option>
            <option value="5">Administrador</option>
            <option value="6">Director</option>
        </select><br><br>
        
        <label for="admin_password">Contraseña del Administrador:</label>
        <input type="password" id="admin_password" name="admin_password" required><br><br>
        
        <input type="submit" value="Agregar Usuario">
    </form>
</body>
</html>

<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Incluir el archivo de conexión
    include('conection.php');

    // Obtener la conexión a la base de datos
    $conn = connection();

    // Consulta SQL para obtener la contraseña y el nivel de usuario
    $sql = "SELECT id, password, nivel FROM usuarios WHERE usuario = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Verificar si la preparación de la consulta fue exitosa
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        // Verificar si se encontró un usuario
        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_bind_result($stmt, $id, $stored_password, $user_level);
            mysqli_stmt_fetch($stmt);

            // Verificar la contraseña
            if ($password == $stored_password) {
                // Contraseña válida, guardar el nombre de usuario en una cookie si se marcó "Recordarme"
                if (isset($_POST['rememberMe']) && $_POST['rememberMe'] == 'on') {
                    setcookie("username", $username, time() + (86400 * 30), "/"); // 30 días de duración
                }

                // Iniciar la sesión y redireccionar según el nivel de usuario
                session_start();
                $_SESSION["username"] = $username;
                switch ($user_level) {
                    // Casos y redirecciones aquí...
                    case 1:
                        // Página para nivel de acceso 'ventanilla'
                        header("Location: ventanilla/ventanilla.php?mensaje=Bienvenido+Ventanilla");
                        exit();

                    case 2:
                        // Página para nivel de acceso 'verificador'
                        header("Location: verificador/verificador.php?mensaje=Bienvenido+verificador");
                        exit();

                    case 3:
                        // Página para nivel de acceso 'calificador'
                        header("Location: calificador/calificador.php?mensaje=Bienvenido+calificador");
                        exit();
                        
                    case 4:
                        // Página para nivel de acceso 'catastro'
                        header("Location: catastro/catastro.php?mensaje=Bienvenido+catastro");
                        exit();

                    case 5:
                        // Página para nivel de acceso 'administrador'
                        header("Location: administrador/administrador.php?mensaje=Bienvenido+administrador");
                        exit();

                    case 6:
                        // Página para nivel de acceso 'director'
                        header("Location: director/director.php?mensaje=Bienvenido+director");
                        exit();
                    
                    default:
                        // Redireccionar a una página de error o mostrar un mensaje de error
                        echo "Nivel de usuario no válido";
                        break;
                }
                
            } else {
                // Datos de inicio de sesión incorrectos
                echo '<script>alert("Usuario o contraseña incorrectos"); window.location.href = "../index.php";</script>';
            }
        } else {
            // Datos de inicio de sesión incorrectos
            echo '<script>alert("Usuario o contraseña incorrectos"); window.location.href = "../index.php";</script>';
        }

        // Cerrar la declaración preparada
        mysqli_stmt_close($stmt);
    } else {
        // Mostrar un mensaje de error si la preparación de la consulta falló
        echo "Error al preparar la consulta: " . mysqli_error($conn);
    }

    // Cerrar la conexión
    mysqli_close($conn);
}
?>

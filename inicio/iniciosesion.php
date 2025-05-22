<?php
session_start();
require "../otros/index.php";

$mensajeError = '';
$usuarioNoEncontrado = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $grado = $_POST['Grado'] ?? '';  
    $nombre = $_POST['NombreApellido'] ?? '';  
    $_SESSION['Grado'] = $grado;
    $_SESSION['NombreApellido'] = $nombre;

    $username = $_POST['NumeroMatricula'];
    $password = $_POST['Id_Estudiante'];

    
    $stmt = $conn->prepare("SELECT * FROM estudiantes WHERE NumeroMatricula = ?");
    $stmt->bind_param("i", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $result = $result->fetch_assoc();

        if (password_verify($password, $result["Id_Estudiante"])) {
            $_SESSION['ID_Usuario'] = $result["Id_Estudiante"];
            $_SESSION['username'] = $username;
            $_SESSION['Rol'] = 'Estudiante';
            header("Location: ../estudiante/interfazEstudiante.php");
            exit();
        } else {
            $mensajeError = 'Contraseña incorrecta';
        }
    } else {
        
        $stmt = $conn->prepare("SELECT * FROM docentes WHERE Email = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $result = $result->fetch_assoc();

            if (password_verify($password, $result["ID_Docente"])) {
                $_SESSION['ID_Usuario'] = $result["ID_Docente"];
                $_SESSION['username'] = $username;
                $_SESSION['Rol'] = 'Docente';
                header("Location: ../docente/interfazDocente.php");
                exit();
            } else {
                $mensajeError = 'Contraseña incorrecta';
            }
        } else {
            
            $stmt = $conn->prepare("SELECT * FROM administrador WHERE Correo = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $result = $result->fetch_assoc();

                if (password_verify($password, $result["Contrasena"])) {
                    $_SESSION['ID_Usuario'] = $result["Contrasena"];
                    $_SESSION['username'] = $username;
                    $_SESSION['Rol'] = 'Administrador';
                    header("Location: ../administrador/admin.php");
                    exit();
                } else {
                    $mensajeError = 'Contraseña incorrecta';
                }
            } else {
                $usuarioNoEncontrado = 'El usuario no fue encontrado';
            }
        }
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="iniciosesion.css">
    <link rel="shortcut icon" href="../imagenes/Logo1.png" type="image/x-icon">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <img src="../imagenes/Logo.png" alt="Logo" class="logo">
    <div class="atras">
        <a href="../index.html" class="btn-volver">
            <img class="atras" src="../imagenes/Devolverse.png">
        </a>
    </div>
    <form action="iniciosesion.php" method="POST">
        <h2>Iniciar</h2>
        <div>
            <label for="username">Número de matrícula o correo</label>
            <input type="text" id="NumeroMatricula" name="NumeroMatricula" required>
        </div>
        
        <div class="password-container">
            <label for="password" class="contra">Contraseña</label>
            <div class="input-container">
                <img src="../imagenes/Icono-Ojo-Cerrado.png" alt="OJITO" id="ImagenContrasena" height="30px" width="30px" class="ojo">
                <input type="password" id="Id_Estudiante" name="Id_Estudiante" required>
            </div>
        </div>

        <div class="remember">
            <a href="registrarse.html">Registrarse</a>
        </div>
        
        <button class="Iniciar" type="submit">Iniciar</button>
    </form>

    <script>
        <?php if (!empty($mensajeError)): ?>
            swal("Incorrecto", "<?php echo $mensajeError; ?>", "error");
        <?php elseif (!empty($usuarioNoEncontrado)): ?>
            swal("Error", "<?php echo $usuarioNoEncontrado; ?>", "error");
        <?php endif; ?>
    </script>

    <script>
        document.getElementById('ImagenContrasena').addEventListener('click', function() {
            var passwordField = document.getElementById('Id_Estudiante');
            var passwordFieldType = passwordField.getAttribute('type');

            if (passwordFieldType === 'password') {
                passwordField.setAttribute('type', 'text');
                this.src = '../imagenes/Icono-Ojo-Abierto.png'; 
            } else {
                passwordField.setAttribute('type', 'password');
                this.src = '../imagenes/Icono-Ojo-Cerrado.png'; 
            }
        });
    </script>
</body>
</html>

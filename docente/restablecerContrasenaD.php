<?php
require "../otros/index.php";

session_start();

if (!isset($_SESSION['Rol'])) {
    header('Location: ../inicio/iniciosesion.php');
    exit();
} else if ($_SESSION['Rol'] === 'Admin') {
    header('Location: ../administrador/admin.php');
    exit();
} else if ($_SESSION['Rol'] === 'Estudiante') {
    header('Location: ../estudiante/interfazEstudiante.php');
    exit();
}

$mensaje = "";
$showAlert = false;
$alertType = ""; 

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricula = $_POST['Email'];
    $current_password = $_POST['ID_Docente'];
    $new_password = $_POST['ID_DocenteN'];
    $confirm_new_password = $_POST['ID_DocenteC'];

    
    $stmt = $conn->prepare("SELECT ID_Docente FROM docentes WHERE Email = ?");
    $stmt->bind_param("s", $matricula);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        $mensaje = "No se encontró ningún docente con ese email.";
        $showAlert = true;
        $alertType = "error";
    } else {
        $row = $result->fetch_assoc();
        $hashed_password_db = $row['ID_Docente'];

        
        if (!password_verify($current_password, $hashed_password_db)) {
            $mensaje = "La contraseña actual es incorrecta.";
            $showAlert = true;
            $alertType = "error";
        } elseif ($new_password !== $confirm_new_password) {
            $mensaje = "Las contraseñas nuevas no coinciden.";
            $showAlert = true;
            $alertType = "error";
        } else {
            
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_stmt = $conn->prepare("UPDATE docentes SET ID_Docente = ? WHERE Email = ?");
            $update_stmt->bind_param("ss", $hashed_new_password, $matricula);

            if ($update_stmt->execute()) {
                $mensaje = "Contraseña actualizada correctamente.";
                $showAlert = true;
                $alertType = "success";
                header("Refresh: 1; url=interfazDocente.php");
            } else {
                $mensaje = "Error al actualizar la contraseña: " . $update_stmt->error;
                $showAlert = true;
                $alertType = "error";
            }

            $update_stmt->close();
        }
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación Contraseña</title>
    <link rel="stylesheet" href="../inicio/iniciosesion.css">
    <link rel="shortcut icon" href="../imagenes/Logo1.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <img src="../imagenes/Logo.png" alt="Logo">
    <div class="atras">
        <a href="interfazDocente.php" class="btn-volver">
            <img class="atras" src="../imagenes/Devolverse.png" width="60px">
        </a>
    </div>
    <form action="restablecerContrasenaD.php" method="POST">
        <h2 class="ay">Restablecer Contraseña</h2>
        
        <div>
            <label for="Email">Email</label>
            <input type="text" id="Email" name="Email" required>
        </div>

        <div class="password-container">
            <label for="ID_Docente">Contraseña Actual</label>
            <div class="input-container">
                <img src="../imagenes/Icono-Ojo-Cerrado.png" alt="OJITO" id="ImagenContrasena" height="30px" width="30px" class="ojo">
                <input type="password" id="ID_Docente" name="ID_Docente" required>
            </div>
        </div>

        <div class="password-container">
            <label for="ID_DocenteN">Contraseña Nueva</label>
            <div class="input-container">
                <img src="../imagenes/Icono-Ojo-Cerrado.png" alt="OJITO" id="ImagenContrasena2" height="30px" width="30px" class="ojo">
                <input type="password" id="ID_DocenteN" name="ID_DocenteN" required>
            </div>
        </div>
        
        <div class="password-container">
            <label for="ID_DocenteC">Confirmar Contraseña</label>
            <div class="input-container">
                <img src="../imagenes/Icono-Ojo-Cerrado.png" alt="OJITO" id="ImagenContrasena3" height="30px" width="30px" class="ojo">
                <input type="password" id="ID_DocenteC" name="ID_DocenteC" required>
            </div>
        </div>
        
        <button class="Iniciar" type="submit">Actualizar</button>
    </form>
    
    <script>
        
        document.addEventListener('DOMContentLoaded', function() {
            <?php if ($showAlert): ?>
                Swal.fire({
                    icon: '<?php echo $alertType; ?>',
                    title: '<?php echo $alertType === "success" ? "Éxito" : "Error"; ?>',
                    text: '<?php echo $mensaje; ?>',
                    confirmButtonText: 'Aceptar'
                });
            <?php endif; ?>
        });

        
        function togglePasswordVisibility(inputId, iconId) {
            var input = document.getElementById(inputId);
            var icon = document.getElementById(iconId);
            icon.setAttribute("src", icon.getAttribute("src").includes("Cerrado") ? '../imagenes/Icono-Ojo-Abierto.png' : '../imagenes/Icono-Ojo-Cerrado.png');
            input.setAttribute("type", icon.getAttribute("src").includes("Cerrado") ? "password" : "text");
        }

        document.getElementById("ImagenContrasena").addEventListener("click", function() {
            togglePasswordVisibility("ID_Docente", "ImagenContrasena");
        });
        document.getElementById("ImagenContrasena2").addEventListener("click", function() {
            togglePasswordVisibility("ID_DocenteN", "ImagenContrasena2");
        });
        document.getElementById("ImagenContrasena3").addEventListener("click", function() {
            togglePasswordVisibility("ID_DocenteC", "ImagenContrasena3");
        });
    </script>
</body>
</html>
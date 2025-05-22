<?php
require "../otros/index.php";

session_start();

if(!isset($_SESSION['Rol'])) {
    header('Location: ../inicio/iniciosesion.php');
    exit();
}else if(isset($_SESSION['Rol'])){
    if($_SESSION['Rol']==='Admin'){
        header('Location: ../administrador/admin.php');
        exit();
    }else if($_SESSION['Rol']==='Docente'){
        header('Location: ../docente/interfazDocente.php');
        exit();
    }
}

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$response = array('success' => false, 'message' => '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricula = $_POST['NumeroMatricula'];
    $current_password = $_POST['Id_Estudiante'];
    $new_password = $_POST['Id_EstudianteN'];
    $confirm_new_password = $_POST['Id_EstudianteC'];

    if ($new_password != $confirm_new_password) {
        $response['message'] = 'Las nuevas contraseñas no coinciden.';
    } else {
        $stmt = $conn->prepare("SELECT Id_Estudiante FROM estudiantes WHERE NumeroMatricula = ?");
        $stmt->bind_param("s", $matricula);
        $stmt->execute();
        $stmt->bind_result($hashed_password_db);
        $stmt->fetch();
        $stmt->close();

        if (password_verify($current_password, $hashed_password_db)) {
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

            $update_stmt = $conn->prepare("UPDATE estudiantes SET Id_Estudiante = ? WHERE NumeroMatricula = ?");
            $update_stmt->bind_param("ss", $hashed_new_password, $matricula);

            if ($update_stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Contraseña actualizada correctamente';
            } else {
                $response['message'] = 'Error al actualizar la contraseña: ' . $update_stmt->error;
            }

            $update_stmt->close();
        } else {
            $response['message'] = 'La contraseña actual es incorrecta.';
        }
    }

    echo json_encode($response);
    exit;
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
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <img src="../imagenes/Logo.png" alt="Logo">
    <div class="atras">
        <a href="interfazEstudiante.php" class="btn-volver" id="volver">
            <img class="atras" src="../imagenes/Devolverse.png" width="60px">
        </a>
    </div>
    <form id="passwordForm" action="restablecerContrasena.php" method="POST">
        <h2 class="ay">Restablecer Contraseña</h2>
        
        <div>
            <label for="NumeroMatricula">Número de matricula</label>
            <input type="text" id="NumeroMatricula" name="NumeroMatricula" required>
        </div>

        <div class="password-container">
            <label for="Id_Estudiante">Contraseña Actual</label>
            <div class="input-container">
                <img src="../imagenes/Icono-Ojo-Cerrado.png" alt="OJITO" id="ImagenContrasena" height="30px" width="30px" class="ojo">
                <input type="password" id="Id_Estudiante" name="Id_Estudiante" required>
            </div>
        </div>

        <div class="password-container">
            <label for="Id_EstudianteN">Contraseña Nueva</label>
            <div class="input-container">
                <img src="../imagenes/Icono-Ojo-Cerrado.png" alt="OJITO" id="ImagenContrasena2" height="30px" width="30px" class="ojo">
                <input type="password" id="Id_Estudiante2" name="Id_EstudianteN" required>
            </div>
        </div>
        <div class="password-container">
            <label for="Id_EstudianteC">Confirmar Contraseña</label>
            <div class="input-container">
                <img src="../imagenes/Icono-Ojo-Cerrado.png" alt="OJITO" id="ImagenContrasena3" height="30px" width="30px" class="ojo">
                <input type="password" id="Id_Estudiante3" name="Id_EstudianteC" required>
            </div>
        </div>
        
        <button class="Iniciar" type="submit">Actualizar</button>
    </form>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var Imagen = document.getElementById("ImagenContrasena");
            var Imagen2 = document.getElementById("ImagenContrasena2");
            var Imagen3 = document.getElementById("ImagenContrasena3");

            function togglePasswordVisibility(imageElement, inputId) {
                imageElement.setAttribute("src", imageElement.getAttribute("src").includes("Cerrado") ? '../imagenes/Icono-Ojo-Abierto.png' : '../imagenes/Icono-Ojo-Cerrado.png');
                var passwordInput = document.getElementById(inputId);
                passwordInput.setAttribute("type", imageElement.getAttribute("src").includes("Cerrado") ? "password" : "text");
            }

            Imagen.addEventListener("click", function() {
                togglePasswordVisibility(Imagen, "Id_Estudiante");
            });

            if (Imagen2) {
                Imagen2.addEventListener("click", function() {
                    togglePasswordVisibility(Imagen2, "Id_Estudiante2");
                });
            }

            if (Imagen3) {
                Imagen3.addEventListener("click", function() {
                    togglePasswordVisibility(Imagen3, "Id_Estudiante3");
                });
            }

            
            var form = document.getElementById('passwordForm');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                fetch('restablecerContrasena.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: data.message
                        }).then(() => {
                            form.reset();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema al procesar la solicitud.'
                    });
                });
            });
        });
    </script>
</body>
</html>
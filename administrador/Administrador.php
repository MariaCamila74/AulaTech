<?php
require "../otros/index.php";

session_start();

if(!isset($_SESSION['Rol'])) {
    header('Location: ../inicio/iniciosesion.php');
    exit();
}else if(isset($_SESSION['Rol'])){
    if($_SESSION['Rol']==='Estudiante'){
        header('Location: ../estudiante/interfazEstudiante.php');
        exit();
    }else if($_SESSION['Rol']==='Docente'){
        header('Location: ../docente/interfazDocente.php');
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['Correo'];
    $nombreCompleto = $_POST['NombreCompleto'];
    $telefono = $_POST['Telefono'];
    $cargo = $_POST['Cargo'];
    $Contrasena = $_POST['Contrasena'];

    if (strlen($Contrasena) >= 12 && preg_match('/[^a-zA-Z\d]/', $Contrasena)) {
        $Contrasena = password_hash($Contrasena, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO `administrador`(`NombreCompleto`,`Correo`,`Contrasena`,`Telefono`,`Cargo`,`Rol`) VALUES (?,?,?,?,?,'Administrador')");
        
        if ($stmt === false) {
            $_SESSION['mensajeError'] = "Error en la preparación de la consulta: " . $conn->error;
        } else {
            $stmt->bind_param("sssis", $nombreCompleto, $email, $Contrasena, $telefono, $cargo);
            if ($stmt->execute()) {
                $_SESSION['mensajeExito'] = 'Administrador registrado exitosamente';
                header('Location: Administrador.php'); 
                exit();
            } else {
                $_SESSION['mensajeError'] = "Error al ingresar el administrador: " . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        $_SESSION['mensajeError'] = "La contraseña debe tener al menos 12 caracteres y un carácter especial.";
    }
}

$sql = "SELECT * FROM docentes";
$result = $conn->query($sql);
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - Admin</title>
    <link rel="stylesheet" href="../inicio/registrarse.css">
    <link rel="shortcut icon" href="../imagenes/Logo1.png" type="image/x-icon">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <img src="../imagenes/Logo.png" alt="Logo" class="logo">
    <div class="atras">
        <a href="admin.php" class="btn-volver">
            <img class="atras" src="../imagenes/Devolverse.png">
        </a>
    </div>
    <form action="Administrador.php" method="POST" class="formulario" onsubmit="return validarFormulario()">
        <h2>Registrar Administrador</h2>
        <div class="container">
            <div class="form-container">
                <label for="Correo">Email</label>
                <input type="email" id="Correo" name="Correo" required>
            </div>
            <div class="form-container">
                <label for="NombreCompleto">Nombre Completo</label>
                <input type="text" id="NombreCompleto" name="NombreCompleto" required>
            </div>
            <div class="form-container">
                <label for="Telefono">Teléfono</label>
                <input type="tel" id="Telefono" name="Telefono" required>
            </div>
            <div class="form-container">
                <label for="Cargo">Cargo</label>
                <input type="text" id="Cargo" name="Cargo" required>
            </div>
            <div class="form-container">
                <label for="Contrasena">Contraseña</label>
                <div class="password-container">
                    <input type="password" id="Contrasena" name="Contrasena" required>
                    <img src="../imagenes/Icono-Ojo-Cerrado.png" alt="Mostrar/Ocultar contraseña" id="ImagenContrasena">
                </div>
            </div>
        </div>

        <button class="Iniciar" type="submit">Registrar</button>
    </form>

    <script>
        function validarFormulario() {
            const passwordField = document.getElementById('Contrasena');
            const password = passwordField.value;
            const regexSpecial = /[^a-zA-Z\d]/;

            if (password.length < 12 || !regexSpecial.test(password)) {
                swal("Error", "La contraseña debe tener al menos 12 caracteres y un carácter especial.", "error");
                passwordField.style.border = "2px solid red";
                return false; // Previene el envío del formulario
            } else {
                passwordField.style.border = "2px solid green";
                return true;
            }
        }

        document.getElementById('Contrasena').addEventListener('input', function() {
            const passwordField = this;
            const password = passwordField.value;
            const regexSpecial = /[^a-zA-Z\d]/;

            if (password.length >= 12 && regexSpecial.test(password)) {
                passwordField.style.border = "2px solid green";
            } else {
                passwordField.style.border = "2px solid red";
            }
        });

        document.getElementById('ImagenContrasena').addEventListener('click', function() {
            const passwordField = document.getElementById('Contrasena');
            const passwordFieldType = passwordField.getAttribute('type');

            if (passwordFieldType === 'password') {
                passwordField.setAttribute('type', 'text');
                this.src = '../imagenes/Icono-Ojo-Abierto.png'; 
            } else {
                passwordField.setAttribute('type', 'password');
                this.src = '../imagenes/Icono-Ojo-Cerrado.png'; 
            }
        });

        <?php if (isset($_SESSION['mensajeExito'])): ?>
            swal("Éxito", "<?php echo $_SESSION['mensajeExito']; ?>", "success");
            <?php unset($_SESSION['mensajeExito']); ?>
        <?php elseif (isset($_SESSION['mensajeError'])): ?>
            swal("Error", "<?php echo $_SESSION['mensajeError']; ?>", "error");
            <?php unset($_SESSION['mensajeError']); ?>
        <?php endif; ?>
    </script>
</body>
</html>

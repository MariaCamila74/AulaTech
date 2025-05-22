<?php
require "../otros/index.php";
session_start();
if (!isset($_SESSION['Rol'])) {
    header('Location: ../inicio/iniciosesion.php');
    exit();
} else if (isset($_SESSION['Rol'])) {
    if ($_SESSION['Rol'] === 'Estudiante') {
        header('Location: ../estudiante/interfazEstudiante.php');
        exit();
    } else if ($_SESSION['Rol'] === 'Docente') {
        header('Location: ../docente/interfazDocente.php');
        exit();
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreCompleto = $_POST['nombrecompleto'];
    $numeroMatricula = $_POST['NumeroMatricula'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $idEstudiante = $_POST['Id_Estudiante'];
    $grupo = $_POST['grupo'];
    if (strlen($idEstudiante) >= 12 && preg_match('/[^a-zA-Z\d]/', $idEstudiante)) {
        $idEstudianteHashed = password_hash($idEstudiante, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO estudiantes (NombreApellido, NumeroMatricula, Telefono, Email, Id_Estudiante, Grado, Rol) VALUES (?, ?, ?, ?, ?, ?, 'Estudiante')");
        if ($stmt === false) {
            $_SESSION['mensajeError'] = "Error en la preparación de la consulta: " . $conn->error;
        } else {
            $stmt->bind_param("siissi", $nombreCompleto, $numeroMatricula, $telefono, $email, $idEstudianteHashed, $grupo);
            if ($stmt->execute()) {
                $_SESSION['mensajeExito'] = 'Estudiante registrado exitosamente';
                header('Location: Estudiante.php');
                exit();
            } else {
                $_SESSION['mensajeError'] = "Error al registrar estudiante: " . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        $_SESSION['mensajeError'] = "La contraseña debe tener al menos 12 caracteres y un carácter especial.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - Estudiante</title>
    <link rel="stylesheet" href="../inicio/registrarse.css">
    <link rel="shortcut icon" href="../imagenes/Logo1.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <img src="../imagenes/Logo.png" alt="Logo" class="logo">
    <div class="atras">
        <a href="admin.php" class="btn-volver">
            <img class="atras" src="../imagenes/Devolverse.png">
        </a>
    </div>
    <form action="Estudiante.php" method="POST" class="formulario" onsubmit="return validarFormulario()">
        <h2>Registrar Estudiante</h2>
        <div class="container">
            <div class="form-container">
                <label for="nombrecompleto">Nombre Completo</label>
                <input type="text" id="nombrecompleto" name="nombrecompleto" required>
            </div>
            <div class="form-container">
                <label for="username">Matrícula</label>
                <input type="number" id="NumeroMatricula" name="NumeroMatricula" required>
            </div>
            <div class="form-container">
                <label for="telefono">Teléfono</label>
                <input type="tel" id="telefono" name="telefono" required>
            </div>
            <div class="form-container">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="grupo">Grupo</label>
                <select name="grupo" id="grupo" required>
                    <option value="" disabled selected>Seleccione su grupo</option>
                    <option value="401">401</option>
                    <option value="402">402</option>
                    <option value="403">403</option>
                    <option value="404">404</option>
                    <option value="405">405</option>
                    <option value="406">406</option>
                    <option value="407">407</option>
                    <option value="501">501</option>
                    <option value="502">502</option>
                    <option value="503">503</option>
                    <option value="504">504</option>
                    <option value="505">505</option>
                    <option value="506">506</option>
                    <option value="507">507</option>
                    <option value="601">601</option>
                    <option value="602">602</option>
                    <option value="603">603</option>
                    <option value="604">604</option>
                    <option value="605">605</option>
                    <option value="606">606</option>
                    <option value="607">607</option>
                    <option value="701">701</option>
                    <option value="702">702</option>
                    <option value="703">703</option>
                    <option value="704">704</option>
                    <option value="705">705</option>
                    <option value="706">706</option>
                    <option value="707">707</option>
                    <option value="801">801</option>
                    <option value="802">802</option>
                    <option value="803">803</option>
                    <option value="804">804</option>
                    <option value="805">805</option>
                    <option value="806">806</option>
                    <option value="807">807</option>
                    <option value="901">901</option>
                    <option value="902">902</option>
                    <option value="903">903</option>
                    <option value="904">904</option>
                    <option value="905">905</option>
                    <option value="906">906</option>
                    <option value="907">907</option>
                    <option value="1001">1001</option>
                    <option value="1002">1002</option>
                    <option value="1003">1003</option>
                    <option value="1004">1004</option>
                    <option value="1005">1005</option>
                    <option value="1006">1006</option>
                    <option value="1007">1007</option>
                    <option value="1101">1101</option>
                    <option value="1102">1102</option>
                    <option value="1103">1103</option>
                    <option value="1104">1104</option>
                    <option value="1105">1105</option>
                    <option value="1106">1106</option>
                    <option value="1107">1107</option>
                </select>
            </div>
            <div class="form-container">
                <label for="password">Contraseña</label>
                <div class="password-container">
                    <input type="password" id="Id_Estudiante" name="Id_Estudiante" required>
                    <img src="../imagenes/Icono-Ojo-Cerrado.png" alt="Mostrar/Ocultar contraseña" id="ImagenContrasena">
                </div>
            </div>
        </div>
        <button class="Iniciar" type="submit">Registrar</button>
    </form>
    <script>
        function validarFormulario() {
            const passwordField = document.getElementById('Id_Estudiante');
            const password = passwordField.value;
            const regexSpecial = /[^a-zA-Z\d]/;
            if (password.length < 12 || !regexSpecial.test(password)) {
                Swal.fire("Error", "La contraseña debe tener al menos 12 caracteres y un carácter especial.", "error");
                passwordField.style.border = "2px solid red";
                return false; 
            } else {
                passwordField.style.border = "2px solid green";
                return true;
            }
        }
        document.getElementById('Id_Estudiante').addEventListener('input', function() {
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
            const passwordField = document.getElementById('Id_Estudiante');
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
            Swal.fire("Éxito", "<?php echo $_SESSION['mensajeExito']; ?>", "success");
            <?php unset($_SESSION['mensajeExito']); ?>
        <?php elseif (isset($_SESSION['mensajeError'])): ?>
            Swal.fire("Error", "<?php echo $_SESSION['mensajeError']; ?>", "error");
            <?php unset($_SESSION['mensajeError']); ?>
        <?php endif; ?>
    </script>
</body>
</html>

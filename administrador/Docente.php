<?php
require "../otros/index.php";

session_start();

if (!isset($_SESSION['Rol'])) {
    header('Location: ../inicio/iniciosesion.php');
    exit();
} else if (isset($_SESSION['Rol'])) {
    if ($_SESSION['Rol'] === 'Admin') {
        header('Location: ../administrador/admin.php');
        exit();
    } else if ($_SESSION['Rol'] === 'Docente') {
        header('Location: ../docente/interfazDocente.php');
        exit();
    }
}

$alertScript = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['Email'];
    $nombreCompleto = $_POST['NombreCompleto'];
    $telefono = $_POST['Telefono'];
    
    $idDocente = $_POST['ID_Docente'];

    if (strlen($idDocente) < 12 || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $idDocente)) {
        $alertScript = "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Contraseña no válida',
                    text: 'La contraseña debe tener al menos 12 caracteres y un carácter especial.',
                    confirmButtonText: 'Aceptar'
                });
            </script>";
    } else {
        $idDocente = password_hash($idDocente, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO `docentes`(`Email`, `NombreCompleto`, `Telefono`, `ID_Docente`, `Rol`) VALUES (?,?,?,?,'Docente')");
        
        if ($stmt === false) {
            $alertScript = "
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un error en la preparación de la consulta: " . $conn->error . "',
                        confirmButtonText: 'Aceptar'
                    });
                </script>";
        } else {
            $stmt->bind_param("ssis", $email, $nombreCompleto, $telefono, $idDocente);
            if ($stmt->execute()) {
                $alertScript = "
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Docente registrado',
                            text: 'Docente registrado exitosamente',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'Docente.php';
                            }
                        });
                    </script>";
            } else {
                $alertScript = "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un error al ingresar el Docente: " . $stmt->error . "',
                            confirmButtonText: 'Aceptar'
                        });
                    </script>";
            }
            $stmt->close();
        }
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
    <title>Administrador - Docentes</title>
    <link rel="stylesheet" href="../inicio/registrarse.css">
    <link rel="shortcut icon" href="../imagenes/Logo1.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .input-invalido {
            border-color: red;
            border-width: 2px;
        }
        .input-valido {
            border-color: green;
            border-width: 2px;
        }
    </style>
</head>

<body>
    <img src="../imagenes/Logo.png" alt="Logo" class="logo">
    <div class="atras">
        <a href="admin.php" class="btn-volver">
            <img class="atras" src="../imagenes/Devolverse.png">
        </a>
    </div>
    <form action="Docente.php" method="POST" class="formulario">
        <h2>Registrar Docente</h2>
        <div class="container">
            <div class="form-container">
                <label for="Email">Email</label>
                <input type="email" id="Email" name="Email" required>
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
                <label for="password">Contraseña</label>
                <div class="password-container">
                    <input type="password" id="ID_Docente" name="ID_Docente" required>
                    <img src="../imagenes/Icono-Ojo-Cerrado.png" alt="Mostrar/Ocultar contraseña" id="ImagenContrasena">
                </div>
            </div>
        </div>

        <button class="Iniciar" type="submit">Registrar</button>
    </form>

    <table id="datosTabla">
        <h2 class="Docente">Docentes registrados</h2>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Nombre Completo</th>
            <th>Teléfono</th>
            <th class="Eliminar">Eliminar</th>
        </tr>
        <tbody>
            <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['NombreCompleto']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Telefono']) . "</td>";
                        echo "<td><button onclick=\"confirmarEliminacion(" . htmlspecialchars($row['ID']) . ")\">Eliminar</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No hay datos registrados</td></tr>";
                }
            ?>
        </tbody>
    </table>

    <script>
        document.getElementById('ImagenContrasena').addEventListener('click', function() {
            var passwordField = document.getElementById('ID_Docente');
            var passwordFieldType = passwordField.getAttribute('type');

            if (passwordFieldType === 'password') {
                passwordField.setAttribute('type', 'text');
                this.src = '../imagenes/Icono-Ojo-Abierto.png'; 
            } else {
                passwordField.setAttribute('type', 'password');
                this.src = '../imagenes/Icono-Ojo-Cerrado.png'; 
            }
        });

        document.getElementById('ID_Docente').addEventListener('input', function() {
            var password = this.value;
            var isValid = password.length >= 12 && /[!@#$%^&*(),.?":{}|<>]/.test(password);
            if (isValid) {
                this.classList.remove('input-invalido');
                this.classList.add('input-valido');
            } else {
                this.classList.remove('input-valido');
                this.classList.add('input-invalido');
            }
        });

        function confirmarEliminacion(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esta acción no se puede revertir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'eliminar2.php?ID=' + id;
                }
            });
        }
    </script>

    <?php
    if ($alertScript !== "") {
        echo $alertScript;
    }
    ?>
</body>

</html>

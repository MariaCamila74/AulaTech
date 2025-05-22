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

$username = $_SESSION['username']; // Se asume que el username está almacenado en la sesión
$stmt = $conn->prepare("SELECT NombreApellido, Grado FROM estudiantes WHERE NumeroMatricula = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($nombre, $grupo);
$stmt->fetch();
$stmt->close();

// Inicializamos la variable $mensaje
$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $serie = $_POST['NumeroSerie'];
    $marca = $_POST['MarcaComputador'];

    $stmt = $conn->prepare("INSERT INTO `computadoresusados`(`Nombre`, `NumeroSerie`, `MarcaComputador`,`Grupo`) VALUES (?, ?, ?, ?)");
    
    if ($stmt === false) {
        $mensaje = "Error en la preparación de la consulta: " . $conn->error;
    } else {
        $stmt->bind_param("sisi", $nombre, $serie, $marca, $grupo);
        if ($stmt->execute()) {
            $mensaje = "¡Registro exitoso!";
        } else {
            $mensaje = "Error al registrar estudiante: " . $stmt->error;
        }
    }
}

// Preparar una nueva consulta para seleccionar los registros
$stmt = $conn->prepare("SELECT * FROM computadoresusados WHERE Grupo = ?");
$stmt->bind_param("i", $grupo);
$stmt->execute();
$result = $stmt->get_result();

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computadores Usados</title>
    <link rel="stylesheet" href="computadoresUsados.css">
    <link rel="shortcut icon" href="../imagenes/Logo1.png" type="image/x-icon">
    <script src="../inicio/incio.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<header>
    <div class="logo-nombre">
        <img src="../imagenes/Logo1.png" alt="Logo" class="logo">
    </div>
    <nav class="navbar hidden" id="navbar">
        <ul class="menu">
            <li><a href="interfazEstudiante.php">Inicio</a></li>
            <li><a href="computadoresUsados.php">Historial de Computadores</a></li>
            <li><a href="actividadesPendientes1.php">Actividades</a></li>
            <li><a href="restablecerContrasena.php">Restablecer Contraseña</a></li>
            <li><a href="../otros/logout.php" id="logout">Cerrar sesión</a></li>
        </ul>
    </nav>
    <img src="../imagenes/menu.png" alt="NavBar" class="menuH show" id="menuH">
</header>

<div class="container">
    <h2 class="titulo">Registro de Información</h2>
    <form action="computadoresUsados.php" method="POST" id="registroForm">
        <div class="form-group">
            <label for="NumeroSerie">Número de Serie:</label>
            <input type="number" id="NumeroSerie" name="NumeroSerie" required>
        </div>
        <div class="form-group">
            <label for="MarcaComputador">Marca del Computador:</label>
            <select name="MarcaComputador" id="MarcaComputador" require>
                <option value="" disabled selected>Seleccione la marca del computador</option>
                <option value="Acer">Acer</option>
                <option value="Lenovo">Lenovo</option>
                <option value="HP">HP</option>
            </select>
        </div>
        <button type="submit">Registrar</button>
    </form>

    <h2 class="titulo">Datos Registrados</h2>
    <table id="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Serie</th>
                <th>Marca</th>
                <th>Grupo</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Nombre']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['NumeroSerie']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['MarcaComputador']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Grupo']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No hay datos registrados</td></tr>";
                }
            ?>
        </tbody>
    </table>
</div>

<footer>
        <div class="footer-content">
            <div class="footer-info">
                <div class="footer-section">
                    <h4>Nombres de creadores</h4>
                    <p>Mesa Toro Juan Camilo</p>
                    <p>Monsalve Lopera Josué</p>
                    <p>Muñoz Arteaga Miller Santiago</p>
                    <p>Ortiz Maria Camila</p>
                </div>
                <div class="footer-section">
                    <h4>Redes Sociales</h4>
                    <p>Facebook: <a href="https://www.facebook.com/share/K4UHXvcXzuzLEsnT/?mibextid=LQQJ4d" target="_blank">IE San Antonio de Prado</a></p>
                    <p>Instagram: <a href="https://www.instagram.com/i.e.sadep?igsh=MWYzaGJtemxzZXN5aQ==" target="_blank">IE San Antonio de Prado</a></p>
                    <p>Correo: <a href="https://wwww.gmail.com" target="_blank">mediatecnicasadep@gmail.com</a></p>
                </div>
            </div>
            <div class="footer-logo">
                <img src="../imagenes/Logo1.png" alt="Logo" class="footer-logo-img">
            </div>
        </div>
</footer>


<?php if (!empty($mensaje)) : ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: '<?php echo $mensaje === "¡Registro exitoso!" ? "Éxito" : "Error"; ?>',
                text: '<?php echo $mensaje; ?>',
                icon: '<?php echo $mensaje === "¡Registro exitoso!" ? "success" : "error"; ?>',
                confirmButtonText: 'OK'
            });
        });
    </script>
<?php endif; ?>

</body>
</html>


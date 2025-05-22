<?php
require "../otros/index.php";
session_start();

// Verificación de la sesión y redirecciones
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

// Obtener el nombre y grupo del estudiante desde la base de datos
$username = $_SESSION['username']; // Se asume que el username está almacenado en la sesión
$stmt = $conn->prepare("SELECT NombreApellido, Grado FROM estudiantes WHERE NumeroMatricula = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($nombre, $grupo);
$stmt->fetch();
$stmt->close();

$response = array('success' => false, 'message' => '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descripcion = $_POST['Descripcion'];
    $entrega = $_POST['FechaEntrega'];
    $file_name = $_FILES['Documentos']['name'];
    $file_tmp = $_FILES['Documentos']['tmp_name'];
    $route = "../docente/actividadesPend/documentos/estudiantes/" . $file_name;
    move_uploaded_file($file_tmp, $route);

    // Subir los datos a la tabla actividadesrealizadas
    $stmt = $conn->prepare("INSERT INTO `actividadesrealizadas`(`Grupo`, `Descripcion`, `Documento`, `FechaEntrega`, `NombreApellido`) VALUES (?, ?, ?, ?,?)");
    if ($stmt === false) {
        $response['message'] = 'Error: ' . $conn->error;
    } else {
        $stmt->bind_param("issss", $grupo, $descripcion, $file_name, $entrega, $nombre);
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Su tarea se subió correctamente.';
        } else {
            $response['message'] = 'Error al subir su tarea: ' . $stmt->error;
        }
        $stmt->close();
    }

    echo json_encode($response);
    exit();
}

$stmt = $conn->prepare("SELECT Descripcion, Documento, FechaEntrega FROM actividadespendientes WHERE Grupo = ?");
$stmt->bind_param("i", $grupo);
$stmt->execute();
$result = $stmt->get_result();

// Cerrar la conexión
$conn->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividades Pendientes</title>
    <link rel="stylesheet" href="../docente/actividadesPendientes.css">
    <link rel="shortcut icon" href="../imagenes/Logo1.png" type="image/x-icon">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
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
        <h2 class="titulo">Actividades pendientes</h2>
        <table id="task-table">
            <thead>
                <tr>
                    <th>Grupo</th>
                    <th>Descripción de la Actividad</th>
                    <th>Documento</th>
                    <th>Fecha de Entrega</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $grupo . "</td>";
                            echo "<td>" . htmlspecialchars($row['Descripcion']) . "</td>";
                            
                            $extension = pathinfo($row['Documento'], PATHINFO_EXTENSION);
                                
                            if ($extension == 'pdf') {
                                echo "<td><embed src='../docente/actividadesPend/documentos/docentes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px' type='application/pdf'></td>";
                            } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                                echo "<td><img src='../docente/actividadesPend/documentos/docentes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px'></td>";
                            } else {
                                echo "<td><a href='../docente/actividadesPend/documentos/docentes/" . htmlspecialchars($row['Documento']) . "' target='_blank'>Ver Documento</a></td>";
                            }

                            echo "<td>" . htmlspecialchars($row['FechaEntrega']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No hay datos registrados</td></tr>";
                    }
                ?>
            </tbody>
        </table>
        <h2 class="titulo" id="titulo">Subir actividades realizadas</h2>
        <form id="activityForm" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <div class="form-group">
                    <label for="Descripcion">Descripción</label>
                    <input type="text" id="Descripcion" name="Descripcion" required>
                </div>
                <div class="form-group">
                    <label for="Documentos">Documento</label>
                    <input type="file" id="Documentos" name="Documentos">
                </div>
                <div class="form-group">
                    <label for="FechaEntrega">Fecha de Entrega</label>
                    <input type="date" id="FechaEntrega" name="FechaEntrega" required>
                </div>
                <button type="submit">Agregar</button>
            </div>
        </form>
    </div>
    <br><br><br><br><br>
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
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuH = document.getElementById("menuH");
            const navbar = document.getElementById("navbar");

            if (menuH) { 
                menuH.addEventListener("click", () => {
                    navbar.classList.toggle("hidden"); 
                    navbar.classList.toggle("show");

                    if (navbar.classList.contains("show")) {
                        menuH.src = "../imagenes/Icono-Cancelar.png";
                    } else {
                        menuH.src = "../imagenes/menu.png";
                    }
                });
            }
        });
        const form = document.getElementById('activityForm');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('actividadesPendientes1.php', {
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
                        location.reload(); 
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
    </script>
</body>
</html>
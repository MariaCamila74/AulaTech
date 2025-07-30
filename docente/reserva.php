<?php
session_start();
require "../otros/index.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $Sala = $_POST['NombreSala'];
    $Fecha = $_POST['FechaHora'];

    $stmtCheck = $conn->prepare("SELECT COUNT(*) as total FROM sala WHERE NombreSala = ? AND FechaHora = ?");
    
    if ($stmtCheck === false) {
        die("Error en la preparación de la consulta de verificación: " . $conn->error);
    }
    
    $stmtCheck->bind_param("ss", $Sala, $Fecha);
    $stmtCheck->execute();
    $result = $stmtCheck->get_result();
    $row = $result->fetch_assoc();
    $stmtCheck->close();
    
    if ($row['total'] > 0) {
        // La sala ya está reservada en esa fecha/hora
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => 'La sala ya se encuentra reservada, si desea reservar para este día intenta con la Sala 2'
        ]);
        exit();
    }

    // Si no está reservada, procedemos con la inserción
    $stmt = $conn->prepare("INSERT INTO sala (NombreSala, FechaHora) VALUES (?, ?)");
    
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    
    $stmt->bind_param("ss", $Sala, $Fecha);

    if ($stmt->execute()) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'message' => 'Reserva completada con éxito'
        ]); 
        exit();
    } else {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => 'Error al reservar la sala'
        ]) . $stmt->error;
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
    <title>Reservar Sala</title>
    <link rel="stylesheet" href="actividadesPendientes.css">
    <link rel="shortcut icon" href="../imagenes/Logo1.png" type="image/x-icon">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    <header>
        <div class="logo-nombre">
            <img src="../imagenes/Logo1.png" alt="Logo" class="logo">
        </div>
        <nav class="navbar hidden" id="navbar">
            <ul class="menu">
                <li><a href="InterfazDocente.php">Inicio</a></li>
                <li><a href="">Reservar Sala</a></li>
                <li><a href="historiales.html">Historiales</a></li>
                <li><a href="actividadesPendientes.php">Actividades</a></li>
                <li><a href="restablecerContrasenaD.php">Restablecer Contraseña</a></li>
                <li><a href="../otros/logout.php" id="logout">Cerrar sesión</a></li>
            </ul>
        </nav>
        <img src="../imagenes/menu.png" alt="NavBar" class="menuH show" id="menuH">
    </header>
    <div class="container">
        <br><br><br><br><br><br>
        <h2 class="titulo">Salas</h2>
        <form id="activityForm" method="POST" action="reserva.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Grupo">Grupo</label>
                <select name="NombreSala" id="Grupo" required>
                    <option value="" disabled selected>Seleccione la sala que desea reservar</option>
                    <option value="Sala1">Sala 1</option>
                    <option value="Sala2">Sala 2</option>
                </select>
            </div>
            <div class="form-group">
                <label for="FechaHora">Fecha de la reserva</label>
                <input type="date" id="FechaHora" name="FechaHora" required>
            </div>
            <button type="submit">Reservar</button>
        </form>
        <!-- <table>
            <h2>Reservas Realizadas</h2>
            <thead>
                <tr>
                    <th>Día</th>
                    <th>Sala</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Undécimos</td>
                    <td><button onclick="window.location.href='actividadesPend/undecimos.php'">Ver</button></td>
                </tr>
            </tbody>
        </table> -->
    </div>
    <br><br><br><br><br><br>

    <footer>
        <div class="footer-content">
            <div class="footer-info">
                <div class="footer-section">
                    <h4>Nombres de creadores</h4>
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

            function calcularFechaMinima() {
                const hoy = new Date();
                let diasAgregados = 0;
                let fechaMinima = new Date(hoy);
                
                while (diasAgregados < 4) {
                    fechaMinima.setDate(fechaMinima.getDate() + 1);
                    
                    if (fechaMinima.getDay() !== 0) {
                        diasAgregados++;
                    }
                }
                
                return fechaMinima;
            }

            // Configurar fecha mínima
            const fechaInput = document.getElementById('FechaHora');
            const fechaMinima = calcularFechaMinima();
            
            const formatDate = (date) => {
                const d = new Date(date);
                let month = '' + (d.getMonth() + 1);
                let day = '' + d.getDate();
                const year = d.getFullYear();

                if (month.length < 2) month = '0' + month;
                if (day.length < 2) day = '0' + day;

                return [year, month, day].join('-');
            };

            fechaInput.min = formatDate(fechaMinima);

            // Manejo del formulario
            const form = document.getElementById('activityForm');
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                fetch('reserva.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.json();
                })
                .then(data => {
                    Swal.fire({
                        icon: data.success ? 'success' : 'error',
                        title: data.success ? '¡Reserva exitosa!' : 'Sala no disponible',
                        text: data.message,
                        confirmButtonText: 'Aceptar'
                    }).then(() => {
                        if (data.success) form.reset(); // Limpia el formulario si fue exitosa
                    });
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error en la reserva',
                        text: error.message,
                        confirmButtonText: 'Entendido'
                    });
                });
            });
        });
    </script>
</body>
</html>
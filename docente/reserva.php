<?php
session_start();
require "../otros/index.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $NombreSala = $_POST['NombreSala'];
    $FechaHora = $_POST['FechaHora'];

   
    $stmt = $conn->prepare("INSERT INTO sala (NombreSala, FechaHora) VALUES (?, ?)");
    
    if ($stmt === false) {
        $errorConsulta = "Error en la preparación de la consulta: " . $conn->error;
    } else {
        $stmt->bind_param("ss", $NombreSala, $FechaHora);

        
        if ($stmt->execute()) {
            echo("Rserva completada con exito"); 
            exit();
        } else {
            
            $errorRegistrar = "Error al reservar sala " . $stmt->error;
        }

        $stmt->close();
    }

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
                <select name="Grupo" id="Grupo" required>
                    <option value="" disabled selected>Seleccione la sala que desea reservar</option>
                    <option value="NombreSala">Sala 1</option>
                    <option value="NombreSala">Sala 2</option>
                </select>
            </div>
            <div class="form-group">
                <label for="FechaHora">Fecha de la reserva</label>
                <input type="FechaHora" id="FechaHora" name="FechaHora" required>
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

            // Configuración del campo de fecha
            const fechaInput = document.getElementById('FechaEntrega');
            const fechaMinima = calcularFechaMinima();
            
            // Formatear para input date (YYYY-MM-DD)
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
            
            const form = document.getElementById('activityForm');
            form.addEventListener('submit', function(e) {
                const selectedDate = new Date(fechaInput.value);
                const dayOfWeek = selectedDate.getDay();
                
                // Validar anticipación mínima de 3 días hábiles
                const hoy = new Date();
                hoy.setHours(0, 0, 0, 0);
                
                let diasHabiles = 0;
                let fechaTemp = new Date(hoy);
                
                while (fechaTemp < selectedDate) {
                    fechaTemp.setDate(fechaTemp.getDate() + 1);
                    if (fechaTemp.getDay() !== 0) {
                        diasHabiles++;
                    }
                }

                // Si pasa las validaciones, continuar con el envío
                const formData = new FormData(this);

                fetch('actividadesPendientes.php', {
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
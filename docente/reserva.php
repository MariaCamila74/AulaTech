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
        <form id="activityForm" method="POST" action="#" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Grupo">Grupo</label>
                <select name="Grupo" id="Grupo" required>
                    <option value="" disabled selected>Seleccione la sala que desea reservar</option>
                    <option value="">Sala 1</option>
                    <option value="">Sala 2</option>
                </select>
            </div>
            <div class="form-group">
                <label for="FechaEntrega">Fecha de la reserva</label>
                <input type="date" id="FechaEntrega" name="FechaEntrega" required>
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

            // Configuración del campo de fecha
            const fechaInput = document.getElementById('FechaEntrega');
            
            // Establecer fecha mínima (3 días a partir de hoy)
            const hoy = new Date();
            const minDate = new Date();
            minDate.setDate(hoy.getDate() + 3);
            
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

            fechaInput.min = formatDate(minDate);
            
            // Validar que no sea domingo al enviar el formulario
            const form = document.getElementById('activityForm');
            form.addEventListener('submit', function(e) {
                const selectedDate = new Date(fechaInput.value);
                const dayOfWeek = selectedDate.getDay(); // 0 es domingo, 6 es sábado
                
                if (dayOfWeek === 0) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se permiten reservas los domingos.'
                    });
                    return;
                }
                
                // Validar anticipación mínima de 3 días
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                const diffTime = selectedDate - today;
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                
                if (diffDays < 3) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Debes seleccionar una fecha con al menos 3 días de anticipación.'
                    });
                    return;
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

            // Deshabilitar domingos en el selector de fecha
            fechaInput.addEventListener('input', function() {
                const selectedDate = new Date(this.value);
                const dayOfWeek = selectedDate.getDay();
                
                if (dayOfWeek === 0) {
                    this.value = '';
                    Swal.fire({
                        icon: 'warning',
                        title: 'Domingo no permitido',
                        text: 'Por favor selecciona un día entre lunes y sábado.'
                    });
                }
            });
        });
    </script>
</body>
</html>
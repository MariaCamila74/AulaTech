<?php

session_start();

if(!isset($_SESSION['Rol'])) {
    header('Location: ../inicio/iniciosesion.php');
    exit();
}else if(isset($_SESSION['Rol'])){
    if($_SESSION['Rol']==='Admin'){
        header('Location: ../administrador/admin.php');
        exit();
    }else if($_SESSION['Rol']==='Estudiante'){
        header('Location: ../estudiante/interfazEstudiante.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario y Grados</title>
    <link rel="stylesheet" href="estudianteEquipo.css">
    <link rel="shortcut icon" href="../imagenes/Logo1.png" type="image/x-icon">
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
        
        <div class="table-container">
            <h3>Historial De Computadores Por Grupo</h3>
            <table>
                <thead>
                    <tr>
                        <th>Grado</th>
                        <th>Ver más</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Cuartos</td>
                        <td><button onclick="window.location.href='cuarto.php'">Ver</button></td>
                    </tr>
                    <tr>
                        <td>Quintos</td>
                        <td><button onclick="window.location.href='quinto.php'">Ver</button></td>
                    </tr>
                    <tr>
                        <td>Sextos</td>
                        <td><button onclick="window.location.href='sexto.php'">Ver</button></td>
                    </tr>
                    <tr>
                        <td>Septimos</td>
                        <td><button onclick="window.location.href='septimo.php'">Ver</button></td>
                    </tr>
                    <tr>
                        <td>Octavos</td>
                        <td><button onclick="window.location.href='octavo.php'">Ver</button></td>
                    </tr>
                    <tr>
                        <td>Novenos</td>
                        <td><button onclick="window.location.href='noveno.php'">Ver</button></td>
                    </tr>
                    <tr>
                        <td>Décimos</td>
                        <td><button onclick="window.location.href='decimo.php'">Ver</button></td>
                    </tr>
                    <tr>
                        <td>Undécimo</td>
                        <td><button onclick="window.location.href='undecimo.php'">Ver</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
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

    <script>
        document.getElementById('num-estudiantes').addEventListener('change', function () {
            const numEstudiantes = this.value;
            const contenedorNombres = document.getElementById('nombres-estudiantes');
            contenedorNombres.innerHTML = '';

            for (let i = 0; i < numEstudiantes; i++) {
                const label = document.createElement('label');
                label.textContent = `Nombre del Estudiante ${i + 1}:`;
                const input = document.createElement('input');
                input.type = 'text';
                input.name = `nombre-estudiante-${i + 1}`;
                input.required = true;

                contenedorNombres.appendChild(label);
                contenedorNombres.appendChild(input);
            }
        });
    </script>
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
        </script>
</body>
</html>

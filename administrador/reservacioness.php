<?php

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

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios</title>
    <link rel="stylesheet" href="../inicio/servicios.css">
    <script src="inicio.js"></script>
    <script src="carrusel.js"></script>
    <link rel="shortcut icon" href="../imagenes/Logo1.png" type="image/x-icon">
</head>

<body>
    <header>
        <div class="logo-nombre">
            <img src="../imagenes/Logo1.png" alt="Logo" class="logo">
        </div>
        <nav class="navbar hidden" id="navbar">
            <ul class="menu">
                <li><a href="admin.php">Inicio</a></li>
                <li><a href="registrar.php">Registrar</a></li>
                <li><a href="reservacioness.php">Reservas de Salas</a></li>
                <li><a href="../otros/logout.php" id="logout">Cerrar sesión</a></li>
            </ul>
        </nav>
        <img src="../imagenes/menu.png" alt="NavBar" class="menuH show" id="menuH">
    </header>
    <main>
        <h2>Rersevaciones</h2>
        <div class="service-container">
            <div class="service-card">
                <h3>Sala 1</h3>
                <div class="sala1">
                    <?php
                        $sql = "SELECT * FROM sala WHERE NombreSala = 'Sala 1'";
                        $result = $conn->query(); 
                    ?>
                <table id="datosTabla">
                    <tr>
                        <th>ID</th>
                        <th>Nombre Titular</th>
                        <th>Fecha de Reserva</th>
                        <th>   </th>
                    </tr>
                    <tbody>
                        <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['ID_Sala']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['NombreTitular']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['FechaHora']) . "</td>";
                                    // echo "<td>" . htmlspecialchars($row['MarcaComputador']) . "</td>";
                                    // echo "<td><a href='eliminar.php?ID=" . $row['ID'] . ");'><button>Eliminar</button></a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>No hay datos registrados</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            </div>
            <div class="service-card">
                <h3>Sala 2</h3>
                <p>Los administradores tendrán el control total de los apartados; podrán rechazar o aceptar alguna
                    reservación de las salas de informática, registrar a las diferentes personas para los diferentes
                    apartados, entre otras funciones. </p>
            </div>
        </div>
    </main>
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
        });
    </script>
</body>

</html>
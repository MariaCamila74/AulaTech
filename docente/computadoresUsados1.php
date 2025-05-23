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
    }else if($_SESSION['Rol']==='Estudiante'){
        header('Location: ../estudiante/interfazEstudiante.php');
        exit();
    }
}

$sql = "SELECT * FROM computadoresusados";
$result = $conn->query($sql);
$conn->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computadores Usados</title>
    <link rel="stylesheet" href="../estudiante/computadoresUsados.css">
    <link rel="shortcut icon" href="../imagenes/Logo1.png" type="image/x-icon">
    <script src="../inicio/inicio.js"></script>
</head>
<body>
    <header>
        <div class="logo-nombre">
            <img src="../imagenes/Logo1.png" alt="Logo" class="logo">
        </div>
        <nav class="navbar hidden" id="navbar">
            <ul class="menu">
                <li><a href="InterfazDocente.php">Inicio</a></li>
                <li><a href="reserva.php">Reservar Sala</a></li>
                <li><a href="historiales.html">Historiales</a></li>
                <li><a href="actividadesPendientes.php">Actividades</a></li>
                <li>
                    <div class="search-container">
                        <img src="../imagenes/Buscador.png" alt="Buscar" id="searchIcon" class="search-icon">
                        <input type="text" id="searchInput" class="search-input hidden" placeholder="Buscar...">
                    </div>
                </li>
                <li><a href="restablecerContrasenaD.php">Restablecer Contraseña</a></li>
                <li><a href="../otros/logout.php" id="logout">Cerrar sesión</a></li>
            </ul>
        </nav>
        <img src="../imagenes/menu.png" alt="NavBar" class="menuH show" id="menuH">
    </header>
    <script>
        document.getElementById('searchIcon').addEventListener('click', function() {
            var searchInput = document.getElementById('searchInput');
            if (searchInput.classList.contains('visible')) {
                searchInput.classList.remove('visible');
            } else {
                searchInput.classList.add('visible');
            }
        });
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const tables = document.querySelectorAll('table');

            searchInput.addEventListener('keyup', function () {
                const filter = searchInput.value.toLowerCase();
                
                tables.forEach(function (table) {
                    const rows = table.querySelectorAll('tbody tr');
                    const header = table.previousElementSibling;

                    let foundMatch = false;
                    
                    rows.forEach(function (row) {
                        const cells = row.getElementsByTagName('td');
                        let match = false;
                        
                        // Revisar cada celda de la fila
                        for (let j = 0; j < cells.length; j++) {
                            const cellText = cells[j].textContent.toLowerCase();
                            
                            if (cellText.includes(filter)) {
                                match = true;
                                break;
                            }
                        }
                        
                        row.style.display = match ? '' : 'none';
                        if (match) {
                            foundMatch = true;
                        }
                    });
                
                    header.style.display = foundMatch ? '' : 'none';
                });
            });
        });
    </script>
    <main>
    <div class="carer">
    <div class="carousel">
        <div class="carousel-inner">
            <div class="carousel-item">
                <img src="/imagenes/acer.png" alt="Pc">
                <div class="carousel-caption">
                    
                </div>
            </div>
            <div class="carousel-item">
                <img src="/imagenes/compumax.png" alt="Pc">
                <div class="carousel-caption">
                    
                </div>
            </div>
            <div class="carousel-item">
                <img src="/imagenes/hp.png" alt="Pc">
                <div class="carousel-caption">
                    
                </div>
            </div>
        </div>
    </div>


        <div class="container">
            <h2 class="titulo">Uso de los computadores</h2>
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
                            echo "<td>" . htmlspecialchars($row['MarcaComputador']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['NumeroSerie']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Grupo']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No hay datos registrados</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    
    <br><br><br><br><br><br><br><br>
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
    </script>
    <script>
        let slideIndex = 0;
        const slides = document.querySelectorAll('.carrusel-item');

        function mostrarSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.remove('active');
                slide.style.transform = `rotateY(${(i - index) * 45}deg) translateZ(300px)`;
            });
            slides[index].classList.add('active');
        }

        function siguienteSlide() {
            slideIndex = (slideIndex + 1) % slides.length;
            mostrarSlide(slideIndex);
        }

        function anteriorSlide() {
            slideIndex = (slideIndex - 1 + slides.length) % slides.length;
            mostrarSlide(slideIndex);
        }

        document.addEventListener('DOMContentLoaded', () => {
            mostrarSlide(slideIndex);
        });
    </script>
    <script src="/docente/script.js"></script>
</body>
</html>

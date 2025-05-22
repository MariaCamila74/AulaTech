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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Octavos</title>
    <link rel="stylesheet" href="grupos.css">
    <script src="interfazEstudiante.js"></script>
    <link rel="shortcut icon" href="Logo1.png" type="image/x-icon">
    <script src="inicio.js"></script>
</head>

<body>
    <header>
        <div class="logo-nombre">
            <img src="Logo1.png" alt="Logo" class="logo">
        </div>
        <nav class="navbar hidden" id="navbar">
            <ul class="menu">
                <li><a href="admin.php">Volver</a></li>
                <li>
                    <div class="search-container">
                        <img src="images/Buscador.png" alt="Buscar" id="searchIcon" class="search-icon">
                        <input type="text" id="searchInput" class="search-input hidden" placeholder="Buscar...">
                    </div>
                </li>
            </ul>
        </nav>
        <img src="images/menu.png" alt="NavBar" class="menuH show" id="menuH">
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
        <div class="octavo1">
            <?php
                $sql = "SELECT * FROM estudiantes WHERE Grado = 801";
                $result = $conn->query($sql);
                
            ?>
        <table id="datosTabla">
            <h2>8°1</h2>
            <tr>
                <th>ID</th>
                <th>Nombre y Apellido</th>
                <th>Celular</th>
                <th>Número de Serie</th>
                <th>Marca</th>
            </tr>
            <tbody>
                <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Nombre']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Celular']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['NumeroSerie']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['MarcaComputador']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No hay datos registrados</td></tr>";
                    }
                ?>
            </tbody>
        </table>
        </div>
        <div class="octavo2">
        <table id="datosTabla">
            <h2>8°2</h2>
            <?php
                $consulta2 = "SELECT * FROM estudiantes WHERE Grado = 802";
                $result2 = $conn->query($consulta2);
            
            ?>
            <tr>
                <th>ID</th>
                <th>Nombre y Apellido</th>
                <th>Celular</th>
                <th>Número de Serie</th>
                <th>Marca</th>
            </tr>
            <tbody>
                <?php
                    if ($result2->num_rows > 0) {
                        while ($row = $result2->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Nombre']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Celular']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['NumeroSerie']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['MarcaComputador']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No hay datos registrados</td></tr>";
                    }
                ?>
            </tbody>
        </table>
        </div>
        <div class="octavo3">
        <table id="datosTabla">
            <h2>8°3</h2>
            <?php
                $consulta3 = "SELECT * FROM estudiantes WHERE Grado = 803";
                $result3 = $conn->query($consulta3);
               
            ?>
            <tr>
                <th>ID</th>
                <th>Nombre y Apellido</th>
                <th>Celular</th>
                <th>Número de Serie</th>
                <th>Marca</th>
            </tr>
            <tbody>
                <?php
                    if ($result3->num_rows > 0) {
                        while ($row = $result3->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Nombre']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Celular']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['NumeroSerie']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['MarcaComputador']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No hay datos registrados</td></tr>";
                    }
                ?>
            </tbody>
        </table>
        </div>
        <div class="octavo4">
        <table id="datosTabla">
            <h2>8°4</h2>
            <?php
                $consulta4 = "SELECT * FROM estudiantes WHERE Grado = 804";
                $result4 = $conn->query($consulta4);
               
            ?>
            <tr>
                <th>ID</th>
                <th>Nombre y Apellido</th>
                <th>Celular</th>
                <th>Número de Serie</th>
                <th>Marca</th>
            </tr>
            <tbody>
                <?php
                    if ($result4->num_rows > 0) {
                        while ($row = $result4->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Nombre']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Celular']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['NumeroSerie']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['MarcaComputador']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No hay datos registrados</td></tr>";
                    }
                ?>
            </tbody>
        </table>
        </div>
        <div class="octavo5">
        <table id="datosTabla">
            <h2>8°5</h2>
            <?php
                $consulta5 = "SELECT * FROM estudiantes WHERE Grado = 805";
                $result5 = $conn->query($consulta5);
                
            ?>
            <tr>
                <th>ID</th>
                <th>Nombre y Apellido</th>
                <th>Celular</th>
                <th>Número de Serie</th>
                <th>Marca</th>
            </tr>
            <tbody>
                <?php
                    if ($result5->num_rows > 0) {
                        while ($row = $result5->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Nombre']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Celular']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['NumeroSerie']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['MarcaComputador']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No hay datos registrados</td></tr>";
                    }
                ?>
            </tbody>
        </table>
        </div>
        <div class="octavo6">
        <table id="datosTabla">
            <h2>8°6</h2>
            <?php
                $consulta6 = "SELECT * FROM estudiantes WHERE Grado = 806";
                $result6 = $conn->query($consulta6);
            
            ?>
            <tr>
                <th>ID</th>
                <th>Nombre y Apellido</th>
                <th>Celular</th>
                <th>Número de Serie</th>
                <th>Marca</th>
            </tr>
            <tbody>
                <?php
                    if ($result6->num_rows > 0) {
                        while ($row = $result6->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Nombre']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Celular']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['NumeroSerie']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['MarcaComputador']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No hay datos registrados</td></tr>";
                    }
                ?>
            </tbody>
        </table>
        </div>
        <div class="octavo7">
        <table id="datosTabla">
            <h2>8°7</h2>
            <?php
                $consulta7 = "SELECT * FROM estudiantes WHERE Grado = 807";
                $result7 = $conn->query($consulta7);
                $conn->close();
            ?>
            <tr>
                <th>ID</th>
                <th>Nombre y Apellido</th>
                <th>Celular</th>
                <th>Número de Serie</th>
                <th>Marca</th>
            </tr>
            <tbody>
                <?php
                    if ($result7->num_rows > 0) {
                        while ($row = $result7->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Nombre']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Celular']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['NumeroSerie']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['MarcaComputador']) . "</td>";
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
</body>

</html>
<?php
require "../../otros/index.php";

session_start();

if(!isset($_SESSION['Rol'])) {
    header('Location: ../../inicio/iniciosesion.php');
    exit();
}else if(isset($_SESSION['Rol'])){
    if($_SESSION['Rol']==='Admin'){
        header('Location: ../../administrador/admin.php');
        exit();
    }else if($_SESSION['Rol']==='Estudiante'){
        header('Location: ../../estudiante/interfazEstudiante.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuartos</title>
    <link rel="stylesheet" href="../../otros/grupos.css">
    <link rel="shortcut icon" href="../../imagenes/Logo1.png" type="image/x-icon">
</head>
<body>
    <header>
        <div class="logo-nombre">
            <img src="../../imagenes/Logo1.png" alt="Logo" class="logo">
        </div>
        <nav class="navbar hidden" id="navbar">
            <ul class="menu">
                <li><a href="../actividadesPendientes.php">Volver</a></li>
                <li>
                    <div class="search-container">
                        <img src="../../imagenes/Buscador.png" alt="Buscar" id="searchIcon" class="search-icon">
                        <input type="text" id="searchInput" class="search-input hidden" placeholder="Buscar...">
                    </div>
                </li>
            </ul>
        </nav>
        <img src="../../imagenes/menu.png" alt="NavBar" class="menuH show" id="menuH">
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
    <br><br>
    <div class="containerr">
        <div class="cuarto1">
            <h2>4°1</h2>
            <?php
                $sql = "SELECT * FROM actividadespendientes WHERE Grupo = 401";
                $result = $conn->query($sql);   
            ?>
            <table id="datosTabla">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Grupo</th>
                        <th>Descripción de la Actividad</th>
                        <th>Documento</th>
                        <th>Fecha de Entrega</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Grupo']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Descripcion']) . "</td>";
                                
                                $extension = pathinfo($row['Documento'], PATHINFO_EXTENSION);
                                    
                                if ($extension == 'pdf') {
                                    echo "<td><embed src='documentos/docentes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px' type='application/pdf'></td>";
                                } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif','txt','xlsx'])) {
                                    echo "<td><img src='documentos/docentes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px'></td>";
                                } else {
                                    echo "<td><a href='documentos/docentes/" . htmlspecialchars($row['Documento']) . "' target='_blank'>Ver Documento</a></td>";
                                }

                                echo "<td>" . htmlspecialchars($row['FechaEntrega']) . "</td>";
                                echo "<td><a href='../eliminar3.php?ID=" . htmlspecialchars($row['ID']) . ");'><button>Eliminar</button></a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No hay datos registrados</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="cuarto2">
            <h2>4°2</h2>
            <?php
                $sql = "SELECT * FROM actividadespendientes WHERE Grupo = 402";
                $result = $conn->query($sql);   
            ?>
            <table id="datosTabla"">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Grupo</th>
                        <th>Descripción de la Actividad</th>
                        <th>Documento</th>
                        <th>Fecha de Entrega</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Grupo']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Descripcion']) . "</td>";
                                
                                $extension = pathinfo($row['Documento'], PATHINFO_EXTENSION);
                                    
                                if ($extension == 'pdf') {
                                    echo "<td><embed src='documentos/docentes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px' type='application/pdf'></td>";
                                } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif','txt','xlsx'])) {
                                    echo "<td><img src='documentos/docentes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px'></td>";
                                } else {
                                    echo "<td><a href='documentos/docentes/" . htmlspecialchars($row['Documento']) . "' target='_blank'>Ver Documento</a></td>";
                                }

                                echo "<td>" . htmlspecialchars($row['FechaEntrega']) . "</td>";
                                echo "<td><a href='../eliminar3.php?ID=" . htmlspecialchars($row['ID']) . ");'><button>Eliminar</button></a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No hay datos registrados</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="cuarto3">
            <h2>4°3</h2>
            <?php
                $sql = "SELECT * FROM actividadespendientes WHERE Grupo = 403";
                $result = $conn->query($sql);   
            ?>
            <table id="datosTabla">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Grupo</th>
                        <th>Descripción de la Actividad</th>
                        <th>Documento</th>
                        <th>Fecha de Entrega</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Grupo']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Descripcion']) . "</td>";
                                
                                $extension = pathinfo($row['Documento'], PATHINFO_EXTENSION);
                                    
                                if ($extension == 'pdf') {
                                    echo "<td><embed src='documentos/docentes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px' type='application/pdf'></td>";
                                } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif','txt','xlsx'])) {
                                    echo "<td><img src='documentos/docentes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px'></td>";
                                } else {
                                    echo "<td><a href='documentos/docentes/" . htmlspecialchars($row['Documento']) . "' target='_blank'>Ver Documento</a></td>";
                                }

                                echo "<td>" . htmlspecialchars($row['FechaEntrega']) . "</td>";
                                echo "<td><a href='../eliminar3.php?ID=" . htmlspecialchars($row['ID']) . ");'><button>Eliminar</button></a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No hay datos registrados</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="cuarto4">
            <h2>4°4</h2>
            <?php
                $sql = "SELECT * FROM actividadespendientes WHERE Grupo = 404";
                $result = $conn->query($sql);   
            ?>
            <table id="datosTabla">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Grupo</th>
                        <th>Descripción de la Actividad</th>
                        <th>Documento</th>
                        <th>Fecha de Entrega</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Grupo']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Descripcion']) . "</td>";
                                
                                $extension = pathinfo($row['Documento'], PATHINFO_EXTENSION);
                                    
                                if ($extension == 'pdf') {
                                    echo "<td><embed src='documentos/docentes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px' type='application/pdf'></td>";
                                } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif','txt','xlsx'])) {
                                    echo "<td><img src='documentos/docentes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px'></td>";
                                } else {
                                    echo "<td><a href='documentos/docentes/" . htmlspecialchars($row['Documento']) . "' target='_blank'>Ver Documento</a></td>";
                                }

                                echo "<td>" . htmlspecialchars($row['FechaEntrega']) . "</td>";
                                echo "<td><a href='../eliminar3.php?ID=" . htmlspecialchars($row['ID']) . ");'><button>Eliminar</button></a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No hay datos registrados</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="cuarto5">
            <h2>4°5</h2>
            <?php
                $sql = "SELECT * FROM actividadespendientes WHERE Grupo = 405";
                $result = $conn->query($sql);   
            ?>
            <table id="datosTabla">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Grupo</th>
                        <th>Descripción de la Actividad</th>
                        <th>Documento</th>
                        <th>Fecha de Entrega</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Grupo']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Descripcion']) . "</td>";
                                
                                $extension = pathinfo($row['Documento'], PATHINFO_EXTENSION);
                                    
                                if ($extension == 'pdf') {
                                    echo "<td><embed src='documentos/docentes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px' type='application/pdf'></td>";
                                } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif','txt','xlsx'])) {
                                    echo "<td><img src='documentos/docentes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px'></td>";
                                } else {
                                    echo "<td><a href='documentos/docentes/" . htmlspecialchars($row['Documento']) . "' target='_blank'>Ver Documento</a></td>";
                                }

                                echo "<td>" . htmlspecialchars($row['FechaEntrega']) . "</td>";
                                echo "<td><a href='../eliminar3.php?ID=" . htmlspecialchars($row['ID']) . ");'><button>Eliminar</button></a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No hay datos registrados</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="cuarto6">
            <h2>4°6</h2>
            <?php
                $sql = "SELECT * FROM actividadespendientes WHERE Grupo = 406";
                $result = $conn->query($sql);   
            ?>
            <table id="datosTabla">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Grupo</th>
                        <th>Descripción de la Actividad</th>
                        <th>Documento</th>
                        <th>Fecha de Entrega</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Grupo']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Descripcion']) . "</td>";
                                
                                $extension = pathinfo($row['Documento'], PATHINFO_EXTENSION);
                                    
                                if ($extension == 'pdf') {
                                    echo "<td><embed src='documentos/docentes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px' type='application/pdf'></td>";
                                } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif','txt','xlsx'])) {
                                    echo "<td><img src='documentos/docentes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px'></td>";
                                } else {
                                    echo "<td><a href='documentos/docentes/" . htmlspecialchars($row['Documento']) . "' target='_blank'>Ver Documento</a></td>";
                                }

                                echo "<td>" . htmlspecialchars($row['FechaEntrega']) . "</td>";
                                echo "<td><a href='../eliminar3.php?ID=" . htmlspecialchars($row['ID']) . ");'><button>Eliminar</button></a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No hay datos registrados</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="cuarto7">
            <h2>4°7</h2>
            <?php
                $sql = "SELECT * FROM actividadespendientes WHERE Grupo = 407";
                $result = $conn->query($sql);   
            ?>
            <table id="datosTabla">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Grupo</th>
                        <th>Descripción de la Actividad</th>
                        <th>Documento</th>
                        <th>Fecha de Entrega</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Grupo']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Descripcion']) . "</td>";
                                
                                $extension = pathinfo($row['Documento'], PATHINFO_EXTENSION);
                                    
                                if ($extension == 'pdf') {
                                    echo "<td><embed src='documentos/docentes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px' type='application/pdf'></td>";
                                } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif','txt','xlsx'])) {
                                    echo "<td><img src='documentos/docentes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px'></td>";
                                } else {
                                    echo "<td><a href='documentos/docentes/" . htmlspecialchars($row['Documento']) . "' target='_blank'>Ver Documento</a></td>";
                                }

                                echo "<td>" . htmlspecialchars($row['FechaEntrega']) . "</td>";
                                echo "<td><a href='../eliminar3.php?ID=" . htmlspecialchars($row['ID']) . ");'><button>Eliminar</button></a></td>";
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
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuH = document.getElementById("menuH");
            const navbar = document.getElementById("navbar");

            if (menuH) { 
                menuH.addEventListener("click", () => {
                    navbar.classList.toggle("hidden"); 
                    navbar.classList.toggle("show");

                    if (navbar.classList.contains("show")) {
                        menuH.src = "../../../imagenes/Icono-Cancelar.png";
                    } else {
                        menuH.src = "../../../imagenes/menu.png";
                    }
                });
            }
        });
    </script>
</body>
</html>
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
    <title>Octavos</title>
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
        <div class="octavo1">
            <h2>8°1</h2>
            <?php
                $sql = "SELECT * FROM actividadesrealizadas WHERE Grupo = 801";
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
                                    echo "<td><embed src='documentos/estudiantes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px' type='application/pdf'></td>";
                                } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif','txt','xlsx'])) {
                                    echo "<td><img src='documentos/estudiantes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px'></td>";
                                } else {
                                    echo "<td><a href='documentos/estudiantes/" . htmlspecialchars($row['Documento']) . "' target='_blank'>Ver Documento</a></td>";
                                }

                                echo "<td>" . htmlspecialchars($row['FechaEntrega']) . "</td>";
                                echo "<td><a href='../eliminar4.php?ID=" . htmlspecialchars($row['ID']) . ");'><button>Eliminar</button></a></td>";
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
            <h2>8°2</h2>
            <?php
                $sql = "SELECT * FROM actividadesrealizadas WHERE Grupo = 802";
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
                                    echo "<td><embed src='documentos/estudiantes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px' type='application/pdf'></td>";
                                } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif','txt','xlsx'])) {
                                    echo "<td><img src='documentos/estudiantes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px'></td>";
                                } else {
                                    echo "<td><a href='documentos/estudiantes/" . htmlspecialchars($row['Documento']) . "' target='_blank'>Ver Documento</a></td>";
                                }

                                echo "<td>" . htmlspecialchars($row['FechaEntrega']) . "</td>";
                                echo "<td><a href='../eliminar4.php?ID=" . htmlspecialchars($row['ID']) . ");'><button>Eliminar</button></a></td>";
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
            <h2>8°3</h2>
            <?php
                $sql = "SELECT * FROM actividadesrealizadas WHERE Grupo = 803";
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
                                    echo "<td><embed src='documentos/estudiantes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px' type='application/pdf'></td>";
                                } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif','txt','xlsx'])) {
                                    echo "<td><img src='documentos/estudiantes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px'></td>";
                                } else {
                                    echo "<td><a href='documentos/estudiantes/" . htmlspecialchars($row['Documento']) . "' target='_blank'>Ver Documento</a></td>";
                                }

                                echo "<td>" . htmlspecialchars($row['FechaEntrega']) . "</td>";
                                echo "<td><a href='../eliminar4.php?ID=" . htmlspecialchars($row['ID']) . ");'><button>Eliminar</button></a></td>";
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
            <h2>8°4</h2>
            <?php
                $sql = "SELECT * FROM actividadesrealizadas WHERE Grupo = 804";
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
                                    echo "<td><embed src='documentos/estudiantes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px' type='application/pdf'></td>";
                                } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif','txt','xlsx'])) {
                                    echo "<td><img src='documentos/estudiantes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px'></td>";
                                } else {
                                    echo "<td><a href='documentos/estudiantes/" . htmlspecialchars($row['Documento']) . "' target='_blank'>Ver Documento</a></td>";
                                }

                                echo "<td>" . htmlspecialchars($row['FechaEntrega']) . "</td>";
                                echo "<td><a href='../eliminar4.php?ID=" . htmlspecialchars($row['ID']) . ");'><button>Eliminar</button></a></td>";
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
            <h2>8°5</h2>
            <?php
                $sql = "SELECT * FROM actividadesrealizadas WHERE Grupo = 805";
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
                                    echo "<td><embed src='documentos/estudiantes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px' type='application/pdf'></td>";
                                } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif','txt','xlsx'])) {
                                    echo "<td><img src='documentos/estudiantes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px'></td>";
                                } else {
                                    echo "<td><a href='documentos/estudiantes/" . htmlspecialchars($row['Documento']) . "' target='_blank'>Ver Documento</a></td>";
                                }

                                echo "<td>" . htmlspecialchars($row['FechaEntrega']) . "</td>";
                                echo "<td><a href='../eliminar4.php?ID=" . htmlspecialchars($row['ID']) . ");'><button>Eliminar</button></a></td>";
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
            <h2>8°6</h2>
            <?php
                $sql = "SELECT * FROM actividadesrealizadas WHERE Grupo = 806";
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
                                    echo "<td><embed src='documentos/estudiantes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px' type='application/pdf'></td>";
                                } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif','txt','xlsx'])) {
                                    echo "<td><img src='documentos/estudiantes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px'></td>";
                                } else {
                                    echo "<td><a href='documentos/estudiantes/" . htmlspecialchars($row['Documento']) . "' target='_blank'>Ver Documento</a></td>";
                                }

                                echo "<td>" . htmlspecialchars($row['FechaEntrega']) . "</td>";
                                echo "<td><a href='../eliminar4.php?ID=" . htmlspecialchars($row['ID']) . ");'><button>Eliminar</button></a></td>";
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
            <h2>8°7</h2>
            <?php
                $sql = "SELECT * FROM actividadesrealizadas WHERE Grupo = 807";
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
                                    echo "<td><embed src='documentos/estudiantes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px' type='application/pdf'></td>";
                                } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif','txt','xlsx'])) {
                                    echo "<td><img src='documentos/estudiantes/" . htmlspecialchars($row['Documento']) . "' width='200px' height='200px'></td>";
                                } else {
                                    echo "<td><a href='documentos/estudiantes/" . htmlspecialchars($row['Documento']) . "' target='_blank'>Ver Documento</a></td>";
                                }

                                echo "<td>" . htmlspecialchars($row['FechaEntrega']) . "</td>";
                                echo "<td><a href='../eliminar4.php?ID=" . htmlspecialchars($row['ID']) . ");'><button>Eliminar</button></a></td>";
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
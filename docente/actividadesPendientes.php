<?php
require "../otros/index.php";
session_start();

if (!isset($_SESSION['Rol'])) {
    header('Location: iniciosesion.php');
    exit();
} else if (isset($_SESSION['Rol'])) {
    if ($_SESSION['Rol'] === 'Admin') {
        header('Location: admin.php');
        exit();
    } else if ($_SESSION['Rol'] === 'Estudiante') {
        header('Location: interfazEstudiante.php');
        exit();
    }
}

$response = array('success' => false, 'message' => '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descripcion = $_POST['Descripcion'];
    $grupo = $_POST['Grupo'];
    $entrega = $_POST['FechaEntrega'];
    $file_name = $_FILES['Documentos']['name'];
    $file_tmp = $_FILES['Documentos']['tmp_name'];
    $file_size = $_FILES['Documentos']['size'];

    if ($file_size > 209715200) {
        $response['message'] = 'El archivo excede el tamaño máximo permitido.';
        echo json_encode($response);
        exit();
    }

    
    $date = getdate();
    $nameExplode = explode('.', $file_name);
    $newName = $nameExplode[0] . $date['year'] . '' . $date['mon'] . '' . $date['mday'] . '' . $date['hours'] . '' . $date['minutes'] . '_' . $date['seconds'] . '.' . $nameExplode[1];

    
    $route = "actividadesPend/documentos/docentes/" . $newName;
    
    
    if (move_uploaded_file($file_tmp, $route)) {
        
        $stmt = $conn->prepare("INSERT INTO actividadespendientes (Grupo, Descripcion, Documento, FechaEntrega) VALUES (?, ?, ?, ?)");
        
        if ($stmt === false) {
            $response['message'] = 'Error en la preparación de la consulta: ' . $conn->error;
        } else {
            
            $stmt->bind_param("isss", $grupo, $descripcion, $newName, $entrega);
            
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'La actividad pendiente se subió correctamente.';
            } else {
                $response['message'] = 'Error al subir la actividad pendiente: ' . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        $response['message'] = 'Error al mover el archivo.';
    }

    
    echo json_encode($response);
    exit();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividades Pendientes</title>
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
                <li><a href="computadoresUsados1.php">Historial de Computadores</a></li>
                <li><a href="estudiantes-por-equipo.php">Historial de grupos</a></li>
                <li><a href="actividadesPendientes.php">Actividades</a></li>
                <li><a href="restablecerContrasenaD.php">Restablecer Contraseña</a></li>
                <li><a href="../otros/logout.php" id="logout">Cerrar sesión</a></li>
            </ul>
        </nav>
        <img src="../imagenes/menu.png" alt="NavBar" class="menuH show" id="menuH">
    </header>
    <div class="container">
        <h2 class="titulo">Actividades pendientes</h2>
        <form id="activityForm" method="POST" action="actividadesPendientes.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Grupo">Grupo</label>
                <select name="Grupo" id="Grupo" required>
                    <option value="" disabled selected>Seleccione su grupo</option>
                    <!-- <option value="101">101</option>
                    <option value="102">102</option>
                    <option value="103">103</option>
                    <option value="104">104</option>
                    <option value="105">105</option>
                    <option value="106">106</option>
                    <option value="107">107</option>
                    <option value="201">201</option>
                    <option value="202">202</option>
                    <option value="203">203</option>
                    <option value="204">204</option>
                    <option value="205">205</option>
                    <option value="206">206</option>
                    <option value="207">207</option>
                    <option value="301">301</option>
                    <option value="302">302</option>
                    <option value="303">303</option>
                    <option value="304">304</option>
                    <option value="305">305</option>
                    <option value="306">306</option>
                    <option value="307">307</option> -->
                    <option value="401">401</option>
                    <option value="402">402</option>
                    <option value="403">403</option>
                    <option value="404">404</option>
                    <option value="405">405</option>
                    <option value="406">406</option>
                    <option value="407">407</option>
                    <option value="501">501</option>
                    <option value="502">502</option>
                    <option value="503">503</option>
                    <option value="504">504</option>
                    <option value="505">505</option>
                    <option value="506">506</option>
                    <option value="507">507</option>
                    <option value="601">601</option>
                    <option value="602">602</option>
                    <option value="603">603</option>
                    <option value="604">604</option>
                    <option value="605">605</option>
                    <option value="606">606</option>
                    <option value="607">607</option>
                    <option value="701">701</option>
                    <option value="702">702</option>
                    <option value="703">703</option>
                    <option value="704">704</option>
                    <option value="705">705</option>
                    <option value="706">706</option>
                    <option value="707">707</option>
                    <option value="801">801</option>
                    <option value="802">802</option>
                    <option value="803">803</option>
                    <option value="804">804</option>
                    <option value="805">805</option>
                    <option value="806">806</option>
                    <option value="807">807</option>
                    <option value="901">901</option>
                    <option value="902">902</option>
                    <option value="903">903</option>
                    <option value="904">904</option>
                    <option value="905">905</option>
                    <option value="906">906</option>
                    <option value="907">907</option>
                    <option value="1001">1001</option>
                    <option value="1002">1002</option>
                    <option value="1003">1003</option>
                    <option value="1004">1004</option>
                    <option value="1005">1005</option>
                    <option value="1006">1006</option>
                    <option value="1007">1007</option>
                    <option value="1101">1101</option>
                    <option value="1102">1102</option>
                    <option value="1103">1103</option>
                    <option value="1104">1104</option>
                    <option value="1105">1105</option>
                    <option value="1106">1106</option>
                    <option value="1107">1107</option>
                </select>
            </div>
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
        </form>
        <table>
            <h2>Actividades Asignadas</h2>
            <thead>
                <tr>
                    <th>Grado</th>
                    <th>Ver más</th>
                </tr>
            </thead>
            <tbody>
                <!-- <tr>
                    <td>Primeros</td>
                    <td><button onclick="window.location.href='actividadesPend/primeros.php'">Ver</button></td>
                </tr>
                <tr>
                    <td>Segundos</td>
                    <td><button onclick="window.location.href='actividadesPend/segundos.php'">Ver</button></td>
                </tr>
                <tr>
                    <td>Terceros</td>
                    <td><button onclick="window.location.href='actividadesPend/terceros.php'">Ver</button></td>
                </tr> -->
                <tr>
                    <td>Cuartos</td>
                    <td><button onclick="window.location.href='actividadesPend/cuartos.php'">Ver</button></td>
                </tr>
                <tr>
                    <td>Quintos</td>
                    <td><button onclick="window.location.href='actividadesPend/quintos.php'">Ver</button></td>
                </tr>
                <tr>
                    <td>Sextos</td>
                    <td><button onclick="window.location.href='actividadesPend/sextos.php'">Ver</button></td>
                </tr>
                <tr>
                    <td>Septimos</td>
                    <td><button onclick="window.location.href='actividadesPend/septimos.php'">Ver</button></td>
                </tr>
                <tr>
                    <td>Octavos</td>
                    <td><button onclick="window.location.href='actividadesPend/octavos.php'">Ver</button></td>
                </tr>
                <tr>
                    <td>Novenos</td>
                    <td><button onclick="window.location.href='actividadesPend/novenos.php'">Ver</button></td>
                </tr>
                <tr>
                    <td>Décimos</td>
                    <td><button onclick="window.location.href='actividadesPend/decimos.php'">Ver</button></td>
                </tr>
                <tr>
                    <td>Undécimos</td>
                    <td><button onclick="window.location.href='actividadesPend/undecimos.php'">Ver</button></td>
                </tr>
            </tbody>
        </table>
        <table>
            <h2>Actividades Entregadas - Estudiantes</h2>
            <thead>
                <tr>
                    <th>Grado</th>
                    <th>Ver más</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Cuartos</td>
                    <td><button onclick="window.location.href='actividadesPend/cuart.php'">Ver</button></td>
                </tr>
                <tr>
                    <td>Quintos</td>
                    <td><button onclick="window.location.href='actividadesPend/quint.php'">Ver</button></td>
                </tr>
                <tr>
                    <td>Sextos</td>
                    <td><button onclick="window.location.href='actividadesPend/sext.php'">Ver</button></td>
                </tr>
                <tr>
                    <td>Septimos</td>
                    <td><button onclick="window.location.href='actividadesPend/sept.php'">Ver</button></td>
                </tr>
                <tr>
                    <td>Octavos</td>
                    <td><button onclick="window.location.href='actividadesPend/oct.php'">Ver</button></td>
                </tr>
                <tr>
                    <td>Novenos</td>
                    <td><button onclick="window.location.href='actividadesPend/nov.php'">Ver</button></td>
                </tr>
                <tr>
                    <td>Décimos</td>
                    <td><button onclick="window.location.href='actividadesPend/deci.php'">Ver</button></td>
                </tr>
                <tr>
                    <td>Undécimos</td>
                    <td><button onclick="window.location.href='actividadesPend/undec.php'">Ver</button></td>
                </tr>
            </tbody>
        </table>
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

            
            const form = document.getElementById('activityForm');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
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
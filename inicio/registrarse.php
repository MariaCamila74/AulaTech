<?php

session_start();
require "../otros/index.php";

$errorConsulta = '';
$errorRegistrar = '';

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nombreCompleto = $_POST['nombrecompleto'];
    $numeroMatricula = $_POST['NumeroMatricula'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $idEstudiante = $_POST['Id_Estudiante'];
    $idEstudiante = password_hash($idEstudiante, PASSWORD_DEFAULT);
    $grupo = $_POST['grado'];

   
    $stmt = $conn->prepare("INSERT INTO estudiantes (NombreApellido, NumeroMatricula, Telefono, Email, Id_Estudiante, Grado, Rol) VALUES (?, ?, ?, ?, ?, ?,'Estudiante')");
    
    if ($stmt === false) {
        $errorConsulta = "Error en la preparación de la consulta: " . $conn->error;
    } else {
        $stmt->bind_param("siissi", $nombreCompleto, $numeroMatricula, $telefono, $email, $idEstudiante, $grupo);

        
        if ($stmt->execute()) {
            header("Location: iniciosesion.php"); 
            exit();
        } else {
            
            $errorRegistrar = "Error al registrar estudiante: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<script>
        <?php if (!empty($errorConsulta)): ?>
            swal("Incorrecto", "<?php echo $errorConsulta; ?>", "error");
        <?php elseif (!empty($errorRegistrar)): ?>
            swal("Error", "<?php echo $errorRegistrar; ?>", "error");
        <?php endif; ?>
    </script>
</body>
</html>
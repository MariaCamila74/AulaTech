<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aulatech";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_GET['ID'])) {
    $id = intval($_GET['ID']);

    if ($id > 0) {
        $sql = "DELETE FROM `docentes` WHERE `ID` = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Éxito en la eliminación
            $alertScript = "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Eliminado',
                        text: 'Docente eliminado exitosamente.',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'Docente.php'; // Redirigir a la página de docentes
                        }
                    });
                </script>";
        } else {
            // Error en la eliminación
            $alertScript = "
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al eliminar al docente: " . $conn->error . "',
                        confirmButtonText: 'Aceptar'
                    }).then(() => {
                        window.location.href = 'Docente.php'; // Redirigir a la página de docentes
                    });
                </script>";
        }

        $stmt->close();
    } else {
        // ID no válido
        $alertScript = "
            <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'ID no válido',
                    text: 'ID de docente no válido.',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = 'Docente.php'; // Redirigir a la página de docentes
                });
            </script>";
    }
} else {
    // No se ha proporcionado un ID
    $alertScript = "
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Sin ID',
                text: 'No se ha proporcionado un ID de docente.',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                window.location.href = 'Docente.php'; // Redirigir a la página de docentes
            });
        </script>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Docente</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
   
    
    <?php
    
    if (isset($alertScript)) {
        echo $alertScript;
    }
    ?>
</body>
</html>


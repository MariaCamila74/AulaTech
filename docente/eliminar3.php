<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aulatech";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$responseScript = ""; 

if (isset($_GET['ID'])) {
    $id = intval($_GET['ID']);

    if ($id > 0) {
        $sql = "DELETE FROM `actividadespendientes` WHERE `ID` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $responseScript = "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Éxito',
                        text: 'Actividad pendiente eliminada exitosamente.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location = 'interfazDocente.php';
                    });
                });
            </script>";
        } else {
            $error = $conn->error;
            $responseScript = "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Error al eliminar la actividad pendiente: " . addslashes($error) . "',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location = 'interfazDocente.php';
                    });
                });
            </script>";
        }

        $stmt->close();
    } else {
        $responseScript = "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Advertencia',
                    text: 'ID de actividad pendiente no válido.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'interfazDocente.php';
                });
            });
        </script>";
    }
} else {
    $responseScript = "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Advertencia',
                text: 'No se ha proporcionado un ID de actividad pendiente.',
                icon: 'warning',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location = 'interfazDocente.php';
            });
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
    <title>Documento</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php
        
        echo $responseScript;
    ?>
</body>
</html>

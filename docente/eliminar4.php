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
        $sql = "DELETE FROM `actividadesrealizadas` WHERE `ID` = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "<script>
                Swal.fire({
                    title: 'Éxito',
                    text: 'Actividad realizada eliminada exitosamente.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'interfazDocente.php';
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'Error al eliminar la actividad realizada: " . $conn->error . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'interfazDocente.php';
                });
            </script>";
        }

        $stmt->close();
    } else {
        echo "<script>
            Swal.fire({
                title: 'Advertencia',
                text: 'ID de actividad realizada no válido.',
                icon: 'warning',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location = 'interfazDocente.php';
            });
        </script>";
    }
} else {
    echo "<script>
        Swal.fire({
            title: 'Advertencia',
            text: 'No se ha proporcionado un ID de actividad realizada.',
            icon: 'warning',
            confirmButtonText: 'OK'
        }).then(function() {
            window.location = 'interfazDocente.php';
        });
    </script>";
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    
</body>
</html>

<?php
include('../otros/index.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_sala = $_POST['ID_SALA'];
    $accion = $_POST['accion'];

    // Obtener info de la reserva
    $stmt = $conn->prepare("SELECT NombreTitular, Correo FROM sala WHERE ID_SALA = ?");
    $stmt->bind_param("i", $id_sala);
    $stmt->execute();
    $res = $stmt->get_result();
    $reserva = $res->fetch_assoc();

    $correo = $reserva['Correo'];
    $nombre = $reserva['NombreTitular'];

    if ($accion === 'confirmar') {
        // Cambiar estado a Confirmada
        $stmt = $conn->prepare("UPDATE sala SET Estado = 'Confirmada' WHERE ID_SALA = ?");
        $stmt->bind_param("i", $id_sala);
        $stmt->execute();

        // Enviar correo
        $asunto = "Reserva Confirmada";
        $mensaje = "Hola $nombre,\nTu reserva ha sido confirmada.\n¡Gracias!";
    } elseif ($accion === 'denegar') {
        // Cambiar estado a Denegada o eliminar
        $stmt = $conn->prepare("UPDATE sala SET Estado = 'Denegada' WHERE ID_SALA = ?");
        $stmt->bind_param("i", $id_sala);
        $stmt->execute();

        $asunto = "Reserva Denegada";
        $mensaje = "Hola $nombre,\nTu reserva ha sido denegada.\nPara más información, comunícate con el administrador.";
    }

    // Enviar correo si es válido
    if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        mail($correo, $asunto, $mensaje, "From: noreply@tusistema.com");
    }

    header("Location: admin.php");
    exit();
}
?>

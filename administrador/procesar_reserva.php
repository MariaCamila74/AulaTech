<?php
include('../otros/index.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_sala = $_POST['id_sala'];
    $accion = $_POST['accion'];

    // Obtener correo de la persona
    $sql = "SELECT NombreTitular, Correo FROM sala WHERE ID_Sala = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_sala);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $reserva = $resultado->fetch_assoc();

    $correo = $reserva['Correo'];
    $nombre = $reserva['NombreTitular'];

    if ($accion === 'confirmar') {
        $asunto = "Reserva Confirmada";
        $mensaje = "Hola $nombre,\nTu reserva ha sido confirmada exitosamente.\nGracias por usar el sistema.";
    } else if ($accion === 'denegar') {
        $asunto = "Reserva Denegada";
        $mensaje = "Hola $nombre,\nTu reserva ha sido denegada. Si tienes preguntas, contacta con el administrador.";

        // Eliminar la reserva si se deniega
        $sqlEliminar = "DELETE FROM sala WHERE ID_Sala = ?";
        $stmtEliminar = $conn->prepare($sqlEliminar);
        $stmtEliminar->bind_param("i", $id_sala);
        $stmtEliminar->execute();
    }

    // Enviar correo (usando la función mail de PHP)
    if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        mail($correo, $asunto, $mensaje, "From: noreply@tusistema.com");
    }

    // Redirigir de vuelta a la página principal
    header("Location: admin.php");
    exit();
}
?>

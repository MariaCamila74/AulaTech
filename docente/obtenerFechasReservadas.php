<?php
session_start();
require "../otros/index.php";

$query = "SELECT FechaHora FROM sala";
$result = $conn->query($query);

$fechasReservadas = [];
while ($row = $result->fetch_assoc()) {
    $fechasReservadas[] = $row['FechaHora'];
}

echo json_encode(['fechasReservadas' => $fechasReservadas]);

$conn->close();
?>
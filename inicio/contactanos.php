<?php
$mostrarAlerta = false;  
$enviado = false; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $comentarios = $_POST['comentarios'];

    $destinatario = "jomicala0@gmail.com";
    $asunto = "Nuevo mensaje de contacto de $nombre";
    $mensaje = "Has recibido un nuevo mensaje de contacto:\n\n";
    $mensaje .= "Nombre: $nombre\n";
    $mensaje .= "Email: $email\n";
    $mensaje .= "Teléfono: $telefono\n";
    $mensaje .= "Comentarios: $comentarios\n";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    
    if (mail($destinatario, $asunto, $mensaje, $headers)) {
        $enviado = true;
    }
    $mostrarAlerta = true;  
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contáctanos</title>
    <link rel="stylesheet" href="contactanos.css">
    <script src="inicio.js"></script>
    <link rel="shortcut icon" href="../imagenes/Logo1.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert -->
</head>
<body>
    <header>
        <div class="logo-nombre">
            <img src="../imagenes/Logo1.png" alt="Logo" class="logo">
        </div>
        <nav class="navbar hidden" id="navbar">
            <ul class="menu">
                <li><a href="../index.html">Inicio</a></li>
                <li><a href="servicios.html">Servicios</a></li>
                <li><a href="contactanos.php">Contáctanos</a></li>
                <li><a href="iniciosesion.php">Iniciar Sesion</a></li>
                <li><a href="registrarse.php">Registrarse</a></li>
            </ul>
        </nav>
        <img src="../imagenes/menu.png" alt="NavBar" class="menuH show" id="menuH">
    </header>
    <main>
        <div class="overlay" id="overlay">
            <div class="alerta">
                <img src="../imagenes/advertencia.png" alt="Advertencia">
                <h2>Advertencia</h2>
                <p>En este espacio también los profesores podrán solicitar el espacio de la sala de cómputo prestada, separar un espacio en la misma.</p>
                <button class="btn-verde" onclick="cerrarAlerta()">Continuar</button>
            </div>
        </div>
        <section class="contactos-detalles">
            <h2>Contacto</h2>
            <div class="info">
                <p><strong>Contactanos</strong></p>
                <p>I.E SADEP, Medellín.</p>
                <p><strong>Número de teléfono</strong></p>
                <p>3044750892</p>
                <p><strong>Gmail</strong></p>
                <p>jomicala0@gmail.com</p>
                <video autoplay loop muted>
                    <source src="../imagenes/buzón.mp4" type="video/mp4">
                    Tu navegador no soporta la reproducción de videos.
                </video>
            </div>
        </section>
        <section class="contactos-formulario">
            <h3>¿Necesitas hablar con nosotros?</h3>
            <p>¡Bienvenidos a AulaTech! Nos encargamos 
                de asegurar que todos los computadores de la Institución estén en óptimas 
                condiciones para su buen uso, ya sea por parte de los docentes y estudiantes. 
                También realiza un mantenimiento regular (Cada 6 meses) de todos los equipos, 
                lo que incluye limpieza, actualización de historial de uso y softwares, además
                de el reemplazo de piezas en caso de ser necesario.
                <br><br> ¡Ahora danos tú opinión o sugerencia! </p>
            <form method="POST">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="telefono">Número de teléfono</label>
                <input type="tel" id="telefono" name="telefono" required>

                <label for="comentarios">Comentarios</label>
                <textarea id="comentarios" name="comentarios" required></textarea>

                <button type="submit" name="enviar"><span>Enviar</span></button>
            </form>
        </section>
    </main>

    <?php if ($mostrarAlerta): ?>
    <script>
        
        document.addEventListener('DOMContentLoaded', function() {
            <?php if ($enviado): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Enviado correctamente',
                    text: 'Correo enviado correctamente. Gracias por contactarnos.',
                    confirmButtonText: 'Aceptar'
                });
            <?php else: ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un error al enviar el correo. Por favor, inténtalo nuevamente.',
                    confirmButtonText: 'Aceptar'
                });
            <?php endif; ?>
        });
    </script>
    <?php endif; ?>

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
        });

        function cerrarAlerta() {
            document.getElementById('overlay').style.display = 'none';
        }
    </script>
</body>
</html>
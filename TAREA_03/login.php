<?php
// Llamar a errores y funciones
require("errores.php");
require("funciones.php");

session_start();

// Solo si se envía el formulario, se definen las variables de alerta
if (isset($_POST['email']) && isset($_POST['password'])) {
    // Recoger datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Llamamos a la base de datos
    $conexion = conectarBBDD();

    // Consultamos la base de datos para ver si el email y la contraseña coinciden
    $sentenciaSQL = "SELECT * FROM usuarios WHERE email = ?";
    $sentenciaPreparada = $conexion->prepare($sentenciaSQL);
    $sentenciaPreparada->bind_param("s", $email);
    $sentenciaPreparada->execute();

    $resultado = $sentenciaPreparada->get_result();

    if ($resultado->num_rows > 0) {
        // Si encontramos el usuario
        $usuario = $resultado->fetch_assoc();

        // Verificamos si la contraseña es correcta
        // Aquí no usamos password_verify, sino que comparamos directamente
        if ($password === $usuario['password']) {  // Comparación directa
            // Iniciar sesión
            $_SESSION['email'] = $email;
            $_SESSION['nombre'] = $usuario['nombre'];

            // Redirigir al usuario a la página principal o área privada
            header("Location: perfil.php");
            exit;
        } else {
            $alerta = "Contraseña incorrecta";
        }
    } else {
        $alerta = "El correo electrónico no está registrado";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="IMG/grupo-eci.ico" rel="shortcut icon"><!--icono que sale en la pestaña del buscador-->

    <script src="bootstrap.bundle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Iniciar Sesión - El Corte Inglés</title>
    <!-- Enlace a Font Awesome para los íconos -->
    <link rel="stylesheet" href="CSS.css">
    
</head>

<body class="login">

    <section class="img-login">
        <img src="IMG/mi_cuenta_login.png" alt="mi_cuenta">
    </section>

    <main class="text-login">
        <h2>Inicia sesión</h2>
        <p>Inicia sesión para acceder a todos nuestros servicios</p>
        <form action="#" method="post">
            <label for="email">Correo electrónico *</label>
            <input type="text" id="email" name="email" placeholder="usuario@example.com" required><br>
            <label for="password">Contraseña *</label>
            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Contraseña" required>
                <button type="button" id="toggle-password" class="eye-icon">
                    <i class="fas fa-eye"></i>
                </button>
                </div>
            <p>¿Aún sin cuenta?<a href="registro.php">Registrate</a></p>

            <button type="submit" class="btn btn-dark w-100">INICIAR SESIÓN</button>
        </form>
        
    </main>
    <!--Pie de página-->
    <footer class="footer">
        <div class="legal">
            <p><img src="IMG/grupo-eci.ico" width="30" alt="grupo-eci.ico">&copy; 1940-2025 El Corte Inglés S.A.
                Todos los derechos reservados.</p>
            <ul>
                <li><a href="#">Condiciones de uso</a></li>
                <li><a href="#">Política de privacidad</a></li>
                <li><a href="#">Política de Cookies</a></li>
            </ul>
        </div>
    </footer>

    <script>
        // OJO PASSWORD
        document.getElementById('toggle-password').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const icon = this.querySelector('i');

            // Cambiar el tipo del campo de contraseña
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>

</body>

</html>
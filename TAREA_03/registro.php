<?php
session_start();
require('funciones.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Asegúrate de que las variables no sean nulas antes de acceder a ellas
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';  // Sin password_hash()
    $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
    $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : null; // Si no se proporciona, puede ser null
    $autonomo = isset($_POST['autonomo']) ? 1 : 0; // Verificar si se marcó el checkbox (1 = true, 0 = false)
    $nif_cif = isset($_POST['nif_cif']) ? $_POST['nif_cif'] : null;

    // Conectar a la base de datos
    $conexion = conectarBBDD();

    // Verificar si el email ya existe en la base de datos
    $query = "SELECT email FROM usuarios WHERE email = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        echo "El correo electrónico ya está registrado.";
        exit;
    }

    // Preparamos la consulta SQL para insertar los datos
    $sentenciaSQL = "INSERT INTO usuarios (nombre, email, password, apellido, apellidos, autonomo, nif_cif) 
                     VALUES (?, ?, ?, ?, ?, ?, ?)";
    $sentenciaPreparada = $conexion->prepare($sentenciaSQL);
    $sentenciaPreparada->bind_param("sssssis", $nombre, $email, $password, $apellido, $apellidos, $autonomo, $nif_cif);

    if ($sentenciaPreparada->execute()) {
        // Redirigir al login si el registro fue exitoso
        $_SESSION['email'] = $email; // Iniciar sesión automáticamente
        header("Location: login.php"); // Redirigir al login
        exit;
    } else {
        echo "Error al registrar el usuario: " . $sentenciaPreparada->error;
    }

    $sentenciaPreparada->close();
    $conexion->close();
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=Kalam" rel="stylesheet">

    <link href="IMG/grupo-eci.ico" rel="shortcut icon"><!--icono que sale en la pestaña del buscador-->


    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="CSS.css">
    <title>Mi Cuenta-Registro El Corte Inglés</title>

   
</head>

<body class="inscripción">

    <!-- Imagen de formulario inscripción -->
    <section class="contenedor-principal">
        <section class="info-titulo text-center mb-4">
            <img src="IMG/mi_cuenta-removebg-preview.png" width="250" alt="mi_cuenta">
            <h2 class="eci-text mt mb">Crea una cuenta para todo El Corte Inglés</h2>
            <p class="eci">
                Y podrás acceder a El Corte Inglés y disfrutar también del resto de nuestras marcas y tiendas.</p>
        </section>

        <section class="container-content row">
            <!-- Formulario -->
            <section class="container-derecho col-md-7">

                <form action="#" method="POST">
                    <!-- Formulario de email -->
                    <fieldset class="form-email mb-3">
                        <legend class="datos">Datos básicos de tu cuenta</legend>
                        <label for="email">Añade tu correo electrónico:</label>
                        <input type="email" id="email" name="email" class="form-control"
                            placeholder="usuario@example.com*" required>
                        <small>Este será tu identificador de cuenta.</small>
                    </fieldset>

                    <!-- Formulario de contraseña -->
                    <fieldset class="form-acceso mb-3">
                        <div class="password-container">
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Nueva contraseña*" required autocomplete="new-password">
                            <button type="button" id="toggle-password" class="eye-icon">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <small>Tu contraseña debe tener al menos:<br>
                            8 caracteres, 1 número, 1 minúscula, 1 mayúscula y 1 carácter especial.
                        </small>
                    </fieldset>

                    <!-- Datos personales -->
                    <fieldset class="form-personal mb-3">
                        <legend class="datos">Datos personales</legend>
                        <label for="nombre"></label>
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre*" required class="form-control">
                        <label for="apellido"></label>
                        <input type="text" id="apellido" name="apellido" placeholder="Apellido*" required class="form-control">
                        <label for="apellidos"></label>
                        <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos*" class="form-control">
                    </fieldset>

                    <!-- Autonomo o empresa -->
                    <fieldset class="form-check form-switch d-flex justify-content-end mb-3">
                        <label class="form-check-label" for="toggleSwitch">Soy autónomo o empresa.</label>
                        <input class="form-check-input" type="checkbox" id="autonomo" name="autonomo">
                    </fieldset>
                    <label for="nif_cif" class="form-label"></label>
                    <input type="text" name="nif_cif" id="nif_cif" class="form-control w-50" placeholder="Nif_cif"><br>
                    <!-- Botón -->
                    <section aria-label="botones_inscripcion">
                        <button type="submit" class="btn btn-dark w-100">Continuar</button>
                    </section>
                </form>

            </section>

            <!-- Información adicional (izquierda) -->
            <aside class="container-izquierdo col-md-5">
                <section class="info-registro mb-4">
                    <p class="text">Ventajas al crear una cuenta para todo El Corte Inglés</p>
                </section>

                <!-- Ventajas -->
                <article class="signup">
                    <figure class="linea">
                        <img src="IMG/payment.jpg" alt="payment" width="35" height="35">
                        <p>Pago en tienda</p>
                    </figure>
                    <p>Podrás pagar desde nuestra app con tu medio de pago y utilizar tus
                        cupones de ofertas y descuentos en todas nuestras tiendas.</p>
                </article>

                <article class="signup">
                    <figure class="linea">
                        <img src="IMG/factura.jpg" alt="factura" width="35" height="45">
                        <p>Facturas</p>
                    </figure>
                    <p class="eci-text font-s">¡Solicita factura sin ir a la tienda! Con tus tiques de compra o
                        seleccionando desde Mi Cuenta en tu ordenador, teléfono o app.</p>
                </article>

                <article class="signup">
                    <figure class="linea">
                        <img src="IMG/appointment.jpg" alt="appointment" width="35" height="40">
                        <p>Cita</p>
                    </figure>
                    <p class="eci-text font-s">Reserva día y hora en los servicios de cualquiera de nuestras tiendas.
                        Asegúrate una atención personalizada cuando mejor te venga.</p>
                </article>

                <article class="signup">
                    <figure class="linea">
                        <img src="IMG/parking.jpg" alt="parking" width="30" height="30">
                        <p>Parking</p>
                    </figure>
                    <p class="eci-text font-s">Utiliza nuestros aparcamientos sin esperar colas. Desde nuestra app añade
                        tus vehículos habituales y ya no tendrás necesidad de esperar colas.</p>
                </article>
            </aside>
        </section>
    </section>
    <!-- Footer -->
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

    <!-- JS -->
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
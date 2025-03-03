<?php
session_start();
require('funciones.php');

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

$conexion = conectarBBDD();
$email = $_SESSION['email'];
$sentenciaSQL = "SELECT * FROM usuarios WHERE email = ?";
$sentenciaPreparada = $conexion->prepare($sentenciaSQL);
$sentenciaPreparada->bind_param("s", $email);
$sentenciaPreparada->execute();
$resultado = $sentenciaPreparada->get_result();

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
    $res_nombre = $usuario['nombre'];
    $res_email = $usuario['email'];
    $res_apellido = $usuario['apellido'];
    $res_apellidos = $usuario['apellidos'];
    $res_autonomo = $usuario['autonomo'] ? 'Sí' : 'No';
    $res_nif_cif = $usuario['nif_cif']; // Aquí recogemos el NIF/CIF
    $id = $usuario['id']; // ID para actualizar o eliminar

    // Guardar el ID en la sesión
    $_SESSION['id'] = $id;
} else {
    echo "Usuario no encontrado";
    exit();
}

if (isset($_GET['action']) && $_GET['action'] == 'eliminar') {
    $sentenciaEliminar = "DELETE FROM usuarios WHERE id = ?";
    $sentenciaPreparada = $conexion->prepare($sentenciaEliminar);
    $sentenciaPreparada->bind_param("i", $id);
    $sentenciaPreparada->execute();
    session_destroy();
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="IMG/grupo-eci.ico" rel="shortcut icon">
    <link rel="stylesheet" href="CSS.css">
    <title>Perfil de Usuario</title>
</head>

<body class="perfil-usuario">
    <header class="container-usuario dark bg-dark h-50">
        <nav>
            <ul class="list-unstyled d-flex justify-content-end mb-0">
                <li class="me-3"><i class="fa-solid fa-circle-question text-white"></i> <a
                        class="text-white text-decoration-none" href="#">Ayuda</a></li>
                <li class="me-3"><i class="fa-solid fa-gear text-white"></i> <a class="text-white text-decoration-none"
                        href="#">Ajustes</a></li>
                <li class="me-3"><i class="fa-solid fa-right-from-bracket text-white"></i> <a
                        class="text-white text-decoration-none" href="login.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>
    <main class="container-fluid d-flex">
        <!-- Lateral -->
        <aside class="bg-light p-4">
            <section>
                <span><a href="#"><img src="IMG/logooo.png" width="180" alt="logo"></a></span>
                <ul class="list-unstyled">
                    <li><a class="text-decoration-none text-dark" href="#">Mi perfil</a></li>
                    <li><a class="text-decoration-none text-dark" href="#">Mensajes</a></li>
                    <li><a class="text-decoration-none text-dark" href="#">Facturas/Tikets</a></li>
                    <li><a class="text-decoration-none text-dark" href="#">Novedades</a></li>
                    <li><a class="text-decoration-none text-dark" href="#">Tarjeta Corte Inglés</a></li>
                </ul>
            </section>
        </aside>

        <!-- Main Content -->
        <section class="flex-grow-1 p-4">
            <section>
                <p>Hola, <b><?= $res_nombre ?></b> Bienvenido/a:</p>
            </section>
            <section>
                <p>Tu E-mail es: <b><?= $res_email ?></b></p> <!-- Muestra el email pero no se puede actualizar -->
            </section>
            <section>
                <p>Primer apellido: <b><?= $res_apellido ?></b></p>
            </section>
            <section>
                <p>Segundo apellido: <b><?= $res_apellidos ?></b></p>
            </section>
            <section>
                <p>Autónomo/Empresa: <b><?= $res_autonomo ?></b></p>
            </section>
            <section>
                <p>CIF/NIF: <b><?= $res_nif_cif ?></b></p>
            </section>
            <br>
            <button class="bb">
                <a href="actualizar.php?id=<?= $id ?>">Actualizar Perfil</a>
            </button>
            <button class="bb">
                <a href="?action=eliminar" onclick="return confirm('¿Deseas eliminar la cuenta actual?');">Eliminar cuenta</a>
            </button>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <section class="legal">
            <p><img src="IMG/grupo-eci.ico" width="30" alt="grupo-eci.ico">&copy; 1940-2025 El Corte Inglés S.A.
                Todos los derechos reservados.</p>
            <ul>
                <li><a href="#">Condiciones de uso</a></li>
                <li><a href="#">Política de privacidad</a></li>
                <li><a href="#">Política de Cookies</a></li>
            </ul>
        </section>
    </footer>
</body>

</html>
<?php
session_start();
require('funciones.php');

// Verifica si el usuario ha iniciado sesión y si el id en la URL coincide con el id de la sesión
if (!isset($_SESSION['email']) || !isset($_GET['id']) || $_SESSION['id'] != $_GET['id']) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id']; // Obtener el ID del usuario desde la URL

// Conectar a la base de datos
$con = conectarBBDD();

// Manejo del formulario de actualización
if (isset($_POST['submit'])) {
    // Obtener valores del formulario
    $nombre = trim($_POST['nombre']);   
    $apellido = trim($_POST['apellido']);
    $apellidos = trim($_POST['apellidos']);
    $nif_cif = trim($_POST['nif_cif']);
    $autonomo = isset($_POST['autonomo']) ? 1 : 0;

    // Validación de los campos obligatorios
    if (empty($nombre) || empty($apellido)) {
        echo "<div class='alert alert-danger'>Por favor, rellena los campos obligatorios: Nombre y Primer Apellido.</div>";
    } else {
        // Usar una consulta preparada para actualizar los datos (sin tocar el email)
        $stmt = $con->prepare("UPDATE usuarios SET nombre=?, apellido=?, apellidos=?, nif_cif=?, autonomo=? WHERE id=?");
        $stmt->bind_param("ssssii", $nombre, $apellido, $apellidos, $nif_cif, $autonomo, $id);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Perfil actualizado con éxito!</div><br>";
            echo "<a href='perfil.php'><button class='btn btn-primary'>Volver al perfil</button></a>";
        } else {
            echo "<div class='alert alert-danger'>Hubo un error al actualizar los datos.</div>";
        }
    }
} else {
    // Si el formulario no fue enviado, obtenemos los datos actuales del usuario
    $query = $con->prepare("SELECT nombre, email, apellido, apellidos, nif_cif, autonomo FROM usuarios WHERE id=?");
    $query->bind_param("i", $id);
    $query->execute();
    $query->store_result();

    if ($query->num_rows > 0) {
        $query->bind_result($res_nombre, $res_email, $res_apellido, $res_apellidos, $res_nif_cif, $res_autonomo);
        $query->fetch();
    } else {
        // Si no se encuentran datos, redirigiimos al login
        echo "<div class='alert alert-danger'>No se encontraron datos para el usuario. Redirigiendo...</div>";
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="IMG/grupo-eci.ico" rel="shortcut icon">
    <link rel="stylesheet" href="CSS.css">
</head>

<body class="actualizar-page">

    <!-- Navbar -->
    <header class="actualizar-perfil">
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

    <!-- Lateral -->
    <main class="container-fluid d-flex">

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

        <section class="container mt-4">
            <figure class="info-titulo text-center mb-4">
                <img src="IMG/mi_cuenta-removebg-preview.png" width="300" alt="mi_cuenta">
                <p class="text-center">Actualizar Perfil</p>                   
            </figure>
            <form action="" method="post">
                <section class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= isset($res_nombre) ? $res_nombre : '' ?>" required>
                </section>

                <section class="mb-3">
                    <label for="email" class="form-label">Email (No editable)</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?= isset($res_email) ? $res_email : '' ?>" readonly>
                </section>

                <section class="mb-3">
                    <label for="apellido" class="form-label">Primer Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" value="<?= isset($res_apellido) ? $res_apellido : '' ?>" required>
                </section>

                <section class="mb-3">
                    <label for="apellidos" class="form-label">Segundo Apellido</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?= isset($res_apellidos) ? $res_apellidos : '' ?>">
                </section>

                <section class="mb-3">
                    <label for="nif_cif" class="form-label">NIF/CIF</label>
                    <input type="text" class="form-control" id="nif_cif" name="nif_cif" value="<?= isset($res_nif_cif) ? $res_nif_cif : '' ?>">
                </section>

                <section class="mb-3">
                    <label for="autonomo" class="form-label">¿Eres autónomo?</label>
                    <input type="checkbox" class="form-check-input" id="autonomo" name="autonomo" <?= isset($res_autonomo) && $res_autonomo == 1 ? 'checked' : '' ?>>
                </section>

                <button type="submit" name="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </section>
    </main><br>
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

</body>

</html>
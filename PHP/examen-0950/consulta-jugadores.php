<!-- http://localhost/Curso/Examen-0950/consulta-jugadores.php -->

<?php
// Llamar a errores y funciones
require("errores.php");
require("funciones.php");

/* Recogemos datos del formulario */
$alerta = "Mensaje...";

// Solo si se envía el formulario, se definen las variables del alert
if (isset($_REQUEST['enviar'])) {
    // Llamamos a la BBDD
    $conexion = conectarBBDD();

    // Hacemos la consulta con un JOIN xq tiene que darme los datos de las dos tablas
    $consulta = "SELECT * FROM jugadores,clubes
                 WHERE clubes.idclub = jugadores.club";
    $filas = $conexion->query($consulta);
    $numFilas = $filas->num_rows;
    $alerta = "Nº de Registros: " . $numFilas;
}
?>

<!-- Comenzamos la sección HTML -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantilla</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="examen0950.css">
</head>

<body>
    <!-- En el alert presentamos los datos recogidos del formulario -->
    <header>
        <p class="alert alert-primary m-3 w-50" style="white-space: pre-line;">
            <?php echo $alerta; ?>
        </p>
    </header>

    <!-- En el class defino bootstrap-->
    <section class="container align-center m-3 w-70 bg-primary">
        <!-- Inyección de script (PHP)-->
        <?php
        // Si se envia el formulario, cargo la tabla
        if (isset($_REQUEST['enviar'])) {
        ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>nif_nie</th>
                        <th>nombre</th>
                        <th>edad</th>
                        <th>fincontrato</th>
                        <th>posiciones</th>
                        <th>club</th>
                    </tr>
                </thead>
                <tbody>
                    <?php       // Asocio la salida a su campo en vez de ASSOC es NUM xq va con múmeros
                    $jugadores = $filas->fetch_all(MYSQLI_ASSOC);
                    foreach ($jugadores as $jugador) {
                    ?>
                        <!-- tr>td*5  -->
                        <tr>
                            <td><?php echo $jugador['nif_nie']; ?></td>
                            <td><?php echo $jugador['nombre']; ?></td>
                            <td><?php echo $jugador['edad']; ?></td>
                            <td><?php echo $jugador['fincontrato']; ?></td>
                            <td><?php echo $jugador['posiciones']; ?></td>
                            <td><?php echo $jugador['club']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        }
        ?>
    </section>
    <hr class="m-3 border border-primary border-5 w-50">

    <form action="#" method="post" class="m-3 shadow-lg">
        <button type="submit" class="btn btn-success" name="enviar">Ver jugadores</button>
    </form>

    <!-- Defino enlaces de navegación -->
    <section class="row">
        <nav class="col">
            <a href="cargaBBDD.php"
                class="btn btn-sm btn-success w-100">Cargar BBDD</a>

            <a href="inserta-club.php"
                class="btn btn-sm btn-warning w-100">Insertar club</a>

            <a href="inserta-jugador.php"
                class="btn btn-sm btn-warning w-100">Inserta jugador</a>
        </nav>
        <nav class="col">
            <a href="consulta-jugadores.php"
                class="btn btn-sm btn-secondary w-100">Consultar Tablas</a>

            <a href="actualizar-jugador.php"
                class="btn btn-sm btn-secondary w-100">Actualizar Jugador</a>

            <a href="borrar-jugador.php"
                class="btn btn-sm btn-danger w-100">Borrar jugador</a>
        </nav>
    </section>
</body>

</html>
<!-- http://localhost/Curso/examen0950/borrar-jugador.php -->

<?php
// Llamar a errores y funciones
require("errores.php");
require("funciones.php");

/* Recogemos datos del formulario */
$alerta = "";

// Llamamos a la BBDD
$conexion = conectarBBDD();



// Si se pulsa SI, se elimina por referencia
if (isset($_REQUEST['eliminar'])) {
    // Desactivo las excepciones por error en el driver MYSQLi
    mysqli_report(MYSQLI_REPORT_OFF);

    // Borramos el registro con una SENTENCIA PREPARADA
    $nif_nie = $_REQUEST['nif_nie'];
    $sql = "DELETE FROM jugadores WHERE nif_nie = ?";
    $sentenciaPreparada = $conexion->prepare($sql);
    $sentenciaPreparada->bind_param("s", $nif_nie);

    $ejecutaSQL = $sentenciaPreparada->execute();
    if($ejecutaSQL) {
        $alerta .= "<br> Registro eliminado!";
    } else {
        $alerta .= "<br> ERROR en el borrado: " . $conexion->error;
    }

}

// Si se pulsa NO, concateno este mensaje
if (isset($_REQUEST['volver'])) {
    $alerta .= "<br>No se ha borrado registro";
}

// Hacemos la consulta
$consulta = "SELECT * FROM jugadores";
$filas = $conexion->query($consulta);
$numFilas = $filas->num_rows;
$alerta .= "<br> Nº de Registros: " . $numFilas;
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

        <table class="table">
            <thead>
                <tr>
                    <th>Nif_nie</th>
                    <th>nombre</th>
                    <th>edad</th>
                    <th>fincontrato</th>
                    <th>posiciones</th>
                    <th>Club</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php       // Asocio la salida a su campo
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
                        <!-- En cada fila pongo un botón Eliminar -->
                        <td>
                            <form action="#" method="post">
                                <input type="hidden" name="nif_nie"
                                    value="<?php echo $jugador['nif_nie']; ?>">
                                <input type="hidden" name="nombre"
                                    value="<?php echo $jugador['nombre']; ?>">
                                <button type="submit" name="confirmar" class="btn btn-outline-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </section>
    <hr class="m-3 border border-primary border-5 w-50">

    <?php
    if (isset($_REQUEST['confirmar'])) {
    ?>
        <p>¿Desea eliminar <?php echo $_REQUEST['nombre']; ?>?</p>
        <form action="#" method="post">
            <input type="hidden" name="nif_nie"
                value="<?php echo $_REQUEST['nif_nie']; ?>">
            <button type="submit" name="eliminar"
                class="btn btn-outline-danger">SI</button>
            <button type="submit" name="volver"
                class="btn btn-outline-success">NO</button>
        </form>
    <?php
    }
    ?>

    <form action="#" method="post" class="m-3 shadow-lg">
        <button type="submit" class="btn btn-success" name="enviar">Eliminar</button>
    </form>
     <!-- Defino enlaces de navegación -->
    <section class="row">
        <nav class="col">
            <a href="index.php"
                class="btn btn-sm btn-success w-100">Volver al inicio</a>
        </nav>
    </section>
</body>

</html>
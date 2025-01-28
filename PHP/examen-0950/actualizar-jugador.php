<!-- http://localhost/Curso/PHP/actualizar-jugador.php -->
<?php
// Llamar a errores y funciones
require("errores.php");
require("funciones.php");

/* Recogemos datos del formulario */
$alerta = "Mensaje...";

// Llamamos a la BBDD
$conexion = conectarBBDD();

// Hacemos la consulta
$consulta = "SELECT * FROM jugadores";
$filas = $conexion->query($consulta);
$numFilas = $filas->num_rows;
$alerta = "Nº de Registros: " . $numFilas;

// Solo si se envía el formulario, se definen las variables del alert
if (isset($_REQUEST['enviar'])) {
    // La clave principal
    $nif = $_REQUEST['nif'] ?? '';

    // El resto de campos a actualizar
    $nombre = $_REQUEST['nombre'] ?? '';
    $edad = $_REQUEST['edad'] ?? '';
    $fincontrato = $_REQUEST['fincontrato'] ?? '';




    $alerta = "nif-nie: $nif_nie
        Nombre: $nombre
        edad: $edad
       fincontrato: $fincontrato";

    // Ahora introducimos lo de arriba en la BBDD
    // Defino una Sentencia preparada (? por cada campo!)
    $sentenciaSQL = "UPDATE jugadores SET nombre = ?, 
                    nombre = ?, edad = ?, fincontrato = ? WHERE nif_nie = ? "; // es el pk
    $sentenciaPreparada = $conexion->prepare($sentenciaSQL);
    // Encriptamos la sentencia (bind_param)
    $sentenciaPreparada->bind_param(
        "sis",

        $nombre,
        $edad,
        $fincontrato

    );

    // ejecutaSQL es booleano; true (correcto), false (error)
    $ejecutaSQL = $sentenciaPreparada->execute();
    if ($ejecutaSQL) {
        $alerta .= "<br> jugador/a actualizado correctamente";
    } else {
        $alerta .= "<br> ERROR FATAL (explota!)";
    }

    $filas = $conexion->query($consulta);
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

    <!-- Línea de separación -->
    <hr class="m-3 border border-primary border-5">

    <table class="table">
        <thead>
            <tr>

                <th>nombre</th>
                <th>edad</th>
                <th>fincontrato</th>
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

                    <td><?php echo $jugador['nombre']; ?></td>
                    <td><?php echo $jugador['edad']; ?></td>
                    <td><?php echo $jugador['fincontrato']; ?></td>
                    <!-- En cada fila pongo un botón Eliminar -->
                    <td>
                        <form action="#" method="post">
                            <input type="hidden" name="nif_nie"
                                value="<?php echo $alumno['nif_nie']; ?>">
                            <button type="submit" name="cargar"
                                class="btn btn-outline-primary">Actualizar</button>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <!-- Línea de separación -->
    <hr class="m-3 border border-primary border-5">

    <?php
    if (isset($_REQUEST['cargar'])) {
        // Cargo el formulario con el registro seleccionado
        // Desactivo las excepciones por error en el driver MYSQLi
        mysqli_report(MYSQLI_REPORT_OFF);

        // Recojo el campo clave principal
        $nif = $_REQUEST['nif_nie'];
        $sql = "SELECT * FROM jugadores WHERE nif_nie = ?";
        $sentenciaPreparada = $conexion->prepare($sql);
        $sentenciaPreparada->bind_param("s", $nif);
        $ejecutaSQL = $sentenciaPreparada->execute();

        $fila = $sentenciaPreparada->get_result();
        $alumno = $fila->fetch_assoc();

    ?>

        <form action="#" method="post" class="m-3 shadow-lg">

            <!-- Campo nombre-->
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" id="nombref"
                class="form-control w-50" required disabled
                value="<?php echo $jugador['nombre']; ?>"><br>
            <!-- -->
            <!-- Campo edad-->
            <label for="edad" class="form-label">Dime la edad:</label>
            <input type="number" name="edad" id="edad"
                class="form-control w-50" required
                value="<?php echo $jugador['edad']; ?>"><br>
            <!-- -->
            <!-- Campo Fin contrato -->
            <label for="fincontrato" class="form-label">Fin de contrato:</label>
            <input type="date" name="fincontrato" id="fincontrato"
                class="form-control w-50" required
                value="<?php echo $jugador['fincontrato']; ?>"><br>



            <!-- -->
            <hr class="border border-primary border-5 w-50">
            <button type="submit" class="btn btn-success" name="enviar">Enviar</button>
        </form>

    <?php
    }
    ?>

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
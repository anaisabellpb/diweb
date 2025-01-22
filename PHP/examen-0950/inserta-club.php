<!-- http://localhost/Curso/Examen-0950/inserta-club.php -->
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

    $idclub = $_REQUEST['idclub'] ?? '';
    $nombreclub = $_REQUEST['nombreclub'] ?? '';
    $internacional = $_REQUEST['internacional'] ?? '';

    $alerta = " idclub: $idclub
       nombreclub: $nombreclub
        internacional: $internacional";

    // Ahora introducimos lo de arriba en la BBDD
    // Defino una Sentencia preparada (? por cada campo!)
    $sentenciaSQL = "INSERT INTO clubes 
                    (idclub,nombreclub,internacional) 
                    VALUES (?,?,?)";
    $sentenciaPreparada = $conexion->prepare($sentenciaSQL);
    // Encriptamos la sentencia (bind_param)
    $sentenciaPreparada->bind_param(
        "isi",
        $idclub,
        $nombreclub,
        $internacional
    );

    // ejecutaSQL es booleano; true (correcto), false (error)
    $ejecutaSQL = $sentenciaPreparada->execute();
    if ($ejecutaSQL) {
        $alerta .= "<br> Inserción correcta";
    } else {
        $alerta .= "<br> ERROR FATAL (explota!)";
    }
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
</head>

<body>
    <!-- En el alert presentamos los datos recogidos del formulario -->
    <header>
        <p class="alert alert-primary m-3 w-50" style="white-space: pre-line;">
            <?php echo $alerta; ?>
        </p>
    </header>

    <!-- Línea de separación -->
    <hr class="m-3 border border-primary border-5 w-50">

    <form action="#" method="post" class="m-3 shadow-lg">
        <!-- -->
        <!-- Campo idclub -->
        <label for="idclub " class="form-label">id del club :</label>
        <input type="number" name="idclub " id="idclub "
            class="form-control w-50" required><br>

        <!-- Campo nombreclub -->
        <label for="nombreclub" class="form-label">Nombre del club:</label>
        <input type="nombreclub" name="nombreclub" id="nombreclub"
            class="form-control w-50" required><br>

        <!-- Campo internacional -->
        <label class="form-label">internacional</label><br>
        <input type="radio" name="internacional" value="si" id="si">
        <label for="si">SI</label><br>
        <input type="radio" name="internacional" value="no" id="no">
        <label for="no">NO</label><br><br>


        <!-- -->
        <hr class="border border-primary border-5 w-50">
        <button type="submit" class="btn btn-success" name="enviar">Insertar club</button>
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
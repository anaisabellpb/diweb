<!-- http://localhost/Curso/Examen0950/inserta-jugador.php -->
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

    $nif_nie = $_REQUEST['nif_nie'] ?? '';
    $nombre = $_REQUEST['nombre'] ?? '';
    $edad = $_REQUEST['edad'] ?? '';
    $fincontrato = $_REQUEST['fincontrato'] ?? '';
    $posiciones = $_REQUEST['posiciones'] ?? '';
    $club = $_REQUEST['club'] ?? '';

    $alerta = " nif_nie: $nif_nie
       nombre: $nombre
        edad: $edad
        fincontrato: $fincontrato
        posiciones: $posiciones
        club: $club";

    // Ahora introducimos lo de arriba en la BBDD
    // Defino una Sentencia preparada (? por cada campo!)
    $sentenciaSQL = "INSERT INTO jugadores
                    (nif,nombre,edad,fincontrato,posiciones,club) 
                    VALUES (?,?,?,?,?,?)";
    $sentenciaPreparada = $conexion->prepare($sentenciaSQL);
    // Encriptamos la sentencia (bind_param)
    $sentenciaPreparada->bind_param(
        "ssissi",
        $nif,
        $nombre,
        $edad,
        $fincontrato,
        $posiciones,
        $club
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
        <!-- Campo NIF -->
        <label for="nif" class="form-label">Nif:</label>
        <input type="text" name="nif" id="nif"
            class="form-control w-50" required><br>
        <!-- -->
        <!-- Campo NOMBRE -->
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="nombre" name="nombre" id="nombre"
            class="form-control w-50" required><br>
        <!-- -->
        <!-- Campo EDAD -->
        <label for="edad" class="form-label">Dime la edad:</label>
        <input type="number" name="edad" id="edad"
            class="form-control w-50" required><br>

        <!-- Campo posiciones -->
        <label for="posiciones" class="form-label">posiciones</label>
        <select name="posiciones" id="posiciones" class="form-select w-50">
            <option value=""></option>
            <option value="portero">portero</option>
            <option value="defensa">defensa</option>
            <option value="centro">centro</option>
            <option value="delantero">delantero</option>
        </select><br>

        <!-- Campo club -->
        <label for="club" class="form-label">club</label>
        <select name="club" id="club" class="form-select w-50">
            <option value=""></option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            </select><br>

      

        <!-- -->
        <hr class="border border-primary border-5 w-50">
        <button type="submit" class="btn btn-success" name="enviar">Insertar</button>
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
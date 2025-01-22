<!-- http://localhost/examen-0950/index.php -->

<!-- Comenzamos la sección HTML -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="examen0950.css">

</head>

<body>
    <!-- En el alert presentamos los datos recogidos del formulario -->
    <header>
        <p class="alert alert-primary m-3 w-50" style="white-space: pre-line;">
            MENU AnidiFC
        </p>
    </header>

    <!-- Línea de separación -->
    <hr class="m-3 border border-primary border-5 w-50">

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
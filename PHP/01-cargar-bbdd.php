<!-- http://localhost/Curso/PHP/01-cargar-bbdd.php -->

<?php
// Llamar a errores y funciones
require("errores.php");
require("funciones.php");

//Llamamos a la base de datos
$conexion = conectar();


// Recogemos datos del formulario 
$alerta = "Mensaje...";

// Solo si se envía el formulario, se definen las variables del alert
if (isset($_REQUEST['enviar'])) {
    $archivoSQL = "MiConexion_simplificando.sql";
    $contenidoSQL = file_get_contents($archivoSQL);

/*Formato procedimental */
$cargaBBD = mysqli_multi_query($conexion, $contenidoSQL);



    $alerta = "Nº de Registros: " . $numfilas;
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
        <button type="submit" class="btn btn-success" name="enviar">Cargar BBDD</button>
    </form>
    <!-- Defino enlaces de navegación con estilo boostrap-->
     <section class="row">
        <nav class="col">
            <a href="02-consultar.php"
            class="btn btn-sm btn-success w-100">Consultar productos</a>
            <a href="03-insertar-bbdd.php"
            class="btn btn-sm btn-warning w-100">Insertar producto</a>
        </nav>
        <nav class="col">
            <a href="04-actualizar-bbdd.php"
            class="btn btn-sm btn-secondary w-100">Actualizar producto</a>
            <a href="05-eliminar-bbdd.php"
            class="btn btn-sm btn-danger w-100">Eliminar producto</a>
        </nav>
     </section>
</body>

</html>
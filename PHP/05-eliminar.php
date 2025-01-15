<!-- http://localhost/Curso/PHP/05-eliminar.php -->

<?php
// Llamar a errores y funciones
require("errores.php");
require("funciones.php");

// Recogemos datos del formulario 
$alerta = "Mensaje...";

//Llamamos a la base de datos
$conexion = conectarBBDD();

//Hacemos la consulta
$consulta = "SELECT * FROM productos";
$filas = $conexion->query($consulta);
$numfilas = $filas->num_rows;
$alerta = "Nº de Registros: " . $numfilas;


// Solo si se envía el formulario, se definen las variables del alert
if (isset($_REQUEST['enviar'])) {
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
    <!-- En el class defino con bootstrap el bg es el fondo primary el color-->
    <section class="container align-center m-3 w-70 bg-primary">
        <!-- Poner php en medio del html se le llama inyección de scrip-->

        <table class="table">
            <thead>
                <tr>
                    <th>Referencia</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Categorías</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Asocia la salida a su campo
                $productos = $filas->fetch_all(MYSQLI_ASSOC);
                foreach ($productos as $producto) {
                ?>
                    <!-- tr>td*5-->
                    <tr>
                        <td><?php echo $producto['Referencia']; ?></td>
                        <td><?php echo $producto['Descripcion']; ?></td>
                        <td><?php echo $producto['Precio']; ?></td>
                        <td><?php echo $producto['Stock']; ?></td>
                        <td><?php echo $producto['Categorias']; ?></td>
                        <!-- En cada fila pongo un botón eliminar-->
                        <td><a href="05-eliminar.php?Referencia=<?php echo $producto['Referencia']; ?>"
                        class="btn btn-outline-danger">Eliminar</a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </section>

    <!-- Línea de separación -->
    <hr class="m-3 border border-primary border-5 w-50">

    <form action="#" method="post" class="m-3 shadow-lg">
        <button type="submit" class="btn btn-success" name="enviar">Consultar</button>
    </form>
    <!-- Defino enlaces de navegación con estilo boostrap-->
    <section class="row">
        <nav class="col">
            <a href="01-cargar-bbdd.php"
                class="btn btn-sm btn-success w-100">Cargar BBDD</a>
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
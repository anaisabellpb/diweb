<!-- http://localhost/Curso/PHP/03-insertar.php -->

<?php
// Llamar a errores y funciones
require("errores.php");
require("funciones.php");

/* Recogemos datos del formulario */
$alerta = "Mensaje...";

// Solo si se envía el formulario, se definen las variables del alert
if (isset($_REQUEST['enviar'])) {
    //Llamamos a la base de datos
    $conexion = conectarBBDD();

    $referencia = $_REQUEST['Referencias'] ?? '';
    $descripcion = $_REQUEST['Descripcion'] ?? '';
    $precio = $_REQUEST['Precio'] ?? '';
    $stock = $_REQUEST['Stock'] ?? '';

    // En el caso de categorias mando un array
    $categorias = $_REQUEST['Categorias'] ?? [];

    // implode sirve para escribir los elementos del array
    $categoriasValores = implode(', ', $categorias);
    $alerta = " Referencia: $referencia
        Descripcion: $descripcion
        Precio: $precio
        Stock: $stock
        Categorias: $categoriasValores";  // valor array

    // Ahora introducimos lo de arriba en la BBDD
    // Defino una sentencia preparada para evitar hakeos, se encriptan poniendo ?, por cada valor y la sentencia
    // la 1º encriptación es con el prepare y la 2º es con la sustitución de las letras, aqui es idis.
    $sentenciaSQL = "INSERT INTO productos 
                     (Referencia, Descripcion, Precio, Stock, Categorias)
                    VALUES (?,?,?,?,?)";
    $sentenciaPreparada = $conexion->prepare($sentenciaSQL);
    // Encriptamos la sentencia (bind_param)
    $sentenciaPreparada->bind_param("isdis", $referencia, $descripcion, $precio, $stock, $categoriasValores);
    
    // ejecute es booleano; true (correcto) false (error)
    $ejecutaSQL = $sentenciaPreparada->execute();
    if ($ejecutaSQL) {
        $alerta .= "<br> Producto insertado correctamente";
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
        <!--campo REFERECNIA-->
        <label for="Referencia" class="form-label">Referencia:</label>
        <input type="number" name="Referencia" id="Referencia"
            class="form-control w-50" required><br>

        <!-- -->
        <!--Campo DESCRIPCIÓN -->
        <label for="Descripcion" class="form-label">Descripción:</label>
        <input type="text" name="Descripcion" id="Descripcion"
            class="form-control w-50" required><br>

        <!-- -->
        <!--campo PRECIO-->
        <label for="Precio" class="form-label">Precio:</label>
        <input type="number" name="Precio" id="Precio"
            class="form-control w-50" step="0.05" required><br>
        <!-- -->
        <!--campo STOCK-->
        <label for="Stock" class="form-label">Stock:</label>
        <input type="number" name="Stock" id="Stock"
            class="form-control w-50" step="0.05" required><br>
        <!-- -->
        <!-- Campo CATEGORÍAS -->
        <label class="form-label">Categorías</label><br>
        <input type="checkbox" name="categorias[]" value="papelaría" id="papelaría">
        <label for="papelería">Papelería</label><br>
        <input type="checkbox" name="categorias[]" value="escolar" id="escolar">
        <label for="escolar">Escolar</label><br>
        <input type="checkbox" name="categorias[]" value="ofcina" id="ofcina">
        <label for="ofcina">Ofcina</label><br>
        <!-- -->
        <hr class="border border-primary border-5 w-50">
        <!-- -->
        <button type="submit" class="btn btn-success" name="enviar">Enviar</button>
    </form>
    <!-- Defino enlaces de navegación con estilo boostrap-->
    <section class="row">
        <nav class="col">
            <a href="01-cargar-bbdd.php"
                class="btn btn-sm btn-warning w-100">Cargar BBDD</a>
            <a href="02-consultar.php"
                class="btn btn-sm btn-success w-100">Consultar productos</a>
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
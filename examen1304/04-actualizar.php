<!-- http://localhost/Curso/PHP/04-actualizar.php -->
<?php
// Llamar a errores y funciones
require("errores.php");
require("funciones.php");

/* Recogemos datos del formulario */
$alerta = "Mensaje...";

// Llamamos a la BBDD
$conexion = conectarBBDD();

// Hacemos la consulta
$consulta = "SELECT * FROM productos";
$filas = $conexion->query($consulta);
$numFilas = $filas->num_rows;
$alerta = "Nº de Registros: " . $numFilas;

// Solo si se envía el formulario, se definen las variables del alert
if (isset($_REQUEST['enviar'])) {
    $referencia = $_REQUEST['Referencia'] ?? '';
    $descripcion = $_REQUEST['Descripcion'] ?? '';
    $precio = $_REQUEST['Precio'] ?? '';
    $stock = $_REQUEST['Stock'] ?? '';

    // En el caso de Categorias mando un Array
    $categorias = $_REQUEST['Categorias'] ?? [];
    var_dump($categorias);
    // implode sirve para escribir los elementos del array
    $categoriasValores = implode(',', $categorias);
    $alerta = " Referencia: $referencia
        Descripción: $descripcion
        Precio: $precio
        Stock: $stock
        Categorias: $categoriasValores";

    // Ahora introducimos lo de arriba en la BBDD
    // Defino una Sentencia preparada (? por cada campo!)
    $sentenciaSQL = "UPDATE productos SET Descripcion = ?, 
                    Precio = ?, Stock = ?, Categorias = ? WHERE Referencia = ? ";
    $sentenciaPreparada = $conexion->prepare($sentenciaSQL);
    // Encriptamos la sentencia (bind_param)
    $sentenciaPreparada->bind_param(
        "sdisi",
        
        $descripcion,
        $precio,
        $stock,
        $categoriasValores,
        $referencia
    );

    // ejecutaSQL es booleano; true (correcto), false (error)
    $ejecutaSQL = $sentenciaPreparada->execute();
    if ($ejecutaSQL) {
        $alerta .= "<br> Producto actualizado correctamente";
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
                <th>Referencia</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categorías</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php       // Asocio la salida a su campo
            $productos = $filas->fetch_all(MYSQLI_ASSOC);
            foreach ($productos as $producto) {
            ?>
                <!-- tr>td*5  -->
                <tr>
                    <td><?php echo $producto['Referencia']; ?></td>
                    <td><?php echo $producto['Descripcion']; ?></td>
                    <td><?php echo $producto['Precio']; ?></td>
                    <td><?php echo $producto['Stock']; ?></td>
                    <td><?php echo $producto['Categorias']; ?></td>
                    <!-- En cada fila pongo un botón Eliminar -->
                    <td>
                        <form action="#" method="post">
                            <input type="hidden" name="Referencia"
                                value="<?php echo $producto['Referencia']; ?>">
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

        $referencia = $_REQUEST['Referencia'];
        $sql = "SELECT * FROM productos WHERE Referencia = ?";
        $sentenciaPreparada = $conexion->prepare($sql);
        $sentenciaPreparada->bind_param("i", $referencia);
        $ejecutaSQL = $sentenciaPreparada->execute();

        $fila = $sentenciaPreparada->get_result();
        $producto = $fila->fetch_assoc();
        // Al tener un array, hay que hacer lo contrario del implode
        $categoriasElegidas = explode(",", $producto['Categorias'] ?? '');
        // Paso de "papelería,escolar"
        // Con el explode -> ["papelería","escolar"]
    ?>

        <form action="#" method="post" class="m-3 shadow-lg">
            <!-- -->
            <!-- Campo Referencia -->
            <label for="Referencia" class="form-label">Referencia:</label>
            <input type="number" name="Referencia" id="Referencia"
                class="form-control w-50" required
                value="<?php echo $producto['Referencia']; ?>"><br>
            <!-- -->
            <!-- Campo Descripcion -->
            <label for="Descripcion" class="form-label">Descripción:</label>
            <input type="text" name="Descripcion" id="Descripcion"
                class="form-control w-50" required
                value="<?php echo $producto['Descripcion']; ?>"><br>
            <!-- -->
            <!-- -->
            <!-- Campo Precio -->
            <label for="Precio" class="form-label">Precio:</label>
            <input type="number" name="Precio" id="Precio"
                class="form-control w-50" step="0.05" required
                value="<?php echo $producto['Precio']; ?>"><br>
            <!-- -->
            <!-- Campo Stock -->
            <label for="Stock" class="form-label">Stock:</label>
            <input type="number" name="Stock" id="Stock"
                class="form-control w-50" required
                value="<?php echo $producto['Stock']; ?>"><br>

            <!-- -->
            <!-- Campo Categorias -->
            <label class="form-label">Categorias</label><br>

            <!-- Cargo con PHP las categorias marcadas -->
            <?php
            // misCategorias son TODAS las categorias de los checkbox
            $misCategorias = ["papelería", "escolar", "oficina"];
            // implode -> "papelería,escolar,oficina"
            foreach ($misCategorias as $categoria) {
                $seleccionado =
                    in_array($categoria, $categoriasElegidas) ? "checked" : "";
            ?>
                <!-- Código HTML: Los checkbox + Label -->
                <input type="checkbox" name="Categorias[]"
                    value="<?php echo $categoria ?>" 
                    id="<?php echo $categoria ?>" <?php echo $seleccionado ?>>
                <label for="<?php echo $categoria ?>"><?php echo $categoria ?></label><br>
            <?php
            }
            ?>
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
            <a href="01-cargar-bbdd.php"
                class="btn btn-sm btn-warning w-100">Cargar BBDD</a>
            <a href="02-consultar.php"
                class="btn btn-sm btn-success w-100">Consultar Productos</a>
        </nav>
        <nav class="col">
            <a href="04-actualizar.php"
                class="btn btn-sm btn-secondary w-100">Actualizar Producto</a>
            <a href="05-eliminar.php"
                class="btn btn-sm btn-danger w-100">Eliminar Producto</a>
        </nav>
    </section>
</body>

</html>
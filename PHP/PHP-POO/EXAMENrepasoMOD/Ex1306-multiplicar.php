<?php
$mensaje = "Mensajes";

// RECUERDA NO TIENE EL PHP PARA LA NAVEGACIÓN PERO SI EL MENU EN HTML

// Función para generar la tabla de multiplicar de un número
function tabMultiplicar($numero) {
    $resultado = "";
    $resultado .= "<h3>Tabla de multiplicar de $numero:</h3><ul>";
    for ($i = 1; $i <= 10; $i++) {
        $resultado .= "<li>$numero x $i = " . ($numero * $i) . "</li>";
    }
    $resultado .= "</ul>";
    return $resultado;
}

if (isset($_POST['solucion'])) {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];

    // Validaciones:
    if ($num1 <= 0 || $num2 <= 0 || $num1 > 19 || $num2 > 19 || $num2 < $num1) {
        $mensaje = "Datos incorrectos. Asegúrese de que num1 < num2 y ambos estén entre 1 y 19.";
    } else {
        // Si las validaciones son correctas, generamos las tablas de multiplicar de los números
        $mensaje = "";
        for ($i = $num1; $i <= $num2; $i++) {
            $mensaje .= tabMultiplicar($i);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablas de Multiplicar</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <article class="alert alert-success m-3 p-3 mb-4 w-50">
        <pre class="mb-0"><?php echo $mensaje; ?></pre>
    </article>

    <form action="#" method="post">
        <section class="m-3 p-3 w-50 bg-info text-white">
            <header class="d-flex mb-3">
                <label for="num1" class="w-50">Tabla desde Nº 1:</label>
                <input type="number" name="num1" id="num1" class="w-50" min="1" max="19" required>
            </header>
            <header class="d-flex mb-3">
                <label for="num2" class="w-50">Tabla desde Nº 2:</label>
                <input type="number" name="num2" id="num2" class="w-50" min="1" max="19" required>
            </header>
            <P class="text-danger"> * Si quieres solo una tabla de multiplicar introduce el mismo valor numérico</P>
            <button type="submit" name="solucion" class="btn btn-success">Generar Tablas</button>
        </section>
    </form>

    <nav aria-label="navegacion" class="m-3 p-3 w-50 bg-primary">
        <form action="#" method="post">
            <label for="opcion" class="form-label">Elige Opción:</label><br>
            <select name="opcion" id="opcion" class="form-control">
                <option value="ej1">Menu</option>
                <option value="ej2">Volúmenes</option>
                <option value="ej3">Geometría</option>
                <option value="ej4">TablaMultiplicar</option>
                <option value="ej5">Fútbol</option>
            </select><br>

            <button type="submit" name="elegir" class="btn btn-success">Elegir</button>
        </form>
    </nav>
</body>
</html>


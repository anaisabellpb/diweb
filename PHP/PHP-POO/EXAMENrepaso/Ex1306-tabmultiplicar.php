<?php
require("errores.php");
// Validación y procesamiento de la solicitud
$mensaje = "Mensajes";

// Función para verificar si un número es primo
function esPrimo($numero) {
    if ($numero <= 1) return 0; // No es primo
    if ($numero == 2 || $numero == 3) return 1; // 2 y 3 son primos
    if ($numero % 2 == 0 || $numero % 3 == 0) return 0; // Divisible por 2 o 3

    for ($i = 5; $i * $i <= $numero; $i += 6) {
        if ($numero % $i == 0 || $numero % ($i + 2) == 0) {
            return 0; // No es primo
        }
    }

    return 1; // Es primo
}

// Función para generar la tabla de multiplicar de los números primos entre num1 y num2
function tabMultiplicarPrimos($num1, $num2) {
    $resultado = "";
    // Asegúrate de que num1 < num2
    for ($i = $num1; $i <= $num2; $i++) {
        if (esPrimo($i)) {
            $resultado .= "<h3>Tabla de multiplicar de $i:</h3><ul>";
            for ($j = 1; $j <= 5; $j++) {
                $resultado .= "<li>$i x $j = " . ($i * $j) . "</li>";
            }
            $resultado .= "</ul>";
        }
    }
    return $resultado;
}

if (isset($_REQUEST['elegir'])) {
    $opcion = $_REQUEST['opcion'];
    switch ($opcion) {
        case 'ej1':
            header('Location: Ex1306-menu.php');
            break;
        case 'ej2':
            header('Location: Ex1306-volumenes.php');
            break;
        case 'ej3':
            header('Location: Ex1306-geometria.php');
            break;
        case 'ej4':
            header('Location: Ex1306-tabMultiplicar.php');
            break;
        case 'ej5':
            header('Location: Ex1306-futbol.php');
            break;
    }
}

// Si se envía el formulario
if (isset($_POST['solucion'])) {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];

    // Validaciones:
    if ($num1 <= 0 || $num2 <= 0 || $num1 > 19 || $num2 > 19 || $num2 <= $num1 || ($num2 - $num1) < 10) {
        $mensaje = "Datos incorrectos. Asegúrese de que num1 < num2, y que la diferencia entre ellos sea al menos 10.";
    } else {
        // Si las validaciones son correctas, generamos la tabla de multiplicar de los primos
        $mensaje = tabMultiplicarPrimos($num1, $num2);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablas de Multiplicar de Primos</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <section class="alert alert-success m-3 p-3 mb-4 w-50">
        <pre class="mb-0"><?php echo $mensaje; ?></pre>
    </section>

    <form action="#" method="post">
        <section class="m-3 p-3 w-50 bg-info text-white">
            <div class="d-flex mb-3">
                <label for="num1" class="w-50">Número 1:</label>
                <input type="number" name="num1" id="num1" class="w-50" min="1" max="19" required>
            </div>
            <div class="d-flex mb-3">
                <label for="num2" class="w-50">Número 2:</label>
                <input type="number" name="num2" id="num2" class="w-50" min="1" max="19" required>
            </div>
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


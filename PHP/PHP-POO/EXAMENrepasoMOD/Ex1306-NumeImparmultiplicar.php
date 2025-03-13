<?php
require("errores.php");
// Validación y procesamiento de la solicitud
$mensaje = "Mensajes";

// RECUERDA NO TIENE EL MENU NI EL PHP PARA LA NAVEGACIÓN

// Función para verificar si un número es impar
function esImpar($numero) {
    return $numero % 2 != 0;
}

// Función para generar la tabla de multiplicar de los números impares entre num1 y num2
function tabMultiplicarImpares($num1, $num2) {
    $resultado = "";
    // Asegúrate de que num1 < num2
    for ($i = $num1; $i <= $num2; $i++) {
        if (esImpar($i)) {  // Verifica si el número es impar
            $resultado .= "<h3>Tabla de multiplicar de $i (Impar):</h3><ul>";
            for ($j = 1; $j <= 5; $j++) {
                $resultado .= "<li>$i x $j = " . ($i * $j) . "</li>";
            }
            $resultado .= "</ul>";
        }
    }
    return $resultado;
}

// Si se envía el formulario
if (isset($_POST['solucion'])) {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];

    // Validaciones:
    if ($num1 <= 0 || $num2 <= 0 || $num2 <= $num1) {
        $mensaje = "Datos incorrectos. Asegúrese de que num1 < num2.";
    } else {
        // Si las validaciones son correctas, generamos la tabla de multiplicar de los impares
        $mensaje = tabMultiplicarImpares($num1, $num2);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablas de Multiplicar de Números Impares</title>
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
                <input type="number" name="num1" id="num1" class="w-50" min="1" required>
            </div>
            <div class="d-flex mb-3">
                <label for="num2" class="w-50">Número 2:</label>
                <input type="number" name="num2" id="num2" class="w-50" min="1" required>
            </div>
            <button type="submit" name="solucion" class="btn btn-success">Generar Tablas</button>
        </section>
    </form>
</body>
</html>

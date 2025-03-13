<?php
require("errores.php");
// Validación y procesamiento de la solicitud
$mensaje = "Mensajes";

// RECUERDA NO TIENE EL MENU NI EL PHP PARA LA NAVEGACIÓN

// Función para sumar los números entre num1 y num2 (inclusive)
function sumarNumeros($num1, $num2) {
    $suma = 0;
    for ($i = $num1; $i <= $num2; $i++) {
        $suma += $i;
    }
    return $suma;
}

// Si se envía el formulario
if (isset($_POST['solucion'])) {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];

    // Validaciones:
    if ($num1 <= 0 || $num2 <= 0 || $num2 < $num1) {
        $mensaje = "Datos incorrectos. Asegúrese de que num1 < num2.";
    } else {
        // Si las validaciones son correctas, generamos la suma de los números
        $mensaje = "La suma de los números entre $num1 y $num2 es: " . sumarNumeros($num1, $num2);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suma de Números entre dos valores</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <section class="alert alert-success m-3 p-3 mb-4 w-50">
        <pre class="mb-0"><?php echo $mensaje; ?></pre>
    </section>

    <form action="#" method="post">
        <section class="m-3 p-3 w-50 bg-info text-white">
            <div class="d-flex mb-3">
                <label for="num1" class="w-50">Valor Nº 1:</label>
                <input type="number" name="num1" id="num1" class="w-50" min="1" required>
            </div>
            <div class="d-flex mb-3">
                <label for="num2" class="w-50">Valor Nº 2:</label>
                <input type="number" name="num2" id="num2" class="w-50" min="1" required>
            </div>
            <p>Va a sumar todos los números que esten entre los valores númeicos introducidos</p>
            <button type="submit" name="solucion" class="btn btn-success">Sumar Números</button>
        </section>
    </form>
</body>
</html>


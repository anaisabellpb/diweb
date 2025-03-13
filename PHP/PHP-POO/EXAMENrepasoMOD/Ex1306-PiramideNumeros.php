<?php
require("errores.php");
// Validación y procesamiento de la solicitud
$mensaje = "Mensajes";

// RECUERDA NO TIENE EL MENU NI EL PHP PARA LA NAVEGACIÓN

// Función para generar la pirámide de números
function generarPiramide($altura) {
    $resultado = "";
    for ($i = 1; $i <= $altura; $i++) {
        // Espacios antes de los números
        $resultado .= str_repeat(" ", $altura - $i);

        // Números de la fila
        for ($j = 1; $j <= $i; $j++) {
            $resultado .= $j . " ";
        }

        // Salto de línea
        $resultado .= "<br>";
    }
    return $resultado;
}

// Si se envía el formulario
if (isset($_POST['solucion'])) {
    $altura = $_POST['altura'];

    // Validaciones:
    if ($altura <= 0) {
        $mensaje = "Por favor, ingrese una altura mayor a 0.";
    } else {
        // Si las validaciones son correctas, generamos la pirámide de números
        $mensaje = generarPiramide($altura);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pirámide de Números</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <section class="alert alert-success m-3 p-3 mb-4 w-50">
        <pre class="mb-0"><?php echo $mensaje; ?></pre>
    </section>

    <form action="#" method="post">
        <section class="m-3 p-3 w-50 bg-info text-white">
            <div class="d-flex mb-3">
                <label for="altura" class="w-50">Altura de la pirámide:</label>
                <input type="number" name="altura" id="altura" class="w-50" min="1" required>
            </div>
            <button type="submit" name="solucion" class="btn btn-success">Generar Pirámide</button>
        </section>
    </form>
</body>
</html>
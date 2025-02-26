<?php
// PHP-POO/Ejemplo_05_Funciones.php
/*  Sea el array de coordenadas con valores (x,y), 
    siendo x=fila (empezando por 0) e y=columna (empezando por 0)
    Sacar la suma en el alert de los elementos designados en coordenadas
 */
// Definimos 4 variables "GLOBALES" (accesibles por las funciones)
$mensaje = "";
$suma = 0;
$coordenadas = [1, 4, 0, 3, 2, 2, 3, 4, 2, 1, 0, 1, 4, 4];
$matriz = [
    [1, 3, 7, 2, 4],          # Fila1, indice = 0
    [3, 2, 1, 0, 3],
    [6, 2, 2, 1, 6],
    [4, 5, 8, 4, 2],          # $matriz[3,2] = 8
    [1, 1, 1, 0, 1]
];
// Las funciones igual que en JS, "recomendable" cargarlas ANTES!
// IAN - Tipo 0E0S (La más fácil)
function ian()
{
    global $mensaje, $coordenadas, $matriz;
    $suma = 0; // Este suma NO es el suma global
    $longitud = count($coordenadas);

    for ($i = 0; $i < $longitud; $i += 2) {
        $fila = $coordenadas[$i];
        $columna = $coordenadas[$i + 1];
        $suma += $matriz[$fila][$columna];
    }

    $mensaje = "[Ian]La suma de los elementos es $suma";
}

// Jesús - Tipo NE0S
function jesus($coordenadas, $matriz)
{
    global $mensaje;
    $suma = 0;
    $longitud = count($coordenadas);
    for ($fila = 0, $columna = 1; $fila < $longitud; $fila += 2, $columna += 2) {
        $coordenadaX = $coordenadas[$fila];
        $coordenadaY = $coordenadas[$columna];
        $suma += $matriz[$coordenadaX][$coordenadaY];
    }
    $mensaje = "[Jesús]La suma de los elementos es $suma";
}

// Iván For - Tipo 0E1S
function ivanFor()
{
    global $coordenadas, $matriz;
    $longitud = count($coordenadas);
    // Igual al de Ian, pero sin crear 2 variables
    $suma = 0;
    for ($i = 0; $i < $longitud; $i += 2) {
        $suma += $matriz[$coordenadas[$i]][$coordenadas[$i + 1]];    // Sumamos el valor correspondiente
    }
    return "[Iván-for]La suma de los elementos es $suma";
}

// Iván Foreach - Tipo NE1S (La más difícil)
function ivanForeach($coordenadas, $matriz)
{
    $suma = 0;
    foreach ($coordenadas as $indice => $valor) {
        if ($indice % 2 == 0)
            $suma += $matriz[$coordenadas[$indice]][$coordenadas[$indice + 1]];
    }
    return "[Iván-foreach]La suma de los elementos es $suma";
}

if (isset($_REQUEST['enviar'])) {

    $solucion = $_REQUEST['solucion'];

    switch ($solucion) {
        case 'ian':
            ian();
            break;
        case 'jesus':
            jesus($coordenadas, $matriz);
            break;
        case 'ivan-for':
            $mensaje = ivanFor();
            break;
        case 'ivan-foreach':
            $mensaje = ivanForeach($coordenadas, $matriz);
            break;
            //default: break;
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=., initial-scale=1.0">
    <title>Funciones PHP</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
    <section aria-label="alert">
        <p class="alert alert-primary m-3 p-3 w-50">
            <?php echo $mensaje; ?></p>
    </section>
    <hr class="m-3 p-1 bg-primary">
    <form action="#" method="post" class="form m-3 p-3 w-50">
        <nav class="form-group">
            <label for="solucion">Solución Ejercicio</label>
            <select class="form-control" id="solucion" name="solucion">
                <option disabled selected>--Elige opción--</option>
                <option value="ian">Ian</option>
                <option value="jesus">Jesús</option>
                <option value="ivan-for">Iván - for</option>
                <option value="ivan-foreach">Iván - foreach</option>
            </select>
        </nav>
        <input type="submit" value="Enviar" class="btn btn-success" name="enviar">
    </form>
</body>

</html>
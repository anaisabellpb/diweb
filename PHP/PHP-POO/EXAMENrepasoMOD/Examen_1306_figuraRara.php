<?php
require("errores.php");
$mensaje = "Mensajes";

// Si se envia el formulario....
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

// Funciones
function volumenes($figura, $a, $b = 0, $c = 0, $r1 = 0, $r2 = 0, $h = 0): string
{
    $resultado = "";
    switch ($figura) {
        case 'tetraedro':
            $resultado .= "Volumen del Tetraedro = " . (pow($a, 3) / (6 * sqrt(2))) . " unidades cúbicas";
            break;
        case 'paralelepipedo':
            $resultado .= "Volumen del Paralelepípedo = " . ($a * $b * $c) . " unidades cúbicas";
            break;
        case 'elipsoide':
            $resultado .= "Volumen del Elipsoide = " . ((4 / 3) * M_PI * $a * $b * $c) . " unidades cúbicas";
            break;
        case 'cono_truncado':
            $resultado .= "Volumen del Cono Truncado = " . ((1 / 3) * M_PI * $h * ($r1 * $r1 + $r1 * $r2 + $r2 * $r2)) . " unidades cúbicas";
            break;
    }
    return $resultado;
}

// Script principal
if (isset($_REQUEST['solucion'])) {
    // Recojo los datos del formulario
    $figura = $_REQUEST['figura'];
    $a = $_REQUEST['a'];
    $b = isset($_REQUEST['b']) ? $_REQUEST['b'] : 0;
    $c = isset($_REQUEST['c']) ? $_REQUEST['c'] : 0;
    $r1 = isset($_REQUEST['r1']) ? $_REQUEST['r1'] : 0;
    $r2 = isset($_REQUEST['r2']) ? $_REQUEST['r2'] : 0;
    $h = isset($_REQUEST['h']) ? $_REQUEST['h'] : 0;

    // Llamo a la función
    $mensaje = volumenes($figura, $a, $b, $c, $r1, $r2, $h);
}

?>
<!-- HTML -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen MF0951</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
    <section aria-label="alerta" class="alert alert-success m-3 p-3 mb-4 w-50">
        <pre class="mb-0"><?php echo $mensaje; ?></pre>
    </section>

    <form action="#" method="post">
        <section aria-label="volumenes" class="m-3 p-3 w-50 bg-info text-white">
            <nav class="d-flex mb-3">
                <label for="a" class="w-50">Dimensión A</label>
                <input type="number" name="a" id="a" class="w-50" min="1" required>
            </nav>
            <nav class="d-flex mb-3">
                <label for="b" class="w-50">Dimensión B (solo para Paralelepípedo)</label>
                <input type="number" name="b" id="b" class="w-50" min="1">
            </nav>
            <nav class="d-flex mb-3">
                <label for="c" class="w-50">Dimensión C (solo para Paralelepípedo)</label>
                <input type="number" name="c" id="c" class="w-50" min="1">
            </nav>
            <nav class="d-flex mb-3">
                <label for="r1" class="w-50">Radio 1 (solo para Cono Truncado)</label>
                <input type="number" name="r1" id="r1" class="w-50" min="1">
            </nav>
            <nav class="d-flex mb-3">
                <label for="r2" class="w-50">Radio 2 (solo para Cono Truncado)</label>
                <input type="number" name="r2" id="r2" class="w-50" min="1">
            </nav>
            <nav class="d-flex mb-3">
                <label for="h" class="w-50">Altura (solo para Cono Truncado)</label>
                <input type="number" name="h" id="h" class="w-50" min="1">
            </nav><br>
            
            <label for="figura" class="form-label">Elige Figura:</label><br>
            <select name="figura" id="figura" class="form-control">
                <option value="tetraedro">Tetraedro</option>
                <option value="paralelepipedo">Paralelepípedo</option>
                <option value="elipsoide">Elipsoide</option>
                <option value="cono_truncado">Cono Truncado</option>
            </select><br>

            <button type="submit" name="solucion" class="btn btn-success">Solución volumen</button>
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
